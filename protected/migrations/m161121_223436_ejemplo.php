<?php

class m161121_223436_ejemplo extends CDbMigration
{
	public function safeUp()
	{
        $this->execute("
        CREATE schema audit;
        REVOKE CREATE ON schema audit FROM public;
         
        CREATE TABLE audit.logged_actions (
            schema_name text NOT NULL,
            TABLE_NAME text NOT NULL,
            user_name text,
            action_tstamp TIMESTAMP WITH TIME zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
            action TEXT NOT NULL CHECK (action IN ('I','D','U')),
            original_data text,
            new_data text,
            query text
        ) WITH (fillfactor=100);
         
        REVOKE ALL ON audit.logged_actions FROM public;
        
        GRANT SELECT ON audit.logged_actions TO public;
         
        CREATE INDEX logged_actions_schema_table_idx 
        ON audit.logged_actions(((schema_name||'.'||TABLE_NAME)::TEXT));
         
        CREATE INDEX logged_actions_action_tstamp_idx 
        ON audit.logged_actions(action_tstamp);
         
        CREATE INDEX logged_actions_action_idx 
        ON audit.logged_actions(action);
         
        --
        -- Now, define the actual trigger function:
        --
        CREATE OR REPLACE FUNCTION audit.if_modified_func() RETURNS TRIGGER AS ".'$body$'."
        DECLARE
            v_old_data TEXT;
            v_new_data TEXT;
        BEGIN
            /*  If this actually for real auditing (where you need to log EVERY action),
                then you would need to use something like dblink or plperl that could log outside the transaction,
                regardless of whether the transaction committed or rolled back.
            */
         
            /* This dance with casting the NEW and OLD values to a ROW is not necessary in pg 9.0+ */
         
            IF (TG_OP = 'UPDATE') THEN
                v_old_data := ROW(OLD.*);
                v_new_data := ROW(NEW.*);
                INSERT INTO audit.logged_actions (schema_name,table_name,user_name,action,original_data,new_data,query) 
                VALUES (TG_TABLE_SCHEMA::TEXT,TG_TABLE_NAME::TEXT,session_user::TEXT,substring(TG_OP,1,1),v_old_data,v_new_data, current_query());
                RETURN NEW;
            ELSIF (TG_OP = 'DELETE') THEN
                v_old_data := ROW(OLD.*);
                INSERT INTO audit.logged_actions (schema_name,table_name,user_name,action,original_data,query)
                VALUES (TG_TABLE_SCHEMA::TEXT,TG_TABLE_NAME::TEXT,session_user::TEXT,substring(TG_OP,1,1),v_old_data, current_query());
                RETURN OLD;
            ELSIF (TG_OP = 'INSERT') THEN
                v_new_data := ROW(NEW.*);
                INSERT INTO audit.logged_actions (schema_name,table_name,user_name,action,new_data,query)
                VALUES (TG_TABLE_SCHEMA::TEXT,TG_TABLE_NAME::TEXT,session_user::TEXT,substring(TG_OP,1,1),v_new_data, current_query());
                RETURN NEW;
            ELSE
                RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - Other action occurred: %, at %',TG_OP,now();
                RETURN NULL;
            END IF;
         
        EXCEPTION
            WHEN data_exception THEN
                RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - UDF ERROR [DATA EXCEPTION] - SQLSTATE: %, SQLERRM: %',SQLSTATE,SQLERRM;
                RETURN NULL;
            WHEN unique_violation THEN
                RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - UDF ERROR [UNIQUE] - SQLSTATE: %, SQLERRM: %',SQLSTATE,SQLERRM;
                RETURN NULL;
            WHEN OTHERS THEN
                RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - UDF ERROR [OTHER] - SQLSTATE: %, SQLERRM: %',SQLSTATE,SQLERRM;
                RETURN NULL;
        END; 
        ".'$body$'."
        LANGUAGE plpgsql
        SECURITY DEFINER
        SET search_path = pg_catalog, audit;
        ");

        $this->createtriggersAdmin();
	}

	public function safeDown()
	{
        $this->dropTriggersAdmin();

		$this->execute("
		    DROP FUNCTION audit.if_modified_func();
		    DROP TABLE audit.logged_actions;
		    DROP schema audit;
		");
	}

    private function createtriggersAdmin(){
        $this->execute("
		    CREATE TRIGGER internacion_if_modified_trg 
            AFTER INSERT OR UPDATE OR DELETE ON internacion
            FOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();
		");

        $this->execute("
		    CREATE TRIGGER servicio_if_modified_trg 
            AFTER INSERT OR UPDATE OR DELETE ON servicio
            FOR EACH ROW EXECUTE PROCEDURE audit.if_modified_func();
		");
    }

    private function dropTriggersAdmin(){
        $this->execute("
            DROP TRIGGER servicio_if_modified_trg on servicio;
        ");
        $this->execute("
            DROP TRIGGER internacion_if_modified_trg on internacion;
        ");
    }


}
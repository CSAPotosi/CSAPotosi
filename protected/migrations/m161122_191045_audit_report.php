<?php

class m161122_191045_audit_report extends CDbMigration
{
	public function safeUp(){
        $this->createTable('audit_report', [
            'id_au_report' => 'pk',
            'user_id' => 'int not null',
            'fecha_report' => 'timestamp not null',
            'name_report' => 'text not null',
            'content_report' => 'text not null'
        ]);
	}

	public function safeDown(){
        $this->dropTable('audit_report');
	}

}
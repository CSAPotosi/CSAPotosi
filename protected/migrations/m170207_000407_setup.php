<?php

class m170207_000407_setup extends CDbMigration
{

	public function safeUp()
	{
        $this->createTable('setup',[
            'clave_se' => "VARCHAR(128) NOT NULL PRIMARY KEY",
            'valor_se' => "TEXT",
            'descripcion_se'=>'TEXT'
        ]);
        $this->insert('setup',['clave_se'=>'se_backup_dias', 'valor_se'=>'30', 'descripcion_se'=>'DIAS TRANSCURRIDOS PARA REALIZAR UN NUEVO BACKUP']);
        $this->insert('setup',['clave_se'=>'se_postgres_dir', 'descripcion_se'=>'UBICACION DEL BINARIO DE POSTGRES (pgsql)']);
	}

	public function safeDown()
	{
        $this->dropTable('setup');
	}
}
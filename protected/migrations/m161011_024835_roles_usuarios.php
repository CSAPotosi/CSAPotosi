<?php

class m161011_024835_roles_usuarios extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('usuario',[
			'id_usuario' => "INT NOT NULL PRIMARY KEY",
			'nombre_usuario' => "VARCHAR(32) UNIQUE NOT NULL",
			'clave' => "VARCHAR(128) NOT NULL",
			'estado_usuario' => "BOOLEAN DEFAULT TRUE",
			"FOREIGN KEY (id_usuario) REFERENCES persona(id_persona)"
		]);

		$this->createTable('AuthItem',[
			'name' => "VARCHAR(64) NOT NULL",
			'type' => "INT NOT NULL",
			'description' => "TEXT",
			'bizrule' => "TEXT",
			'data' => "TEXT",
			"PRIMARY KEY(name)"
		]);

		$this->createTable('AuthItemChild',[
			'parent' => "VARCHAR(64) NOT NULL",
			'child' => "VARCHAR(64) NOT NULL",
			"PRIMARY KEY(parent,child)",
			'FOREIGN KEY (parent) REFERENCES "AuthItem" (name) ON DELETE CASCADE ON UPDATE CASCADE',
			'FOREIGN KEY (child) REFERENCES "AuthItem" (name) ON DELETE CASCADE ON UPDATE CASCADE',
		]);

		$this->createTable('AuthAssignment',[
			'itemname' => "VARCHAR(64) NOT NULL",
			'userid' => "VARCHAR(64) NOT NULL",
			'bizrule' => "TEXt",
			'data' => "TEXt",
			"PRIMARY KEY (itemname, userid)",
			'FOREIGN KEY (itemname) REFERENCES "AuthItem" (name) ON DELETE CASCADE ON UPDATE CASCADE',
		]);
	}

	public function safeDown()
	{
		$this->dropTable('AuthAssignment');
		$this->dropTable('AuthItemChild');
		$this->dropTable('AuthItem');
		$this->dropTable('usuario');
	}

}
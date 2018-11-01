<?php

class m181019_214155_cuentas extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('ciclo_contable', [
			'id_ciclo' => 'pk',
			'gestion' => 'int not null',
			'mes_inicio' => 'smallint not null',
			'descripcion' => 'varchar(512)',
			'activo' => 'boolean not null default true',
		]);
		$this->createTable('cuenta',[
			'id_cuenta' => 'pk',
			'codigo' => 'varchar(16) not null',
			'nombre' => 'varchar(128) not null',
			'fecha_creacion'=> 'date not null',
			'fecha_inactivacion' => 'date',
			'descripcion' => 'text',
			'nivel' => 'smallint not null',
			'naturaleza' => 'smallint not null',
			'activo' => 'boolean not null default true',
			'cuenta_superior' => 'int',
			'FOREIGN KEY (cuenta_superior) REFERENCES cuenta(id_cuenta)'
		]);
		$this->createTable('asiento',[
			'id_asiento'=>'pk',
			'tipo'=>'smallint not null',
			'fecha_registro'=>'date not null',
			'fecha'=>'date not null',
			'glosa'=>'varchar(256) not null',
			'numero_asiento'=>'int not null',
			'numero_comprobante'=>'int not null',
			'id_ciclo'=>'int not null',
			'referencia'=>'varchar(32)',
			'FOREIGN KEY (id_ciclo) REFERENCES ciclo_contable(id_ciclo)'
		]);
		$this->createTable('cuenta_asiento',[
			'id_cuenta_asiento'=>'pk',
			'monto'=>'float not null',
			'tipo'=>'boolean not null',
			'id_asiento'=>'int not null',
			'id_cuenta'=>'int not null',
			'FOREIGN KEY (id_asiento) REFERENCES asiento(id_asiento)',
			'FOREIGN KEY (id_cuenta) REFERENCES cuenta(id_cuenta)'
		]);
	}

	public function safeDown()
	{
		$this->dropTable('cuenta_asiento');
		$this->dropTable('asiento');
		$this->dropTable('cuenta');
		$this->dropTable('ciclo_contable');
	}
}
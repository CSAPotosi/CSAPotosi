<?php

class m170319_214155_cuentas extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('ciclo_contable', [
			'id_ciclo' => 'pk',
			'gestion' => 'int not null',
			'dia_inicio' => 'date not null',
			'descripcion' => 'varchar(512)',
			'activo' => 'boolean not null default false',
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
			'referencia'=>'varchar(128)',
			'id_ciclo'=>'int not null',
			'id_usuario'=>'int not null',
			'FOREIGN KEY (id_ciclo) REFERENCES ciclo_contable(id_ciclo)',
			'FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)'
		]);
		$this->createTable('cuenta_asiento',[
			'id_cuenta_asiento'=>'pk',
			'debe'=>'float',
			'haber'=>'float',
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
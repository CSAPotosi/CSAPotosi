<?php

class m170320_204150_proveedores extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('proveedor', [
			'id_proveedor' => 'pk',
			'nit' => 'varchar(32)',
			'razon_social' => 'varchar(512)',
			'rubro' => 'varchar(16)',
			'direccion' => 'varchar(512)',
			'telefono' => 'varchar(16)',
			'email' => 'varchar(32)',
		]);
		$this->createTable('comprador', [
			'id_proveedor' => 'pk',
			'nit' => 'varchar(32)',
			'razon_social' => 'varchar(512)',
			'rubro' => 'varchar(16)',
			'direccion' => 'varchar(512)',
			'telefono' => 'varchar(16)',
			'email' => 'varchar(32)',
		]);
	}

	public function safeDown()
	{
		$this->dropTable('proveedor');
	}
}
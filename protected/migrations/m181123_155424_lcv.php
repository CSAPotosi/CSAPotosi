<?php

class m181123_155424_lcv extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('compras_lcv', [
			'id_compras_lcv' => 'pk',
			'nro' => '',
			'fecha_factura' => 'int not null',
			'nit_proveedor' => 'smallint not null',
			'razon_social' => 'varchar(512)',
			'nro_factura' => 'boolean not null default true',
			'nro_dui' => '',
			'nro_autorizacion' => '',
			'importe_total' => '',
			'i_nosujeto_credito_fiscal' => '',
			'descuentos_bonificaciones' => '',
			'codigo_control' => '',
			'tipo_compra' => '',
			'' => '',
			'' => '',
			'' => '',
			'' => '',
			'' => ''
		]);
		$this->createTable('ventas_lcv', [
			'id_ventas_lcv' => 'pk',
			'fecha_factura' => 'int not null',
			'nro_factura' => 'smallint not null',
			'nro_autorizacion' => 'varchar(512)',
			'estado' => 'boolean not null default true',
			'nit_cliente' => '',
			'razon_social' => '',
			'importe_total' => '',
			'importes_nosujetos_iva' => '',
			'exportaciones y operaciones excentas' => '',
			'' => '',
			'' => '',
			'' => '',
			'' => '',
			'' => ''
		]);
	}

	public function safeDown()
	{
		$this->dropTable('compras_lcv');
		$this->dropTable('ventas_lcv');
		return false;
	}
}
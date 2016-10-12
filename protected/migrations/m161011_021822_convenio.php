<?php

class m161011_021822_convenio extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('convenio',[
			'id_convenio' => "pk",
			'fecha_creacion' => "TIMESTAMP NOT NULL",
			'fecha_edicion' => "TIMESTAMP",
			'nombre_convenio' => "VARCHAR(128) NOT NULL",
			'activo' => "BOOLEAN DEFAULT FALSE",
			'id_entidad' => "INT NOT NULL",
			"FOREIGN KEY (id_entidad) REFERENCES entidad(id_entidad)"
		]);

		$this->createTable('convenio_servicio',[
			'id_con_ser' => "pk",
			'descuento_servicio' => "FLOAT NOT NULL",
			'activo' => "BOOLEAN DEFAULT FALSE",
			'id_convenio' => "INT NOT NULL",
			'id_servicio' => "INT NOT NULL",
			"FOREIGN KEY (id_convenio) REFERENCES convenio(id_convenio)",
			"FOREIGN KEY (id_servicio) REFERENCES servicio(id_serv)"
		]);
	}

	public function safeDown()
	{
		$this->dropTable('convenio_servicio');
		$this->dropTable('convenio');
	}

}
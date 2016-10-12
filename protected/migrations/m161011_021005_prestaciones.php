<?php

class m161011_021005_prestaciones extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('prestacion_servicio',[
			'id_prestacion' => "pk",
			'id_historial' => "INT NOT NULL",
			'observaciones' => "VARCHAR(256)",
			'tipo' => "INT NOT NULL",
			'fecha_solicitud' => "TIMESTAMP",
			"FOREIGN KEY (id_historial) REFERENCES historial_medico(id_historial)"
		]);

		$this->createTable('detalle_prestacion',[
			'id_detalle' => "pk",
			'id_prestacion' => "INT NOT NULL",
			'id_servicio' => "INT NOT NULL",
			'fecha_solicitud' => "TIMESTAMP NOT NULL",
			'cantidad' => "FLOAT NOT NULL",
			'subtotal' => "FLOAT NOT NULL",
			'pagado' => "BOOLEAN DEFAULT FALSE",
			'realizado' => "BOOLEAN DEFAULT FALSE",
			"FOREIGN KEY (id_prestacion) REFERENCES prestacion_servicio(id_prestacion)",
			"FOREIGN KEY (id_servicio) REFERENCES servicio(id_serv)"
		]);
	}

	public function safeDown()
	{
		$this->dropTable('detalle_prestacion');
		$this->dropTable('prestacion_servicio');
	}

}
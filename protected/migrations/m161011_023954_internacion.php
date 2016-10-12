<?php

class m161011_023954_internacion extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('internacion',[
			'id_inter' => "pk",
			'id_historial' => "INT NOT NULL",
			'fecha_ingreso' => "TIMESTAMP NOT NULL",
			'motivo_ingreso' => "SMALLINT NOT NULL",
			'procedencia_ingreso' => "SMALLINT NOT NULL",
			'observacion_ingreso' => "VARCHAR(256)",
			'fecha_alta' => "TIMESTAMP",
			'tipo_alta' => "SMALLINT",
			'observacion_alta' => "VARCHAR(256)",
			'fecha_egreso' => "TIMESTAMP",
			'estado' => "SMALLINT DEFAULT 0",
			"FOREIGN KEY (id_historial) references historial_medico(id_historial)"
		]);

		$this->createTable('internacion_sala',[
			'id_inter' => "INT NOT NULL",
			'id_sala' => "INT NOT NULL",
			'fecha_entrada' => "TIMESTAMP NOT NULL",
			'fecha_salida' => "TIMESTAMP",
			"FOREIGN KEY (id_inter) REFERENCES internacion(id_inter)",
			"FOREIGN KEY (id_sala) REFERENCES sala(id_sala)",
			"PRIMARY KEY(id_inter, id_sala, fecha_entrada)"
		]);

	}

	public function safeDown()
	{
		$this->dropTable('internacion_sala');
		$this->dropTable('internacion');
	}

}
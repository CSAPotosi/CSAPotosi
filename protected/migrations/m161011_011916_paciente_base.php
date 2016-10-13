<?php

class m161011_011916_paciente_base extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('paciente',[
			'id_paciente' => "INT NOT NULL PRIMARY KEY",
			'codigo_paciente' => "VARCHAR(16)",
			'grupo_sanguineo' => "VARCHAR(8)",
			'fecha_deceso' => "TIMESTAMP",
			'estado_paciente' => "SMALLINT DEFAULT 1",
			'responsable' => "VARCHAR(512)",
			"FOREIGN KEY (id_paciente) REFERENCES persona(id_persona)"
		]);

		$this->createTable('historial_medico',[
			'id_historial' => "INT NOT NULL PRIMARY KEY",
			'fecha_creacion' => "TIMESTAMP NOT NULL",
			'fecha_edicion' => "TIMESTAMP NOT NULL",
			"FOREIGN KEY (id_historial) REFERENCES paciente(id_paciente)"
		]);
	}

	public function safeDown()
	{
		$this->dropTable('historial_medico');
		$this->dropTable('paciente');
	}

}
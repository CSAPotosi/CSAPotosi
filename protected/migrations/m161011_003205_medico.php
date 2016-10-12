<?php

class m161011_003205_medico extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('medico',[
			'id_medico' => "INT NOT NULL PRIMARY KEY",
			'matricula' => "VARCHAR(16) UNIQUE NOT NULL",
			'estado_med' => "BOOLEAN DEFAULT TRUE",
			"FOREIGN KEY (id_medico) REFERENCES PERSONA (id_persona)"
		]);

		$this->createTable('especialidad',[
			'id_especialidad' => "pk",
			'nombre_especialidad' => "VARCHAR(50) NOT NULL",
			'descripcion' => "VARCHAR(128)"
		]);

		$this->createTable('medico_especialidad',[
			'id_m_e' => "pk",
			'id_medico' => "INT NOT NULL",
			'id_especialidad' => "INT NOT NULL",
			"FOREIGN KEY (id_medico) REFERENCES medico(id_medico)",
			"FOREIGN KEY (id_especialidad) REFERENCES especialidad(id_especialidad)"
		]);
	}

	public function safeDown()
	{
		$this->dropTable('medico_especialidad');
		$this->dropTable('especialidad');
		$this->dropTable('medico');
	}

}
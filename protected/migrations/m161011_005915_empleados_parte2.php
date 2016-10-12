<?php

class m161011_005915_empleados_parte2 extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('periodo',[
			'id_periodo' => "pk",
			'hora_entrada' => "TIME NOT NULL",
			'inicio_entrada' => "INT DEFAULT 0",
			'fin_entrada' => "INT DEFAULT 0",
			'hora_salida' => "TIME NOT NULL",
			'inicio_salida' => "INT DEFAULT 0",
			'fin_salida' => "INT DEFAULT 0",
			'tolerancia' => "INT DEFAULT 15",
			'tipo_periodo' => "INT"
		]);

		$this->createTable('horario_periodo',[
			'id_horario_periodo' => "pk",
			'id_horario' => "INT NOT NULL",
			'id_periodo' => "INT NOT NULL",
			'dia' => "INT",
			"FOREIGN KEY (id_horario) REFERENCES horario(id_horario)",
			"FOREIGN KEY (id_periodo) REFERENCES periodo(id_periodo)"
		]);

		$this->createTable('asignacion_empleado',[
			'id_asignacion' => "pk",
			'fecha_inicio' => "DATE NOT NULL",
			'fecha_fin' => "DATE",
			'vigente' => "BOOLEAN DEFAULT FALSE",
			'id_empleado' => "INT NOT NULL",
			'id_cargo' => "INT NOT NULL",
			"FOREIGN KEY (id_empleado) REFERENCES empleado(id_empleado)",
			"FOREIGN KEY (id_cargo) REFERENCES cargo(id_cargo)"
		]);

		$this->createTable('registro',[
			'id_asignacion' => "INT NOT NULL",
			'fecha' => "DATE NOT NULL",
			'hora_asistencia' => "TIME NOT NULL",
			'observaciones' => "VARCHAR(128)",
			'estado' => "BOOLEAN",
			"PRIMARY KEY (fecha, hora_asistencia, id_asignacion)",
			"FOREIGN KEY (id_asignacion) REFERENCES asignacion_empleado(id_asignacion)"
		]);
	}

	public function safeDown()
	{
		$this->dropTable('registro');
		$this->dropTable('asignacion_empleado');
		$this->dropTable('horario_periodo');
		$this->dropTable('periodo');
	}
}
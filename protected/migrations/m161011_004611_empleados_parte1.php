<?php

class m161011_004611_empleados_parte1 extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('empleado',[
			'id_empleado' => "INT NOT NULL PRIMARY KEY",
			'fecha_contratacion' => "DATE",
			'estado_emp' => "BOOLEAN DEFAULT TRUE",
			'cod_maquina' => "INT",
			"FOREIGN KEY (id_empleado) REFERENCES persona(id_persona)"
		]);

		$this->createTable('unidad',[
			'id_unidad' => "pk",
			'nombre_unidad' => "VARCHAR(32) NOT NULL UNIQUE",
			'descripcion_unidad' => "VARCHAR(128)"
		]);

		$this->createTable('horario',[
			'id_horario' => "pk",
			'nombre_horario' => "VARCHAR(32) NOT NULL UNIQUE",
			'descripcion' => "VARCHAR(32)",
			'ciclo_total' => "INT"
		]);

		$this->createTable('cargo',[
			'id_cargo' => "pk",
			'nombre_cargo' => "VARCHAR(32) NOT NULL UNIQUE",
			'descripcion_cargo' => "VARCHAR(128)",
			'id_unidad' => "INT NOT NULL",
			'id_horario' => "INT NOT NULL",
			"FOREIGN KEY (id_unidad) REFERENCES unidad(id_unidad)",
			"FOREIGN KEY (id_horario) REFERENCES horario(id_horario)"
		]);
	}

	public function safeDown()
	{
		$this->dropTable('cargo');
		$this->dropTable('horario');
		$this->dropTable('unidad');
		$this->dropTable('empleado');
	}

}
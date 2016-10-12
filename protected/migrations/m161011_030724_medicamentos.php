<?php

class m161011_030724_medicamentos extends CDbMigration
{
	public function up()
	{
		$this->createTable('medicamento',[
			'codigo' => "VARCHAR(8) NOT NULL PRIMARY KEY",
			'nombre_med' => "VARCHAR(64) NOT NULL",
			'forma_farm' => "VARCHAR(64) NOT NULL",
			'contentracion' => "VARCHAR(64) NOT NULL",
			"ATQ" => "VARCHAR(8) NOT NULL",
			'restringido' => "BOOLEAN DEFAULT FALSE",
			'estado_med' => "SMALLINT DEFAULT 1"
		]);
	}

	public function down()
	{
		$this->dropTable('medicamento');
	}
}
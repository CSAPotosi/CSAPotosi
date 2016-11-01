<?php

class m161011_030724_medicamentos extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('medicamento',[
			'codigo' => "VARCHAR(8) NOT NULL PRIMARY KEY",
			'nombre_med' => "VARCHAR(128) NOT NULL",
			'forma_farm' => "VARCHAR(64) NOT NULL",
			'concentracion' => "VARCHAR(64) NOT NULL",
			"ATQ" => "VARCHAR(8) NOT NULL",
			'restringido' => "BOOLEAN DEFAULT FALSE",
			'estado_med' => "SMALLINT DEFAULT 1"
		]);

        $medicamentos = $this->getJson();
        foreach($medicamentos as $medi){
            $this->insert('medicamento', $medi);
        }
        
	}

	public function safeDown()
	{
		$this->dropTable('medicamento');
	}

    private function getJson(){
        $file = __DIR__.'/../data/medicamentos.json';
        return CJSON::decode(file_get_contents($file));
    }
}
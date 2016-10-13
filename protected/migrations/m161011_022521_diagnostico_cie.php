<?php

class m161011_022521_diagnostico_cie extends CDbMigration
{
	public function safeUp()
	{
		$this->createTable('capitulo_cie',[
			'num_cap' => "VARCHAR(8) NOT NULL PRIMARY KEY",
			'titulo_cap' => "TEXT UNIQUE NOT NULL"
		]);

		$this->createTable('categoria_cie',[
			'id_cat' => "pk",
			'titulo_cat' => "TEXT UNIQUE NOT NULL",
			'cod_ini' => "VARCHAR(8) NOT NULL",
			'cod_fin' => "VARCHAR(8) NOT NULL",
			'num_cap' => "VARCHAR(8) NOT NULL",
			"FOREIGN KEY (num_cap) REFERENCES capitulo_cie(num_cap)"
		]);

        $this->createTable('item_cie',[
            'codigo' => "VARCHAR(8) NOT NULL PRIMARY KEY",
            'titulo' => "TEXT NOT NULL",
            'descripcion' => "TEXT",
            'codigo_padre' => "VARCHAR(8)",
            'id_cat' => "INT NOT NULL",
            "FOREIGN KEY (codigo_padre) REFERENCES item_cie(codigo)",
            "FOREIGN KEY (id_cat) REFERENCES categoria_cie(id_cat)"
        ]);

		$this->createTable('diagnostico',[
			'id_diag' => "pk",
			'fecha_diag' => "TIMESTAMP NOT NULL",
			'anamnesis' => "TEXT NOT NULL",
			'exploracion' => "TEXT",
			'conclusion' => "TEXT NOT NULL",
			'observaciones' => "TEXT",
			'tipo' => "SMALLINT NOT NULL DEFAULT 0",
			'id_historial' => "INT NOT NULL",
			"FOREIGN KEY (id_historial) REFERENCES historial_medico(id_historial)"
		]);

		$this->createTable('diagnostico_cie',[
			'id_diag' => "INT NOT NULL",
			'codigo' => "VARCHAR(8) NOT NULL",
			"FOREIGN KEY (id_diag) REFERENCES diagnostico(id_diag)",
			"FOREIGN KEY (codigo) REFERENCES item_cie(codigo)",
			"PRIMARY KEY(id_diag, codigo)"
		]);
	}

	public function safeDown()
	{
		$this->dropTable('diagnostico_cie');
		$this->dropTable('diagnostico');
		$this->dropTable('item_cie');
		$this->dropTable('categoria_cie');
		$this->dropTable('capitulo_cie');
	}

}
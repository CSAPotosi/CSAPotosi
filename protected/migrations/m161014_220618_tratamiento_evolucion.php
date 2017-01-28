<?php

class m161014_220618_tratamiento_evolucion extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('evolucion',[
            'id_evo' => "pk",
            'fecha_evo' => "TIMESTAMP NOT NULL",
            'exploracion_evo' => "TEXT",
            'estado_paciente' => "TEXT NOT NULL",
            'recomendaciones' => "TEXT",
            'id_diag' => "INT NOT NULL",
            "FOREIGN KEY (id_diag) REFERENCES diagnostico(id_diag)"
        ]);

        $this->createTable('tratamiento',[
            'id_trat' => "pk",
            'fecha_trat' => "TIMESTAMP NOT NULL",
            'instrucciones' => "TEXT NOT NULL",
            'observaciones' => "TEXT",
            'id_diag' => "INT NOT NULL",
            "FOREIGN KEY (id_diag) REFERENCES diagnostico(id_diag)"
        ]);

        $this->createTable('receta',[
            'id_trat' => "INT NOT NULL",
            'codigo_med' => "INT NOT NULL",
            'cant_solicitada' => "INT NOT NULL",
            'via' => "VARCHAR(30) NOT NULL",
            'pauta' => "TEXT",
            "FOREIGN KEY (id_trat) REFERENCES tratamiento(id_trat)",
            "FOREIGN KEY (codigo_med) REFERENCES medicamento (codigo)",
            "PRIMARY KEY (id_trat, codigo_med)"
        ]);

	}

	public function safeDown()
	{
        $this->dropTable('receta');
        $this->dropTable('tratamiento');
		$this->dropTable('evolucion');
	}

}
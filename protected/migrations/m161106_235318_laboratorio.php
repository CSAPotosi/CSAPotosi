<?php

class m161106_235318_laboratorio extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('parametro',[
            'id_par' => "pk",
            'nombre_par' => "VARCHAR(64) NOT NULL UNIQUE",
            'ext_par' => "VARCHAR(16)",
            'tipo_par' => "INT NOT NULL DEFAULT 0",//0 laboratorio, 1 medico, 2 antecedentes
            'val_ref' => "TEXT",
            'def_par' => "JSON DEFAULT '{\"type\":\"string\"}'"
        ]);

        $this->createTable('examen_parametro',[
            'id_serv' => "INT NOT NULL",
            'id_par' => "INT NOT NULL",
            'orden'=>"INT NOT NULL DEFAULT 1",
            "FOREIGN KEY (id_serv) REFERENCES servicio(id_serv)",
            "FOREIGN KEY (id_par) REFERENCES parametro(id_par)",
            "PRIMARY KEY (id_serv, id_par)"
        ]);

        $this->createTable('resultado_examen',[
            'id_res' => "pk",
            'diagnostico_res' => "TEXT NOT NULL",
            'observacion_res' => "TEXT",
            'fec_res' => "TIMESTAMP NOT NULL",
            'id_det_pres' => "INT NOT NULL",
            "FOREIGN KEY (id_det_pres) REFERENCES detalle_prestacion(id_detalle)"
        ]);

        $this->createTable('detalle_resultado',[
            'id_res' => "INT NOT NULL",
            'id_par' => "INT NOT NULL",
            'valor_res' => "VARCHAR(128) NOT NULL",
            "FOREIGN KEY(id_res) REFERENCES resultado_examen(id_res)",
            "FOREIGN KEY(id_par) REFERENCES parametro(id_par)",
            "PRIMARY KEY (id_res,id_par)"
        ]);
	}

	public function safeDown()
	{
		$this->dropTable('detalle_resultado');
        $this->dropTable('resultado_examen');
        $this->dropTable('examen_parametro');
        $this->dropTable('parametro');
	}

}
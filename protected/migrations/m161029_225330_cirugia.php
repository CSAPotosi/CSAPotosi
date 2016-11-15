<?php

class m161029_225330_cirugia extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('cirugia',[
            'id_cir' => "pk",
            'fec_reserva' => "TIMESTAMP",
            'fec_inicio' => "TIMESTAMP",
            'fec_fin' => "TIMESTAMP",
            'tiempo_estimado' => "INT DEFAULT 0",
            'tiempo_real' => "INT DEFAULT 0",
            'detalle_instrumental' => "TEXT",
            'naturaleza' => "TEXT",
            'reservado'=>"BOOLEAN DEFAULT FALSE",//true si, false no
            'id_historial' => "INT NOT NULL",
            'id_sala' => "INT NOT NULL",
            "FOREIGN KEY (id_historial) REFERENCES historial_medico(id_historial)",
            "FOREIGN KEY (id_sala) REFERENCES sala(id_sala)"
        ]);

        $this->createTable('personal_cirugia',[
            'id_pc'=>"pk",
            'id_cir' => "INT NOT NULL",
            'id_per' => "INT NOT NULL",
            'responsable' => "BOOLEAN DEFAULT false",
            'rol_cirugia'=>"VARCHAR(36)",//cirujano,1er ayudante, 2do ayudante, instrumentista,anestesista,circulante,aux de anestesia
            "FOREIGN KEY (id_cir) REFERENCES cirugia(id_cir)",
            "FOREIGN KEY (id_per) REFERENCES persona (id_persona)"
        ]);
	}

	public function safeDown()
	{
        $this->dropTable('personal_cirugia');
        $this->dropTable('cirugia');
	}

}
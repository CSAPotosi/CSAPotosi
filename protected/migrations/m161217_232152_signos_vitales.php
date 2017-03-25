<?php

class m161217_232152_signos_vitales extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('signo_vital',[
            'id_sv' => "pk",
            'fecha_sv' => "timestamp not null",
            'valor_sv' => "VARCHAR(128) NOT NULL",
            'id_par' => "INT NOT NULL",
            'id_historial' => "INT NOT NULL",
            'id_usuario'=>"INT",
            "FOREIGN KEY(id_par) REFERENCES parametro(id_par)",
            "FOREIGN KEY (id_historial) REFERENCES historial_medico(id_historial)",
        ]);
	}

	public function safeDown()
	{
        $this->dropTable('signo_vital');
	}
}
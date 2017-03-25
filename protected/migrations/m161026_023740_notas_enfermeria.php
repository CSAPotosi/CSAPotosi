<?php

class m161026_023740_notas_enfermeria extends CDbMigration
{
	public function safeUp()
	{
        $this->createTable('nota_enfermeria',[
            'id_n_enf' => "pk",
            'fecha_n_enf' => "TIMESTAMP NOT NULL",
            'estado_salud' => "VARCHAR(64) NOT NULL",
            'dieta_indicada' => "TEXT",
            'dieta_aceptada' => "TEXT",
            'evacuaciones' => "TEXT",
            'uresis' => "TEXT",
            'vomito' => "TEXT",
            'ind_medico' => "TEXT",
            'id_inter' => "INT NOT NULL",
            'id_usuario'=>"INT",
            "FOREIGN KEY (id_inter) REFERENCES internacion(id_inter)"
        ]);
	}

	public function safeDown()
	{
		$this->dropTable("nota_enfermeria");
	}

}
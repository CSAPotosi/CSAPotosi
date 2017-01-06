<?php

class m161217_232136_antecedentes extends CDbMigration
{

	public function safeUp()
	{
        $this->createTable('antecedente',[
            'id_ant' => "pk",
            'fecha_ant' => "timestamp not null",
            'valor_ant' => "VARCHAR(128) NOT NULL",
            'id_par' => "INT NOT NULL",
            'id_historial' => "INT NOT NULL",
            "FOREIGN KEY(id_par) REFERENCES parametro(id_par)",
            "FOREIGN KEY (id_historial) REFERENCES historial_medico(id_historial)",
        ]);
	}

	public function safeDown()
	{
        $this->dropTable('antecedente');
	}
}

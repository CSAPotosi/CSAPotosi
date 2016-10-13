<?php

class m161011_001316_persona_base extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('pais',[
            'cod_pais'=>"VARCHAR(4) NOT NULL PRIMARY KEY",
            'nombre_pais'=>"VARCHAR(64) NOT NULL"
        ]);

        $this->createTable('persona',[
            'id_persona' => "pk",
            'num_doc' => "VARCHAR(32) NOT NULL DEFAULT '0'",
            'tipo_doc' => "SMALLINT DEFAULT 0",
            'nombres' => "VARCHAR(128) NOT NULL",
            'primer_apellido' => "VARCHAR(32) NOT NULL",
            'segundo_apellido' => "VARCHAR(32)",
            'genero' => "BOOLEAN",
            'fecha_nac' => "TIMESTAMP DEFAULT '01/01/0001'",
            'estado_civil' => "VARCHAR(32)",
            'ocupacion' => "VARCHAR(32)",
            'nacionalidad' => "VARCHAR(4) NOT NULL",
            'localidad' => "VARCHAR(64)",
            'domicilio' => "VARCHAR(64)",
            'telefono' => "VARCHAR(32)",
            'email' => "VARCHAR(128)",
            'foto' => "VARCHAR(256)",
            "FOREIGN KEY (nacionalidad) REFERENCES pais(cod_pais)"
        ]);

        $paises = $this->getJson();
        foreach($paises as $pais){
            $this->insert('pais', $pais);
        }
    }

    public function safeDown()
    {
        $this->dropTable('persona');
        $this->dropTable('pais');
    }

    private function getJson(){
        $file = __DIR__.'/../data/paises.json';
        return CJSON::decode(file_get_contents($file));
    }
}
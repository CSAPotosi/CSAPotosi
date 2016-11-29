<?php

class m161114_045934_asegurado extends CDbMigration
{
    public function safeUp(){
        $this->createTable('asegurado_convenio', [
            'id_ase_con' => 'pk',
            'convenio' => 'int not null',
            'id_paciente' => 'int not null',
            'fecha_inicio' => 'date not null',
            'fecha_edicion' => 'date',
            'tipo_asegurado' => 'smallint default 1',
            'id_paciente_titular' => 'int',
            'activo' => 'boolean default false',
            'foreign key (id_paciente) references paciente(id_paciente)',
            'foreign key (convenio) references convenio(id_convenio)',
            'foreign key (id_paciente_titular) references paciente(id_paciente)'
        ]);
    }

    public function down()
    {
        $this->dropTable('asegurado_convenio');
    }
}
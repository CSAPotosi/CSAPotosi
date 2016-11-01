<?php

class m161101_174300_citas extends CDbMigration
{
    public function up()
    {
        $this->createTable('cita', [
            'id_cita' => 'pk',
            'fecha' => 'date not null',
            'hora_cita' => 'time not null',
            'estado_cita' => 'smallint default 0',
            'id_paciente' => 'int',
            'medico_consulta_servicio' => 'int',
            'foreign key (id_paciente) references paciente(id_paciente)',
            'foreign key (medico_consulta_servicio) references medico_especialidad(id_m_e)',
        ]);
    }

    public function down()
    {
        $this->dropTable('cita');
    }

    /*
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
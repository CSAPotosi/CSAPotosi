<?php

class m161122_011058_crearAdministrador extends CDbMigration
{
    public function safeUp()
    {
        $tareas = Yii::app()->authManager->getTasks();
        $this->insert("AuthItem", array("name" => "ADMIN", "type" => "2", "description" => "ADMINISTRADOR DEL SISTEMA"));
        foreach ($tareas as $t) {
            $this->insert("AuthItemChild", array('parent' => 'ADMIN', 'child' => $t->name));
        }
        $this->insert("persona", array('num_doc' => '1234567', 'nombres' => 'NOMBRE ADMINISTRADOR', 'primer_apellido' => 'APELLIDO1', 'segundo_apellido' => 'APELLIDO2', 'nacionalidad' => 'BOL',));
        $persona = Persona::model()->find("nombres='NOMBRE ADMINISTRADOR' and num_doc = '1234567'");
        $this->insert("usuario", array('id_usuario' => $persona->id_persona, 'nombre_usuario' => 'admin', 'clave' => sha1('admin')));
        $this->insert("AuthAssignment", array('itemname' => 'ADMIN', 'userid' => $persona->id_persona));
    }

    public function safeDown()
    {
        $this->delete("AuthAssignment", "itemname = 'ADMIN'");
        $persona = Persona::model()->find("nombres='NOMBRE ADMINISTRADOR' and num_doc = '1234567'");
        $this->delete("usuario", "id_usuario = $persona->id_persona");
        $this->delete("persona", "id_persona = $persona->id_persona");
        $this->delete("AuthItem", "name='ADMIN'");
    }
}
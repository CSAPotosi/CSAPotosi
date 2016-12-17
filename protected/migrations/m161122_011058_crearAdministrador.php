<?php

class m161122_011058_crearAdministrador extends CDbMigration
{
    public function safeUp()
    {
        $roles = Yii::app()->authManager->getRoles();
        $role = Yii::app()->authManager->createRole('ADMIN', 'ADMINISTRADOR DEL SISTEMA');
        foreach ($roles as $r) {
            $role->addChild($r->name);
        }
        $role->setData("usuario");
        $this->insert("persona", array('num_doc' => '1234567', 'nombres' => 'NOMBRE ADMINISTRADOR', 'primer_apellido' => 'APELLIDO1', 'segundo_apellido' => 'APELLIDO2', 'nacionalidad' => 'BOL',));
        $persona = Persona::model()->find("nombres='NOMBRE ADMINISTRADOR' and num_doc = '1234567'");
        $this->insert("usuario", array('id_usuario' => $persona->id_persona, 'nombre_usuario' => 'admin', 'clave' => sha1('admin')));
        Yii::app()->authManager->assign($role->name, $persona->id_persona);
    }
    public function safeDown()
    {
        Yii::app()->authManager->removeAuthItem('ADMIN');
        $persona = Persona::model()->find("nombres='NOMBRE ADMINISTRADOR' and num_doc = '1234567'");
        $this->delete("usuario", "id_usuario = $persona->id_persona");
        $this->delete("persona", "id_persona = $persona->id_persona");
    }
}
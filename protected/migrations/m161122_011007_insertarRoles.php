<?php

class m161122_011007_insertarRoles extends CDbMigration
{
    public function safeUp()
    {
        $rolesContabilidad = $this->getJson(1);
        foreach ($rolesContabilidad as $rol) {
            $this->insert("AuthItem", $rol);
        }
        $rolesAdministracionClinica = $this->getJson(2);
        foreach ($rolesAdministracionClinica as $rol) {
            $this->insert("AuthItem", $rol);
        }
        $rolesMedicos = $this->getJson(3);
        foreach ($rolesMedicos as $rol) {
            $this->insert("AuthItem", $rol);
        }
    }
    public function safeDown()
    {
        $this->delete("AuthItem");
    }
    private function getJson($tipo)
    {
        if ($tipo == 1)
            $file = __DIR__ . '/../data/RolesContabilidad.json';
        elseif ($tipo == 2)
            $file = __DIR__ . '/../data/RolesAdministracionClinica.json';
        else
            $file = __DIR__ . '/../data/RolesMedicos.json';
        return CJSON::decode(file_get_contents($file));
    }
}
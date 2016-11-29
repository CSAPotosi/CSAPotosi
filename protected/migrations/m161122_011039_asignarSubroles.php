<?php

class m161122_011039_asignarSubroles extends CDbMigration
{
    public function safeUp()
    {
        $rolesContabilidad = $this->getJson(1);
        foreach ($rolesContabilidad as $rol) {
            $this->insert("AuthItemChild", $rol);
        }
        $rolesAdministracionClinica = $this->getJson(2);
        foreach ($rolesAdministracionClinica as $rol) {
            $this->insert("AuthItemChild", $rol);
        }
        $rolesMedicos = $this->getJson(3);
        foreach ($rolesMedicos as $rol) {
            $this->insert("AuthItemChild", $rol);
        }
    }
    public function safeDown()
    {
        $this->delete("AuthItemChild");
    }
    private function getJson($tipo)
    {
        if ($tipo == 1)
            $file = __DIR__ . '/../data/asignacionRolesContabilidad.json';
        elseif ($tipo == 2)
            $file = __DIR__ . '/../data/asignacionRolesAdministracionClinica.json';
        else
            $file = __DIR__ . '/../data/asignacionRolesMedicos.json';
        return CJSON::decode(file_get_contents($file));
    }
}
<?php

class RoleForm extends CFormModel
{
    public $name;
    public $description;

    //public $data;
    public function rules()
    {
        return array(
            array("name", "required"),
            array("description", "safe"),
        );
    }
}
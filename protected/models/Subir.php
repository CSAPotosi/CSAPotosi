<?php

/*

 * $property string $uploadedfile

 */

class Subir extends CFormModel
{
    public $uploadedfile;

    public function rules()
    {

        return array(
            array('uploadedfile', 'required'),
            array('uploadedfile', 'file', 'types' => 'dat'),
        );
    }

    public function attributeLabels()
    {
        array(
            'uploadedfile' => 'ARCHIVO',
        );
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


}

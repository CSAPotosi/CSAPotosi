<?php

class ServicioForm extends CFormModel
{
    public $cod_serv;
    public $nombre_serv;
    public $unidad_medida;
    public $precio_serv;
    public $tipo_cobro;
    public $activo;

    public $condiciones_ex;
    public $id_cat_ex;
    public $idservicio;

    public function rules()
    {
        return array(
            array('cod_serv, nombre_serv, precio_serv, id_cat_ex', 'required'),
            array('tipo_cobro, id_cat_ex', 'numerical', 'integerOnly' => true),
            array('precio_serv', 'numerical'),
            array('cod_serv', 'length', 'max' => 8),
            array('nombre_serv', 'length', 'max' => 64),
            array('unidad_medida', 'length', 'max' => 32),
            array('fecha_creacion, fecha_edicion, activo, condiciones_ex', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id_serv, cod_serv, nombre_serv, unidad_medida, precio_serv, tipo_cobro, fecha_creacion, fecha_edicion, activo condiciones_ex, id_cat_ex', 'safe', 'on' => 'search'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'cod_serv' => 'CODIGO DE SERVICIO',
            'nombre_serv' => 'NOMBRE DE SERVICIO',
            'unidad_medida' => 'UNIDAD DE MEDIDA',
            'precio_serv' => 'PRECIO DE SERVICIO',
            'tipo_cobro' => 'TIPO DE COBRO',
            'fecha_creacion' => 'FECHA DE CREACION',
            'fecha_edicion' => 'FECHA DE EDICION',
            'activo' => 'ACTIVO | INACTIVO',

            'condiciones_ex' => 'CONDICIONES',
            'id_cat_ex' => 'ID DE CATEGORIA EXTERNA',
        );
    }

    public function saveServicio()
    {
        $trans = Yii::app()->db->beginTransaction();
        try {
            // All your SQL commands.
            $servicio = new Servicio;
            $servicio->attributes = $this->getAttributes();
            $servicio->save();

            $servExamen = new ServExamen;
            $servExamen->attributes = $this->getAttributes();
            $this->idservicio = $servicio->id_serv;
            $servExamen->id_serv = $this->idservicio;
            $servExamen->save();

            // If you got to this point, no exceptions occurred!
            $trans->commit();

        } catch (Exception $e) {
            // Use $e.
            throw new CHttpException(500, $e->getMessage());
            // Undo the commands:
            $trans->rollback();
        }
        return true;
    }

    public static function getTypeServicioOptions()
    {
        $array = array(0 => "No Definido", 1 => "Laboratorio", 2 => "Rayos X", 3 => "Ecografía");
        return $array;
    }
}

?>
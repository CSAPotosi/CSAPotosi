<?php

class ServicioForm extends CFormModel
{
    //servicio
    public $cod_serv;
    public $nombre_serv;
    public $unidad_medida;
    public $tipo_cobro;
    public $activo;
    public $id_entidad;
    //precio
    public $monto;
    //examen
    public $condiciones_ex;
    public $id_cat_ex;
    //tipo sala
    public $descripcion_t_sala;
    //atencion medica
    public $cod_espe;
    public $id_m_e;
    public $tipo_atencion;

    //id
    private $_idServicio;
    //objetos
    private $modelPrecio;
    private $modelServicio;
    private $modelServExamen;
    private $modelServTSala;
    private $modelServAtencionMedica;
    /*
    private $_myAttributes=[];


    public function setAttributes($values, $safeOnly = false){
        $this->_myAttributes = $values;
        parent::setAttributes($values,$safeOnly);
    }

    public function getAttributes($names = null)
    {
        //var_dump($this->_myAttributes);
        return $this->_myAttributes;
    }
    */
    private $modelServClinico;

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
            'monto' => 'MONTO',

            'condiciones_ex' => 'CONDICIONES',
            'id_cat_ex' => 'ID DE CATEGORIA EXTERNA',
            'tipo_atencion' => 'TIPO ATENCION',
            'id_serv' => 'Servicio',
        );
    }

    private function saveServicio()
    {
        $this->modelServicio->save();
        $this->_idServicio = $this->modelServicio->id_serv;
        return true;
    }

    private function savePrecio()
    {
        $this->modelPrecio->id_serv = $this->_idServicio;
        if ($this->modelServicio->precio != null) {
            if ($this->modelServicio->precio->monto != $this->monto) {
                $this->modelServicio->precio->save();
                $this->modelPrecio->save();
            }
        } else {
            $this->modelPrecio->save();
        }

        return true;
    }

    private function loadServicioPrecio($id = null)
    {
        if ($id === null)
            $this->modelServicio = new Servicio();
        else {
            $this->modelServicio = Servicio::model()->findByPk($id);
            if ($this->modelServicio === null)
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        $this->modelServicio->setAttributes($this->getAttributes(), false);
        $this->modelPrecio = new Precio();
        $this->modelPrecio->monto = $this->monto;
    }

    public function saveExamen($id = null)
    {
        $this->modelServExamen = ($id == null) ? new ServExamen() : ServExamen::model()->findByPk($id);
        $this->modelServExamen->setAttributes($this->getAttributes(), false);
        $this->loadServicioPrecio($id);

        if ($this->validar([$this->modelServicio, $this->modelPrecio, $this->modelServExamen])) {
            $this->saveServicio();
            $this->savePrecio();
            if ($id == null)
                $this->modelServExamen->id_serv = $this->_idServicio;
            if ($this->modelServExamen->save())
                return true;
            return false;
        }
    }

    public function saveTipoSala($id = null){
        $this->modelServTSala = ($id == null)? new ServTipoSala():ServTipoSala::model()->findByPk($id);
        $this->modelServTSala->setAttributes($this->getAttributes(),false);
        $this->loadServicioPrecio($id);

        if($this->validar([$this->modelServicio,$this->modelPrecio,$this->modelServTSala])){
            $this->saveServicio();
            $this->savePrecio();
            if($id == null)
                $this->modelServTSala->id_serv = $this->_idServicio;
            if ($this->modelServTSala->save())
                return true;
            return false;
        }
        return false;
    }


    public function saveServicioClinico($id = null)
    {
        $this->modelServClinico = ($id == null) ? new ServClinico() : ServClinico::model()->findByPk($id);
        $this->modelServClinico->setAttributes($this->getAttributes(), false);
        $this->loadServicioPrecio($id);
        if ($this->validar([$this->modelServicio, $this->modelPrecio, $this->modelServClinico])) {
            $this->saveServicio();
            $this->savePrecio();
            if ($id == null)
                $this->modelServClinico->id_serv = $this->_idServicio;
            if ($this->modelServClinico->save())
                return true;
            return false;
        }
    }

    public function saveAtencionMedica($id = null)
    {
        $this->modelServAtencionMedica = ($id == null) ? new ServAtencionMedica() : ServAtencionMedica::model()->findByPk($id);
        $this->modelServAtencionMedica->setAttributes($this->getAttributes(), false);
        $this->loadServicioPrecio($id);
        if ($this->validar([$this->modelServicio, $this->modelPrecio, $this->modelServAtencionMedica])) {
            $this->saveServicio();
            $this->savePrecio();
            if ($id == null)
                $this->modelServAtencionMedica->id_serv = $this->_idServicio;
            if ($this->modelServAtencionMedica->save())
                return true;
            return false;
        }
    }

    /*public function saveServicio2()
    {
        $trans = Yii::app()->db->beginTransaction();
        try {

            $trans->commit();
        } catch (Exception $e) {
            throw new CHttpException(500, $e->getMessage());
            $trans->rollback();
        }
        return true;
    }*/

    public static function getTypeServicioOptions()
    {
        $array = array(0 => "Usos", 1 => "Etc");
        return $array;
    }

    private function validar($modelList = [])
    {
        foreach ($modelList as $model) {
            $model->validate();
            $this->addErrors($model->getErrors());
        }
        if ($this->hasErrors())
            return false;
        return true;
    }

    public function loadData($id)
    {
        $servicio = Servicio::model()->findByPk($id);
        if ($servicio === null)
            throw new CHttpException(404, 'Ha ocurrido un problema con la solicitud.');
        $this->setAttributes($servicio->getAttributes(), false);
        $precio = $servicio->precio;
        if ($precio === null)
            throw new CHttpException(404, 'Ha ocurrido un problema con la solicitud.');
        $this->setAttributes($precio->getAttributes(), false);

        //ServExamen
        //throw new CHttpException(404, 'The requested page does not exist.');
        $this->setAttributes($precio->getAttributes(array('monto')), false);
        $servExamen = ServExamen::model()->findByPk($id);
        if ($servExamen != null)
            $this->setAttributes($servExamen->getAttributes(), false);

        //Serv Tipo Sala
        $servTSala = ServTipoSala::model()->findByPk($id);
        if ($servTSala != null)
            $this->setAttributes($servTSala->getAttributes(), false);
        $servAtencionMedica = ServAtencionMedica::model()->findByPk($id);
        if ($servAtencionMedica != null)
            $this->setAttributes($servAtencionMedica->getAttributes(), false);
    }

    public function getAtencionMedica()
    {
        return array(
            '0' => 'ELIJA TIPO DE ATENCION',
            '1' => 'AMBULATORIA',
            '2' => 'EMERGENCIA',
            '3' => 'DOMICILIARIA',
        );
    }
}

?>
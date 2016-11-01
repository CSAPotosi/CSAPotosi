<?php

class PrestacionServiciosController extends Controller
{
    private $_internacion = null;
    public function filters()
    {
        return [
            'internacionContext + createForInter, indexForInter'
        ];
    }

    public function actionIndexForInter(){
        $this->menu = OptionsMenu::menuInternacion(['i_id'=>$this->_internacion->id_inter],['internacion','listServicio']);

        $this->render('indexForInter',['iModel'=>$this->_internacion]);
    }

    public function actionCreateForInter(){
        $this->menu = OptionsMenu::menuInternacion(['i_id'=>$this->_internacion->id_inter],['internacion','addServicio']);

        if(isset($_POST['DetallePrestacion'])){
            foreach ($_POST['DetallePrestacion'] as $itemPres){
                $tempPres = new DetallePrestacion();
                $tempPres->attributes = $itemPres;
                $tempPres->id_prestacion = $this->_internacion->prestaciones->id_prestacion;
                $tempPres->save();
            }
            $this->redirect(['prestacionServicios/indexForInter','i_id'=>$this->_internacion->id_inter]);
        }
        return $this->render('createForInter',['iModel'=> $this->_internacion]);
    }

    public function actionPrueba(){
        if(isset($_POST['ajax'])){
            echo 'envio por ajax';
            Yii::app()->end();
        }
    }

    public function filterInternacionContext($filterChain){
        if(isset($_GET['i_id']))
            $this->loadInternacion($_GET['i_id']);
        else
            throw new CHttpException(404, 'No ha especificado una internacion valida, vuelva a intentarlo');
        $filterChain->run();
    }

    protected function loadInternacion($internacionId){
        if($this->_internacion == null){
            $this->_internacion = Internacion::model()->findByPk($internacionId);
            if($this->_internacion == null)
                throw new CHttpException(404,'Ha ocurrido un error en la solicitud.');
        }
        return $this->_internacion;
    }

    protected function ajaxValidation($model){
        if(isset($_POST['ajax'])){
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
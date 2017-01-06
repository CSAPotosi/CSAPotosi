<?php

class VitalesController extends Controller
{
    private $_historial = null;
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            'historialContext'
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index'),
                'roles' => array('vitalesIndex'),
            ),
            array('allow',
                'actions' => array('create'),
                'roles' => array('vitalesCreate'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuHistorial(['h_id'=>$this->_historial->id_historial],['historial','vitales']);
        $vital_list = $this->loadForm();
        $this->render('index',['historial'=>$this->_historial,'vital_list'=>$vital_list]);
	}

    public function actionCreate(){
        $this->menu = OptionsMenu::menuHistorial(['h_id'=>$this->_historial->id_historial],['historial','vitales']);
        $vital_list = $this->loadForm();
        if(isset($_POST['SignoVital'])){
            if($this->validar($vital_list)){
                foreach ($vital_list as $vital){
                    if($vital->valor_sv!="")
                        $vital->save();
                }
                $this->redirect(['index','h_id'=>$this->_historial->id_historial]);
            }
        }
        $this->render('index',['historial'=>$this->_historial,'vital_list'=>$vital_list]);
    }

    public function filterHistorialContext($filterChain){
        if(isset($_GET['h_id'])){
            $this->loadHistorial($_GET['h_id']);
        }
        else
            throw new CHttpException(404, 'No ha especificado un historial valido, vuelva a intentarlo');
        $filterChain->run();
    }

    protected function loadHistorial($historialId){
        if($this->_historial == null){
            $this->_historial = HistorialMedico::model()->findByPk($historialId);
            if($this->_historial == null)
                throw new CHttpException(404, 'Ha ocurrido un error en la solicitud.');
        }
        return $this->_historial;
    }

    protected function loadForm(){
        $formList = [];
        if(isset($_POST['SignoVital'])&&is_array($_POST['SignoVital'])){
            foreach ($_POST['SignoVital'] as $parametro){
                $vital = new SignoVital();
                $vital->attributes = $parametro;
                $vital->id_historial = $this->_historial->id_historial;
                $formList[] = $vital;
            }
        }else{

            $parametros = Parametro::model()->findAll("tipo_par = 1");
            if($parametros){
                foreach ($parametros as $parametro){
                    $vital = new SignoVital();
                    $vital->id_par = $parametro->id_par;
                    $formList[] = $vital;
                }
            }
        }

        return $formList;
    }

    private function validar($lista = []){
        $flag = true;
        foreach ($lista as $item){
            $flag = $flag && $item->validate();
        }
        return $flag;
    }
}
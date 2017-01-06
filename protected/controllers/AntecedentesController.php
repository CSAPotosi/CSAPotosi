<?php

class AntecedentesController extends Controller
{
    private $_historial = null;

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            'historialContext',
        );
    }
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index'),
                'roles' => array('antecedentesIndex'),
            ),
            array('allow',
                'actions' => array('create'),
                'roles' => array('antecedentesCreate'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }
	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuHistorial(['h_id'=>$this->_historial->id_historial],['historial','antecedentes_Index']);
        $antecedente_list = $this->loadForm();
		$this->render('index',['historial'=>$this->_historial,'antecedente_list'=>$antecedente_list]);
	}

    public function actionCreate(){
        $this->menu = OptionsMenu::menuHistorial(['h_id'=>$this->_historial->id_historial],['historial','antecedentes_Index']);
        $antecedente_list = $this->loadForm();
        if(isset($_POST['Antecedente'])){
            if($this->validar($antecedente_list)){
                foreach ($antecedente_list as $antecedente){
                    if($antecedente->valor_ant!="")
                        $antecedente->save();
                }
                $this->redirect(['index','h_id'=>$this->_historial->id_historial]);
            }
        }
        $this->render('index',['historial'=>$this->_historial,'antecedente_list'=>$antecedente_list]);
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
        if(isset($_POST['Antecedente'])&&is_array($_POST['Antecedente'])){
            foreach ($_POST['Antecedente'] as $parametro){
                $antecedente = new Antecedente();
                $antecedente->attributes = $parametro;
                $antecedente->id_historial = $this->_historial->id_historial;
                $formList[] = $antecedente;
            }
        }else{

            $parametros = Parametro::model()->findAll("tipo_par = 2");
            if($parametros){
                foreach ($parametros as $parametro){
                    $antecedente = new Antecedente();
                    $antecedente->id_par = $parametro->id_par;
                    $formList[] = $antecedente;
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
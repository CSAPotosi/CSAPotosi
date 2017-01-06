<?php

class EvolucionController extends Controller
{
    private $_diagnostico = null;

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            'diagnosticoContext'
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('create'),
                'roles' => array('evolucionCreate'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }
	public function actionCreate(){
        $this->menu = OptionsMenu::menuDiagnostico(['d_id'=>$this->_diagnostico->id_diag],['diagnostico','evolucion_Crear']);

        $eModel = new Evolucion();
        $eModel->id_diag = $this->_diagnostico->id_diag;
        if(isset($_POST['Evolucion'])){
            $eModel->attributes = $_POST['Evolucion'];
            if($eModel->save())
                $this->redirect(['create','d_id'=>$this->_diagnostico->id_diag]);
        }
        $this->render('create',['eModel'=>$eModel,'dModel' => $this->_diagnostico]);
    }

    public function filterDiagnosticoContext($filterChain){
        if(isset($_GET['d_id']))
            $this->loadDiagnostico($_GET['d_id']);
        else
            throw new CHttpException(404,'No ha especificado un diagnostico valido, vuelva a intentarlo');
        $filterChain->run();
    }

    protected function loadDiagnostico($d_id){
        if($this->_diagnostico == null){
            $this->_diagnostico = Diagnostico::model()->findByPk($d_id);
            if($this->_diagnostico == null)
                throw new CHttpException(404,'Ha ocurrido un error en la solicitud.');
        }
        return $this->_diagnostico;
    }
}
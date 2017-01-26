<?php

class DiagnosticoController extends Controller
{
    private $_historial = null;
    private $_diagnostico = null;

    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            'historialContext + create',
            'diagnosticoContext - create'
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('create'),
                'roles' => array('diagnosticoCreate'),
            ),
            array('allow',
                'actions' => array('view'),
                'roles' => array('diagnosticoView'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionCreate(){
        $this->menu = OptionsMenu::menuHistorial(['h_id'=>$this->_historial->id_historial], ['historial','diagnostico_Crear']);
        $dcList = [];
        $diagnosticoModel = new Diagnostico();
        $diagnosticoModel->id_historial = $this->_historial->id_historial;
        if($this->_historial->internacionActual){
            $diagnosticoModel->tipo = 1;
        }
        if(isset($_POST['Diagnostico'])){
            $dcList = $this->getItemsCie();
            $diagnosticoModel->attributes = $_POST['Diagnostico'];
            if($diagnosticoModel->save()){
                foreach ($dcList as $dcItem){
                    $dcItem->id_diag = $diagnosticoModel->id_diag;
                    $dcItem->save();
                }
                return $this->redirect(['view','d_id'=>$diagnosticoModel->id_diag]);
            }
        }
        $this->render('create',['diagnosticoModel'=>$diagnosticoModel, 'historialModel'=>$this->_historial,'dcList'=>$dcList]);
    }

    public function actionView(){
        $this->menu = OptionsMenu::menuDiagnostico(['d_id'=>$this->_diagnostico->id_diag],['diagnostico','diagnostico_Ver']);
        $this->render('view',['dModel'=>$this->_diagnostico]);
    }

    public function filterHistorialContext($filterChain){
        if(isset($_GET['h_id'])){
            $this->loadHistorial($_GET['h_id']);
        }
        else
            throw new CHttpException(404, 'No ha especificado un historial valido, vuelva a intentarlo');
        $filterChain->run();
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

    protected function loadHistorial($historialId){
        if($this->_historial == null){
            $this->_historial = HistorialMedico::model()->findByPk($historialId);
            if($this->_historial == null)
                throw new CHttpException(404, 'Ha ocurrido un error en la solicitud.');
        }
        return $this->_historial;
    }

    private function getItemsCie(){
        $items = [];
        if(isset($_POST['DiagnosticoCie'])){
            foreach ($_POST['DiagnosticoCie'] as $dcItem){
                $dcModel = new DiagnosticoCie();
                $dcModel->attributes = $dcItem;
                $items[]=$dcModel;
            }
        }
        return $items;
    }

}
<?php

class TratamientoController extends Controller
{
    private $_diagnostico = null;
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
            'diagnosticoContext - getViewAjax'
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('index'),
                'roles' => array('tratamientoIndex'),
            ),
            array('allow',
                'actions' => array('create'),
                'roles' => array('tratamientoCreate'),
            ),
            array('allow',
                'actions' => array('getViewAjax'),
                'roles' => array('tratamientoGetViewAjax'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex(){
        $this->menu = OptionsMenu::menuDiagnostico(['d_id'=>$this->_diagnostico->id_diag],['diagnostico','indexTratamiento']);

        $this->render('index', ['dModel'=>$this->_diagnostico]);
    }
	public function actionCreate()
	{
        $this->menu = OptionsMenu::menuDiagnostico(['d_id'=>$this->_diagnostico->id_diag],['diagnostico','addTratamiento']);

        $tModel = new Tratamiento();
        $tModel->id_diag = $this->_diagnostico->id_diag;
        $rList = [];
        if(isset($_POST['Tratamiento'])){
            $tModel->attributes = $_POST['Tratamiento'];
            $rList = $this->loadRecetas();
            if($this->validateList(array_merge([$tModel],$rList))){
                if($tModel->save()){
                    foreach ($rList as $rItem){
                        $rItem->id_trat = $tModel->id_trat;
                        $rItem->save();
                    }
                    return $this->redirect(['tratamiento/index','d_id'=>$this->_diagnostico->id_diag]);
                }
            }
        }
		$this->render('create', ['dModel' => $this->_diagnostico, 'tModel'=>$tModel, 'rList'=>$rList]);
	}

    public function actionGetViewAjax($t_id = 0){
        $tModel = Tratamiento::model()->findByPk($t_id);
        $this->renderPartial('_detailTratamiento',['tModel'=>$tModel]);
    }

    private function loadRecetas(){
        $rList = [];
        if(isset($_POST['Receta']) && is_array($_POST['Receta'])){
            foreach ($_POST['Receta'] as $rItem){
                $tempR = new Receta();
                $tempR->attributes = $rItem;
                $rList[]=$tempR;
            }
        }
        return $rList;
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

    public function validateList($items = []){
        $flag = true;
        foreach ($items as $item){
            $flag = $flag && $item->validate();
        }
        return $flag;
    }
}
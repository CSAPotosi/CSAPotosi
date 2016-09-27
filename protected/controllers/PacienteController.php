<?php
class PacienteController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions' => array('create'),
				'roles' => array('createPaciente'),
			),
			array('allow',
				'actions' => array('index', 'GetPatientListAjax'),
				'roles' => array('indexPaciente'),
			),
			array('deny',  // deny all users
				'users' => array('*'),
			),
		);
	}

	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuPaciente();
		$this->render('index');
	}

	//AJAX
	public function actionGetPatientListAjax(){
		$page=$_POST['page']*Yii::app()->params['itemListLimit'];
		$query=$_POST['query'];
		$status=$_POST['status'];
		$pacienteList=Paciente::getPatientList($page,$query,$status);
		$this->renderPartial('_patientListView',['pacienteList'=>$pacienteList]);
	}

	public function actionCreate()
	{
		$modelPerson = new PersonaForm();
		$historial = new HistorialMedico();
		if (isset($_POST['PersonaForm'])) {
			$modelPerson->attributes = $_POST['PersonaForm'];
			//$modelPerson->scenario='paciente';
			$id_paciente = $modelPerson->savePaciente();
			if ($id_paciente != 0)
				
				$this->redirect(["historialMedico/index", 'id_persona' => $id_paciente]);
		}
		$this->render('create', array('modelPerson' => $modelPerson));
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}
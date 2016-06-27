<?php
class PacienteController extends Controller
{
	public $menu=[
		['title'=>'LISTA', 'icon'=>'fa-list', 'url'=>['paciente/index']],
		['title'=>'NUEVO', 'icon'=>'fa-plus', 'url'=>['paciente/create']]
	];

	public function actionIndex()
	{
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
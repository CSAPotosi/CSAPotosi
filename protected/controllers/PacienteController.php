<?php

class PacienteController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	//AJAX
	public function actionGetPacientListAjax(){
		$page=$_POST['page']*6;
		$query=$_POST['query'];
		$status=$_POST['status'];
		$pacienteList=Paciente::getPacientList($page,$query,$status);
		$this->renderPartial('_pacientListView',['pacienteList'=>$pacienteList]);
	}

	public function actionCreate()
	{
		$modelPerson = new PersonaForm();
		if (isset($_POST['PersonaForm'])) {
			$modelPerson->attributes = $_POST['PersonaForm'];
			//$modelPerson->scenario='paciente';
			if ($modelPerson->savePaciente())
				$this->redirect(array('viewHistorial'));
		}
		$this->render('create', array('modelPerson' => $modelPerson));
	}

	public function actionViewHistorial()
	{
		$this->render('viewHistorial');
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
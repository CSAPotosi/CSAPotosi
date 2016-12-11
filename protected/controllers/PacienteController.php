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
				'roles' => array('pacienteCreate'),
			),
			array('allow',
				'actions' => array('index'),
				'roles' => array('pacienteIndex'),
			),
			array('allow',
				'actions' => array('GetPatientListAjax'),
				'roles' => array('pacienteGetPacientListAjax')
			),
			array('allow',
				'actions' => array('DetallePaciente'),
				'roles' => array('pacienteView'),
			),
			array('allow',
				'actions' => array('SeguroPaciente'),
				'roles' => array('pacienteSeguro'),
			),
			array('allow',
				'actions' => array('Update'),
				'roles' => array('pacienteUpdate'),
			),
			array('allow',
				'actions' => array('SeguroCreate'),
				'roles' => array('pacienteSeguroCreate'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}

	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuPaciente([],['pacientes','index']);
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

    public function actionGetMinimalListAjax(){
		$pacienteList = Paciente::model()->findAll([
			'limit' => 10
		]);
		$this->renderPartial('_minimalPatientListView', ['pacienteList' => $pacienteList]);
    }

	public function actionCreate()
	{
		$this->menu = OptionsMenu::menuPaciente([], ['pacientes', 'index']);
		$modelPerson = new PersonaForm();
		if (isset($_POST['PersonaForm'])) {
			$modelPerson->setAttributes($_POST['PersonaForm'], false);
			$id_paciente = $modelPerson->savePaciente();
			if ($id_paciente != 0)
				$this->redirect(["historialMedico/index", 'id_paciente' => $id_paciente]);
		}
		$this->render('create', array('modelPerson' => $modelPerson));
	}

	public function actionDetallePaciente($id)
	{
		$this->menu = OptionsMenu::menuPaciente(['id_paciente' => $id], ['paciente', 'detallePaciente']);
		$paciente = Paciente::model()->findByPk($id);
		$this->render('detallePaciente', ['paciente' => $paciente]);
	}

	public function actionUpdate($id)
	{
		$this->menu = OptionsMenu::menuPaciente(['id_paciente' => $id], ['paciente', 'updatePaciente']);
		$modelPerson = new PersonaForm();
		$persona = Persona::model()->findByPk($id);
		if (isset($_POST['PersonaForm'])) {
			$modelPerson->setAttributes($_POST['PersonaForm'], false);
			$id_paciente = $modelPerson->savePaciente($id);
			if ($id_paciente != 0) {
				$this->redirect(["paciente/DetallePaciente", 'id' => $id_paciente]);
			}
		}
		$this->render('update', array('modelPerson' => $modelPerson, 'persona' => $persona));
	}

	public function actionSeguroPaciente($id)
	{
		$this->menu = OptionsMenu::menuPaciente(['id_paciente' => $id], ['paciente', 'seguroPaciente']);
		$paciente = Paciente::model()->findByPk($id);
		$listSeguro = AseguradoConvenio::model()->findAll([
			'condition' => "id_paciente=$id",
		]);
		$this->render('SeguroPaciente', array(
			'paciente' => $paciente,
			'listAsegurado' => $listSeguro
		));
	}

	public function actionSeguroCreate($id)
	{
		$this->menu = OptionsMenu::menuPaciente(['id_paciente' => $id], ['paciente', 'updateCreate']);
		$paciente = Paciente::model()->findByPk($id);
		$modelAsegurado = new AseguradoConvenio();
		$listPaciente = Paciente::model()->findAll([
			'condition' => "id_paciente!=$id",
		]);
		if (isset($_POST['AseguradoConvenio'])) {
			$modelAsegurado->attributes = $_POST['AseguradoConvenio'];
			if ($modelAsegurado->save())
				$this->redirect(['seguroPaciente', 'id' => $id]);
		}
		$this->render('seguroCreate', [
			'paciente' => $paciente,
			'modelAsegurado' => $modelAsegurado,
			'listPaciente' => $listPaciente,
		]);
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
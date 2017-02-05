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
                'actions'=>array('getMinimalListAjax'),
                'roles'=>array('pacienteGetMinimalListAjax')
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
			array('allow',
				'actions' => array('Emergencia'),
				'roles' => array('pacienteEmergencia'),
			),
			array('allow',
				'actions' => array('EditConvenio'),
				'roles' => array('pacienteEditConvenio'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}

	public function actionIndex()
	{
		$this->menu = OptionsMenu::menuPaciente([], ['pacientes', 'Lista Paciente']);
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
		$this->menu = OptionsMenu::menuPaciente([], ['pacientes', 'Crear Paciente']);
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
		$this->menu = OptionsMenu::menuPaciente(['id_paciente' => $id], ['paciente', 'Detalle Paciente']);
		$paciente = Paciente::model()->findByPk($id);
		$this->render('detallePaciente', ['paciente' => $paciente]);
	}

	public function actionUpdate($id)
	{
		$this->menu = OptionsMenu::menuPaciente(['id_paciente' => $id], ['paciente', 'Actualizar Paciente']);
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
		$this->menu = OptionsMenu::menuPaciente(['id_paciente' => $id], ['paciente', 'Seguro Paciente']);
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
		$this->menu = OptionsMenu::menuPaciente(['id_paciente' => $id], ['paciente', 'Seguro Create']);
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

	public function actionEmergencia()
	{
		$this->menu = OptionsMenu::menuPaciente([], ['pacientes', 'Paciente Emergencia']);
		$modelPerson = new PersonaForm();
		if (isset($_POST['PersonaForm'])) {
			$modelPerson->setAttributes($_POST['PersonaForm'], false);
			$id_paciente = $modelPerson->savePaciente();
			if ($id_paciente != 0)
				$this->redirect(["historialMedico/index", 'id_paciente' => $id_paciente]);
		}
		$this->render('formEmergencia', [
			'modelPerson' => $modelPerson
		]);
	}

	public function actionEditConvenio($id)
	{
		$convenio = AseguradoConvenio::model()->findByPk($id);
		$paciente = $convenio->paciente->id_paciente;
		$this->menu = OptionsMenu::menuPaciente(['id_ase_con' => $id, 'id_paciente' => $paciente], ['convenio', 'Editar Convenio']);
		$modelAsegurado = AseguradoConvenio::model()->findByPk($id);
		$listaPaciente = Paciente::model()->findAll([
			'condition' => "id_paciente!=$paciente"
		]);
		if (isset($_POST['AseguradoConvenio'])) {
			$modelAsegurado->attributes = $_POST['AseguradoConvenio'];
			$valor = false;
			if ($modelAsegurado->activo == true) {
				$listaConvenio = AseguradoConvenio::model()->findAll([
					'condition' => "id_ase_con!=$id",
				]);
				foreach ($listaConvenio as $item):
					if ($item->activo) {
						$valor = true;
						break;
					}
				endforeach;
			}
			if ($valor)
				Yii::app()->user->setFlash('REPETIDO', 'YA EXITE UN CONVENIO ACTIVO');
			else {
				$modelAsegurado->save();
				$this->redirect(['seguroPaciente', 'id' => $paciente]);
			}
		}
		$this->render("updateConvenio", [
			'paciente' => $modelAsegurado->paciente,
			'modelAsegurado' => $modelAsegurado,
			'listPaciente' => $listaPaciente
		]);

	}
}
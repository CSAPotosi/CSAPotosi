<?php

class ServicioController extends Controller
{
	public function actionIndex($grupo='examen', $tipo = 1)
	{
		switch ($grupo){
			case 'examen':
				$this->examenIndex($tipo);
				break;
			case 'clinico':
				$this->clinicoIndex(1);
				break;
			case 'sala':
				$this->salaIndex();
				break;
			case 'atencionMedica':
				$this->atencionMedicaIndex($tipo);
				break;
			default:
				echo 'asdassd';
				break;
		}//$this->render('index');
	}

	public function actionCreate($grupo = 'examen', $tipo = 1)
	{
		switch ($grupo) {
			case 'examen':
				$this->examenCreate($tipo);
				break;
			case 'clinico':
				$this->clinicoCreate();
				break;
			case 'sala':
				$this->salaCreate();
				break;
			case 'atencionMedica':
				$this->atencionMedicaCreate($tipo);
				break;
			default:
				throw new CHttpException(404,'Ha ocurrido un problema con la solicitud.');
				break;
		}//$this->render('index');
	}

	public function actionUpdate($grupo = 'examen', $tipo = 1, $id)
	{
		switch ($grupo) {
			case 'examen':
				$this->examenUpdate($tipo, $id);
				break;
			case 'clinico':
				$this->clinicoUpdate(1);
				break;
			case 'sala':
				$this->salaUpdate($id);
				break;
			case 'atencionMedica':
				$this->atencionMedicaUpdate($tipo, $id);
				break;
			default:
				throw new CHttpException(404,'Ha ocurrido un problema con la solicitud.');
				break;
		}
	}

	public function actionView($grupo = 'examen', $tipo = 1, $id = null){
		switch ($grupo) {
			case 'examen':
				echo 'falta';
				break;
			case 'clinico':
				echo 'falta';
				break;
			case 'sala':
				$this->salaView($id);
				break;
			case 'atencionMedica':
				echo 'fa;ta';
				break;
			default:
				echo 'asdassd';
				break;
		}//$this->render('index');
	}

	private function examenIndex($tipo = 1)
	{


		$listServicio = ServExamen::model()->with('categoria')->findAll(array(
			'condition' => "tipo_ex = :tipo and activo=true",
			'params' => [':tipo' => $tipo]
		));

		$this->render('examenIndex', array('listServicio' => $listServicio, 'dataUrl' => ['grupo' => 'examen', 'tipo' => $tipo]));
	}

	private function clinicoIndex($tipo=1){
		echo 'en servicios clinicos';
	}

	private function salaIndex(){
		$tSalaList = ServTipoSala::model()->findAll();
		$this->render('salaIndex', ['tSalaList'=>$tSalaList, 'dataUrl'=>['grupo'=>'sala','tipo'=>0] ]);
	}


////////////////////////////////////////////////
	private function examenCreate($tipo = 1)
	{
		$examen = new ServicioForm;
		$categoria = CategoriaServicioExamen::model()->findAll("activo=true and tipo_ex={$tipo}");
		$entidad = Entidad::model()->findAll();
		if (isset($_POST['ServicioForm'])) {
			$examen->setAttributes($_POST['ServicioForm'],false);
			if ($examen->saveExamen())
				$this->redirect(array('index', 'grupo' => 'examen', 'tipo' => $tipo));
		}
		$this->render('examenCreate', array(
			'servicio' => $examen,
			'categoria' => $categoria,
			'entidad' => $entidad,
			'dataUrl' => array("grupo" => "examen", "tipo" => $tipo),
		));
	}

	private function clinicoCreate()
	{
		$clinico = new ServicioForm;
		$categoria = CategoriaServClinico::model()->findAll("activo=true");
		$entidad = Entidad::model()->findAll();
		if (isset($_POST['ServicioForm'])) {
			$clinico->setAttributes($_POST['ServicioForm'], false);
			if ($clinico->saveExamen())
				$this->redirect(array('index', 'grupo' => 'examen'));
		}
		$this->render('clinicoCreate', array(
			'servicio' => $clinico,
			'categoria' => $categoria,
			'entidad' => $entidad,
			'dataUrl' => array("grupo" => "clinico"),
		));
	}
	public function examenUpdate($tipo = 1, $id)
	{
		$examen = new ServicioForm();
		$examen->loadData($id);
		$categoria = CategoriaServicioExamen::model()->findAll("activo=true and tipo_ex={$tipo}");
		$entidad = Entidad::model()->findAll();
		if (isset($_POST['ServicioForm'])) {
			$examen->setAttributes($_POST['ServicioForm'], false);
			if ($examen->saveExamen($id))
				$this->redirect(array('index', 'grupo' => 'examen', 'tipo' => $tipo));
		}
		$this->render('examenUpdate', array(
			'servicio' => $examen,
			'categoria' => $categoria,
			'entidad' => $entidad,
			'dataUrl' => array("grupo" => "examen", "tipo" => $tipo),
		));
	}

	private function atencionMedicaIndex($tipo)
	{
		$servicio = new Servicio();
		$listSpecialty = Especialidad::model()->findAll();
		$this->render('atencionMedicaIndex', array('listSpecialty' => $listSpecialty, 'servicio' => $servicio, 'dataUrl' => ['grupo' => 'atencionMedica', 'tipo' => $tipo]));
	}

	private function atencionMedicaCreate($tipo)
	{
		$medicoEspecialidad = MedicoEspecialidad::model()->findByPk($tipo);
		$atencionMedica = new ServicioForm();
		$entidad = Entidad::model()->findAll();
		if (isset($_POST['ServicioForm'])) {
			$atencionMedica->setAttributes($_POST['ServicioForm'], false);
			if ($atencionMedica->saveAtencionMedica())
				$this->redirect(['index', 'grupo' => 'atencionMedica']);
		}
		$this->render('atencionMedicaCreate', array(
			'atencionMedica' => $atencionMedica,
			'dataUrl' => ['grupo' => 'atencionMedica'],
			'entidad' => $entidad,
			'MedicoEspecialidad' => $medicoEspecialidad
		));
	}

	private function atencionMedicaUpdate($tipo, $id)
	{
		$medicoEspecialidad = MedicoEspecialidad::model()->findByPk($tipo);
		$atencionMedica = new ServicioForm();
		$atencionMedica->loadData($id);
		$entidad = Entidad::model()->findAll();
		if (isset($_POST['ServicioForm'])) {
			$atencionMedica->setAttributes($_POST['ServicioForm'], false);
			if ($atencionMedica->saveAtencionMedica($id))
				$this->redirect(['index', 'grupo' => 'atencionMedica', 'tipo' => $tipo]);
		}
		$this->render('atencionMedicaEdit', array(
			'dataUrl' => ['grupo' => 'atencionMedica'],
			'atencionMedica' => $atencionMedica,
			'MedicoEspecialidad' => $medicoEspecialidad,
			'entidad' => $entidad));
	}
	public function loadModel($id)
	{
		$model = Servicio::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/*private function clinicoCreate($tipo = 1)
	{
		echo 'en servicios clinicos';
	}
*/
	private function salaCreate()
	{
		$tSala = new ServicioForm();
		if(isset($_POST['ServicioForm'])){
			$tSala->setAttributes($_POST['ServicioForm'],false);
			if($tSala->saveTipoSala())
				$this->redirect(['index','grupo'=>'sala']);
		}
		$this->render('salaCreate', ['tSala' => $tSala, 'dataUrl'=> ['grupo'=>'sala','tipo'=>0] ]);
	}

	private function salaUpdate($id = null){
		$tSala = new ServicioForm();
		$tSala->loadData($id);
		if(isset($_POST['ServicioForm'])){
			$tSala->setAttributes($_POST['ServicioForm'],false);
			if($tSala->saveTipoSala($id))
				$this->redirect(['index','grupo'=>'sala']);
		}

		$this->render('salaUpdate',['tSala'=>$tSala,'dataUrl' => ['grupo'=>'sala']]);
	}

	private function salaView($id = null){
		$tSala = ServTipoSala::model()->findByPk($id);
		$itemSalaModel = new Sala();
		$this->render('salaView',['tSala'=>$tSala,'itemSalaModel'=>$itemSalaModel]);
	}

	public function actionSalaAddItem($id){
		$itemSalaModel = new Sala();
		$this->ajaxValidation($itemSalaModel);
		if(isset($_POST['Sala'])){
			$itemSalaModel->attributes = $_POST['Sala'];
			$itemSalaModel->id_t_sala = $id;
			if($itemSalaModel->save())
				$this->redirect(['view','grupo'=>'sala','id'=>$id]);
		}
		throw new CHttpException(404,'Ha ocurrido un error en la solicitud.');
	}

	public function actionSalaEditItem($id){
		$itemSalaModel = Sala::model()->findByPk($id);
		$this->ajaxValidation($itemSalaModel);
		if(isset($_POST['Sala'])){
			$itemSalaModel->attributes = $_POST['Sala'];
			if($itemSalaModel->save())
				$this->redirect(['view','grupo'=>'sala','id'=>$itemSalaModel->id_t_sala]);
		}
		throw  new CHttpException(404,'Ha ocurrido un error en la solicitud.');
	}


	public function actionChangeStateServicio($id)
	{
		$servicio = Servicio::model()->findByPk($id);
		$servicio->activo = !$servicio->activo;
		$servicio->save();
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

	protected function ajaxValidation($model){
		if(isset($_POST['ajax'])){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
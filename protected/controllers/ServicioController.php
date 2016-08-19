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
				$this->atencionMedicaIndex();
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
				$this->atencionMedicaCreate();
				break;
			default:
				echo 'asdassd';
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
				$this->salaUpdate();
				break;
			case 'atencionMedica':
				$this->atencionMedicaUpdate();
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
		echo 'en servicio de salas';
	}

	private function atencionMedicaIndex(){
		echo 'en atencio medica';
	}

////////////////////////////////////////////////
	private function examenCreate($tipo = 1)
	{
		$examen = new ServicioForm;
		$categoria = CategoriaServicioExamen::model()->findAll("activo=true and tipo_ex={$tipo}");
		$entidad = Entidad::model()->findAll();
		if (isset($_POST['ServicioForm'])) {
			$examen->setAttributes($_POST['ServicioForm'], false);
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
		echo 'en servicio de salas';
	}

	private function atencionMedicaCreate()
	{
		echo 'en atencio medica';
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
}
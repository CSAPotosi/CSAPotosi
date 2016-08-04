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
				$this->clinicoCreate(1);
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


		$listServicio = ServExamen::model()->with('servExamenCategoria')->findAll(array(
			'condition' => "tipo_ex = :tipo",
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
		$servicio = new ServicioForm;
		$categoria = CategoriaServicioExamen::model()->findAll("activo=true and tipo_ex={$tipo}");
		if (isset($_POST['ServicioForm'])) {
			$servicio->attributes = $_POST['ServicioForm'];
			if ($servicio->validate())
				if ($servicio->saveServicio())
					$this->redirect(array('index', 'grupo' => 'examen', 'tipo' => $tipo));
		}
		$this->render('examenCreate', array(
			'servicio' => $servicio,
			'categoria' => $categoria,
			'dataUrl' => array("grupo" => "examen", "tipo" => $tipo),
		));
	}

	public function examenUpdate($tipo = 1, $id)
	{
		$servicio = $this->loadModel($id);
		$servicioForm = new ServicioForm;

		$servicioForm->cod_serv = $servicio->cod_serv;
		$servicioForm->nombre_serv = $servicio->nombre_serv;
		$servicioForm->unidad_medida = $servicio->unidad_medida;
		$servicioForm->precio_serv = $servicio->precio_serv;
		$servicioForm->tipo_cobro = $servicio->tipo_cobro;
		$servicioForm->activo = $servicio->activo;
		$servicioForm->condiciones_ex = $servicio->servExamen->condiciones_ex;

		$categoria = CategoriaServicioExamen::model()->findAll("activo=true and tipo_ex={$tipo}");
		if (isset($_POST['ServicioForm'])) {
			$servicio->attributes = $_POST['ServicioForm'];
			if ($servicio->save())
				$this->redirect(array('index', 'grupo' => 'examen', 'tipo' => $tipo));
		}
		$this->render('examenUpdate', array(
			'servicio' => $servicioForm,
			'categoria' => $categoria,
			'dataUrl' => array("grupo" => "examen", "tipo" => $tipo),
			'id' => $id,
		));
	}

	public function loadModel($id)
	{
		$model = Servicio::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	private function clinicoCreate($tipo = 1)
	{
		echo 'en servicios clinicos';
	}

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
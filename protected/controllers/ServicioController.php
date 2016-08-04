<?php

class ServicioController extends Controller
{
	public function actionIndex($grupo, $tipo = 2)
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

	private function examenIndex($tipo = 1)
	{


		$listServicio = ServExamen::model()->with('servExamenCategoria')->findAll(array(
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
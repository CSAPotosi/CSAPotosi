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

	private function examenIndex($tipo=1){
		echo 'en examen';
		//$this->render('examenIndex');
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
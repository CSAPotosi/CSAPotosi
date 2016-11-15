<?php

class ReporteCirugiaController extends Controller
{
	public function actionIndex()
	{
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['Report'])){
            $fec_ini = $_POST['Report']['fec_ini'];
            $fec_fin = $_POST['Report']['fec_fin'];
        }
        $cirugiaList = Cirugia::model()->findAll([
            'condition' => 'fec_inicio::DATE BETWEEN :fec_ini and :fec_fin',
            'order'=>'fec_inicio ASC',
            'params'=>[':fec_ini'=>$fec_ini, ':fec_fin'=>$fec_fin]
        ]);
		$this->render('index',['cirugiaList'=>$cirugiaList,'fec_ini'=>$fec_ini,'fec_fin'=>$fec_fin]);
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
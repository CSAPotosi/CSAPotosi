<?php

class CategoriaServicioController extends Controller
{


	public function actionIndex($grupo = 'examen',$tipo = 1)
	{
		switch ($grupo){
			case 'examen':
				$this->categoriaExamenIndex($tipo);
			break;
			default:
				throw new CHttpException(404,'La direccion solicitada no existe');
		}

	}

	private function categoriaExamenIndex($tipo = 1){
		$catExList = CategoriaServExamen::model()->findAll([
			'condition'=>'tipo_ex = :tipo_ex',
			'order'=>'activo DESC, id_cat_ex ASC',
			'params'=>[':tipo_ex'=>$tipo]
		]);

		$catExModel = new CategoriaServExamen();
		$this->render('categoriaExamenIndex',['catExList'=>$catExList,'catExModel'=>$catExModel, 'dataUrl'=>['tipo'=>$tipo, 'grupo'=>'examen'] ]);
	}

	public function actionCreate($grupo='examen',$tipo = 1){
		switch ($grupo){
			case 'examen':
				$this->categoriaExamenCreate($tipo);
				break;
			default:
				throw new CHttpException(404,'La direccion solicitada no existe');
		}
	}

	public function actionUpdate($grupo='examen', $tipo = 1,$id = 0){
		switch ($grupo){
			case 'examen':
				$this->categoriaExamenUpdate($tipo,$id);
				break;
			default:
				throw new CHttpException(404,'La direccion solicitada no existe');
		}
	}

	private function categoriaExamenCreate($tipo = 1){
		$catExModel = new CategoriaServExamen();

		$this->ajaxValidation($catExModel);

		$catExList = CategoriaServExamen::model()->findAll([
			'condition'=>'tipo_ex = :tipo_ex',
			'order'=>'activo DESC, id_cat_ex ASC',
			'params'=>[':tipo_ex'=>$tipo]
		]);

		if (isset($_POST['CategoriaServExamen'])) {
			$catExModel->attributes = $_POST['CategoriaServExamen'];
			if($catExModel->save())
				$this->redirect(['index','grupo'=>'examen','tipo'=>$tipo]);
		}

		$this->render('categoriaExamenIndex',['catExList'=>$catExList,'catExModel'=>$catExModel,'dataUrl'=>['tipo'=>$tipo,'grupo' =>'examen'] ]);
	}

	private function categoriaExamenUpdate($tipo = 1, $id = 0){
		$catExModel = CategoriaServExamen::model()->findByPk($id);

		$this->ajaxValidation($catExModel);

		$catExList = CategoriaServExamen::model()->findAll([
			'condition'=>'tipo_ex = :tipo_ex',
			'order'=>'activo DESC, id_cat_ex ASC',
			'params'=>[':tipo_ex'=>$tipo]
		]);

		if (isset($_POST['CategoriaServExamen'])) {
			$catExModel->attributes = $_POST['CategoriaServExamen'];
			if($catExModel->save())
				$this->redirect(['index','grupo'=>'examen','tipo'=>$tipo]);
		}

		$this->render('categoriaExamenIndex',['catExList'=>$catExList,'catExModel'=>$catExModel, 'dataUrl'=>['tipo'=>$tipo,'grupo' =>'examen'] ]);

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
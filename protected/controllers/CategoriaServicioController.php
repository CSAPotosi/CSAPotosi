<?php

class CategoriaServicioController extends Controller
{


	public function actionIndex($tipo = 1)
	{
		$this->categoriaExamenIndex($tipo);
	}

	private function categoriaExamenIndex($tipo = 1){
		$catExList = CategoriaServicioExamen::model()->findAll([
			'condition'=>'tipo_ex = :tipo_ex',
			'order'=>'activo DESC, id_cat_ex ASC',
			'params'=>[':tipo_ex'=>$tipo]
		]);

		$catExModel = new CategoriaServicioExamen();
		$this->render('categoriaExamenIndex',['catExList'=>$catExList,'catExModel'=>$catExModel, 'tipo'=>$tipo]);
	}

	public function actionCreate($tipo = 1){
		$this->categoriaExamenCreate($tipo);
	}

	public function actionUpdate($tipo = 1,$id = 0){
		$this->categoriaExamenUpdate($tipo,$id);
	}

	private function categoriaExamenCreate($tipo = 1){
		$catExModel = new CategoriaServicioExamen();

		$this->ajaxValidation($catExModel);

		$catExList = CategoriaServicioExamen::model()->findAll([
			'condition'=>'tipo_ex = :tipo_ex',
			'order'=>'activo DESC, id_cat_ex ASC',
			'params'=>[':tipo_ex'=>$tipo]
		]);

		if (isset($_POST['CategoriaServicioExamen'])){
			$catExModel->attributes = $_POST['CategoriaServicioExamen'];
			if($catExModel->save())
				$this->redirect(['index','tipo'=>$tipo]);
		}

		$this->render('categoriaExamenIndex',['catExList'=>$catExList,'catExModel'=>$catExModel, 'tipo'=>$tipo]);
	}

	private function categoriaExamenUpdate($tipo = 1, $id = 0){
		$catExModel = CategoriaServicioExamen::model()->findByPk($id);

		$this->ajaxValidation($catExModel);

		$catExList = CategoriaServicioExamen::model()->findAll([
			'condition'=>'tipo_ex = :tipo_ex',
			'order'=>'activo DESC, id_cat_ex ASC',
			'params'=>[':tipo_ex'=>$tipo]
		]);

		if (isset($_POST['CategoriaServicioExamen'])){
			$catExModel->attributes = $_POST['CategoriaServicioExamen'];
			if($catExModel->save())
				$this->redirect(['index','tipo'=>$tipo]);
		}

		$this->render('categoriaExamenIndex',['catExList'=>$catExList,'catExModel'=>$catExModel, 'tipo'=>$tipo]);

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
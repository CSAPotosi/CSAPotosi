<?php

class CategoriaServicioController extends Controller
{


	public function actionIndex($grupo = 'examen',$tipo = 1)
	{
		switch ($grupo){
			case 'examen':
				$this->categoriaExamenIndex($tipo);
				break;
			case 'clinico':
				$this->categoriaClinicoIndex();
				break;
			default:
				throw new CHttpException(404,'La direccion solicitada no existe');
		}
	}

	private function categoriaExamenIndex($tipo = 1){
		$this->menu = OptionsMenu::menuExamenLab(['tipo' => $tipo], ['examenLab', 'categorias']);
		$catExList = CategoriaServExamen::model()->findAll([
			'condition'=>'tipo_ex = :tipo_ex',
			'order'=>'activo DESC, id_cat_ex ASC',
			'params'=>[':tipo_ex'=>$tipo]
		]);

		$catExModel = new CategoriaServExamen();
		$this->render('categoriaExamenIndex',['catExList'=>$catExList,'catExModel'=>$catExModel, 'dataUrl'=>['tipo'=>$tipo, 'grupo'=>'examen'] ]);
	}

	private function categoriaClinicoIndex($tipo = 3)
	{
		$this->menu = OptionsMenu::menuExamenLab(['tipo' => $tipo], ['examenLab', 'categorias']);
		$catCliList = CategoriaServClinico::model()->findAll([
			'order' => 'activo DESC, id_cat_cli ASC'
		]);

		$catCliModel = new CategoriaServClinico();
		$this->render('categoriaClinicoIndex', ['catCliList' => $catCliList, 'catCliModel' => $catCliModel, 'dataUrl' => ['grupo' => 'clinico']]);
	}

	public function actionCreate($grupo='examen',$tipo = 1){
		switch ($grupo){
			case 'examen':
				$this->categoriaExamenCreate($tipo);
				break;
			case 'clinico':
				$this->categoriaClinicoCreate();
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
			case 'clinico':
				$this->categoriaClinicoUpdate($id);
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

	private function categoriaClinicoCreate()
	{
		$catCliModel = new CategoriaServClinico();

		$this->ajaxValidation($catCliModel);

		$catCliList = CategoriaServClinico::model()->findAll([
			'order' => 'activo DESC, id_cat_cli ASC',
		]);

		if (isset($_POST['CategoriaServClinico'])) {
			$catCliModel->attributes = $_POST['CategoriaServClinico'];
			if ($catCliModel->save())
				$this->redirect(['index', 'grupo' => 'clinico']);
		}

		$this->render('categoriaClinicoIndex', ['catCliList' => $catCliList, 'catCliModel' => $catCliModel, 'dataUrl' => ['grupo' => 'clinico']]);
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

	private function categoriaClinicoUpdate($id = 0)
	{
		$catCliModel = CategoriaServClinico::model()->findByPk($id);

		$this->ajaxValidation($catCliModel);

		$catCliList = CategoriaServClinico::model()->findAll([
			'order' => 'activo DESC, id_cat_cli ASC',
		]);

		if (isset($_POST['CategoriaServClinico'])) {
			$catCliModel->attributes = $_POST['CategoriaServClinico'];
			if ($catCliModel->save())
				$this->redirect(['index', 'grupo' => 'clinico']);
		}

		$this->render('categoriaClinicoIndex', ['catCliList' => $catCliList, 'catCliModel' => $catCliModel, 'dataUrl' => ['grupo' => 'clinico']]);

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
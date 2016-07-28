<?php

class CieController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionGetCategoryAjax(){
		$code = $_POST['code'];

		$categoryList = CategoriaCie::model()->findAll([
			'condition'=>'num_cap = :num_cap',
			'params'=>[':num_cap'=>$code]
		]);
		$data = CHtml::listData( $categoryList, 'id_cat', 'titulo_cat' );
		foreach ($data as $value => $text)
			echo CHtml::tag('option',['value'=>$value],CHtml::encode($text),true);
	}

	public function actionGetGroupAjax(){
		$code = $_POST['code'];

		$groupList = ItemCie::model()->findAll([
			'condition'=>'id_cat = :id_cat AND codigo = codigo_padre',
			'params'=>[':id_cat'=>$code]
		]);
		$data = CHtml::listData( $groupList, 'codigo', 'titulo' );
		foreach ($data as $value => $text)
			echo CHtml::tag('option',['value'=>$value],CHtml::encode($text),true);
	}

	public function actionGetItemAjax(){
		$code = $_POST['code'];
		$query = $_POST['query'];
		$condition = "";

		if($code!="")
			$condition = 'codigo_padre = :code AND';
		elseif ($query == "")
			return $this->renderPartial('_itemCieList',['itemList'=>[]]);

		$itemList = ItemCie::model()->findAll([
			'condition'=>"{$condition} (codigo like :cadena OR titulo like :cadena OR descripcion like :cadena)",
			'params'=>[':code'=>$code,':cadena'=>'%'.$query.'%']
		]);

		$this->renderPartial('_itemCieList',['itemList'=>$itemList]);
	}

	public function actionGetDetailItemAjax(){
		$code = $_POST['code'];

		$cieModel = ItemCie::model()->findByPk($code);
		$this->renderPartial('_detailItemCie',['cieModel'=>$cieModel]);
	}

	public function actionEditDescripcion(){
		$code = $_POST['pk'];
		$descr = $_POST['value'];

		$cieModel = ItemCie::model()->findByPk($code);
		$cieModel->descripcion=$descr;
		if($cieModel->save())
			print_r($_POST);
		else{
			header('HTTP/1.0 400 Bad Request', true, 400);
			echo "Error de guardado!";
		}
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
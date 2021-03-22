<?php

class CicloContableController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				 'actions' => array('index'),
				 'roles' => array('cicloIndex'),
			),
			array('allow',
				 'actions' => array('create'),
				 'roles' => array('cicloCreate'),
			),
			array('allow',
				 'actions' => array('view'),
				 'roles' => array('cicloView'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->menu = OptionsMenu::menuCiclo([], ['Ciclo', 'ciclo_Index']);
		$this->render('view',array(
			'ciclo'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->menu = OptionsMenu::menuCiclo([], ['Ciclo', 'ciclo_Create']);
		$ciclo=new CicloContable;

		if(isset($_POST['CicloContable']))
		{
			$ciclo->attributes=$_POST['CicloContable'];
			$ciclo->activo=true;
			if($ciclo->save())
				$this->redirect(array('index'));
		}

		$this->render('create',array(
			'ciclo'=>$ciclo,
		));
	}

	public function actionIndex()
	{
		$this->menu = OptionsMenu::menuCiclo([], ['Ciclo', 'ciclo_Index']);
		$ciclos = CicloContable::model()->findAll(array('order' => 'activo'));
		$dataProvider=new CActiveDataProvider('CicloContable');
		$this->render('index',array(
			'ciclos'=>$ciclos,
		));
	}

	public function loadModel($id)
	{
		$model=CicloContable::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
}

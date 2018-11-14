<?php

class AsientoController extends Controller
{
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
				 'actions' => array('create'),
				 'roles' => array('asientoCreate'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	
	public function actionCreate($tipo='1')
	{
		$selected = 'asiento_'.Asiento::model()->getTipo($tipo);
		$this->menu = OptionsMenu::menuAsiento([], ['Asientos', $selected]);
		$arrayCuentas = Cuenta::model()->getCuentasList();
		
		$empresa = Entidad::model()->findByPk(1);
		$asiento = new Asiento();
		$asiento->tipo = $tipo;
		$asiento->fecha = date("d/m/Y");
		$asiento->numero_asiento = $asiento->getUltimoAsiento();
		$asiento->numero_comprobante = $asiento->getUltimoComprobante($tipo);
		$listacuentaasiento = array();
		if(!empty($_POST))
		{
			$asiento->attributes = array_map('strtoupper',$_POST['Asiento']);
			$asiento->fecha_registro = date("d-m-Y");
			$asiento->id_usuario = Yii::app()->user->id;
			$asiento->id_ciclo = CicloContable::cicloActual()->id_ciclo;
			foreach($_POST['CuentaAsiento'] as $item){
				$cuentaAsiento = new CuentaAsiento();
				$cuentaAsiento->attributes = array_map('strtoupper', $item);
				$listacuentaasiento[]=$cuentaAsiento;
			}
			$flag = true;
			$trans = Yii::app()->db->beginTransaction();	
			try {
				if($asiento->save())
				{
					foreach($listacuentaasiento as $item){
						$item->id_asiento=$asiento->id_asiento;
						if(!$item->validate())
							$flag = false;
					}
					if($flag)
					{
						foreach($listacuentaasiento as $item){	//todo-le: ver si se puede agregar tratamiento a asiento
							//$item->id_trat=$modelTratamiento->id_trat;
							$item->save();
						}
					}
					else
						throw new CHttpException(400, 'Error al llenar el formulario');					
				}
				else
					throw new CHttpException(400, 'Error al llenar el formulario');
				$trans->commit();
				
				$this->redirect(array("asiento/index"));
			} catch (Exception $e) {
				$trans->rollback();
			}
		}
		$this->render('create', array('asiento'=>$asiento,'arrayCuentas'=>$arrayCuentas, 'empresa'=>$empresa, 'cuentas'=>$listacuentaasiento));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Asiento']))
		{
			$model->attributes=$_POST['Asiento'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_asiento));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Asiento');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Asiento('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Asiento']))
			$model->attributes=$_GET['Asiento'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Asiento the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Asiento::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Asiento $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='asiento-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

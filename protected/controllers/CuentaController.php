<?php

class CuentaController extends Controller
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
				 'actions' => array('view'),
				 'roles' => array('cuentaView'),
			),
			array('allow',
				 'actions' => array('create'),
				 'roles' => array('cuentaCreate'),
			),
			array('allow',
				 'actions' => array('createAjax'),
				 'roles' => array('cuentaCreateAjax'),
			),
			array('allow',
				 'actions' => array('update'),
				 'roles' => array('cuentaUpdate'),
			),
			array('allow',
				 'actions' => array('disabled'),
				 'roles' => array('cuentaDisabled'),
			),
			array('allow',
				 'actions' => array('index'),
				 'roles' => array('cuentaIndex'),
			),
			array('allow',
				 'actions' => array('admin'),
				 'roles' => array('cuentaAdmin'),
			),
			array('allow',
				 'actions' => array('importarCsv'),
				 'roles' => array('cuentaImportarCsv'),
			),
			array('allow',
				 'actions' => array('downloadCsv'),
				 'roles' => array('cuentaDownloadCsv'),
			),
			array('deny',  // deny all users
				 'users' => array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->menu = OptionsMenu::menuCuenta([], ['Cuentas', 'cuenta_Index']);
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id=false)
	{
		$this->menu = OptionsMenu::menuCuenta([], ['Cuentas', 'cuenta_Create']);
		$model=new Cuenta;
		if(isset($_POST['Cuenta']))
		{
			$model->attributes=$_POST['Cuenta'];
			if($model->cuenta_superior!=null)
				$model->nivel=$model->cuentaSuperior->nivel+1;
			else
				$model->nivel=1;
			$model->codigo=trim($model->codigo);
			$model->fecha_creacion = date("d-m-Y");
			//$this->performAjaxValidation($model);
			if($model->save())
				$this->redirect(array('admin', 'cuenta'=>$model->id_cuenta, 'superior'=>$model->cuenta_superior, '#'=>'ancla'));
		}
		if($id!=false)
		{
			$superior=$this->loadModel($id);
			$model->cuenta_superior = $superior->id_cuenta;
			$model->codigo = $model->generarCodigo($superior->codigo);
			$model->naturaleza = $superior->naturaleza;
		}
		else
			$model->codigo = $model->generarCodigo();
		$cuentasuperiorlist = CHtml::listData(Cuenta::model()->getCuentasList(true), 'id_cuenta', function ($p) {
			return $p->codigo . " -- " . $p->nombre;
		});
		$this->render('create',array(
			'model'=>$model,
			'cuentasuperiorlist'=>$cuentasuperiorlist,
		));
	}

	public function actionImportarCsv()
	{
		$this->menu = OptionsMenu::menuCuenta([], ['Cuentas', 'cuenta_ImportarCsv']);
		//todo-le: dar opcion de eliminar plan de cuentas o desabilitar todas las cuentas.
		$model=new CsvImportForm;
           
      if(isset($_POST['CsvImportForm']))
      {
         $model->attributes=$_POST['CsvImportForm'];
         if($model->validate())
         {
				$file = CUploadedFile::getInstance($model,'file');
				$transaction = Yii::app()->db->beginTransaction();
      		try
				{
					$fp = fopen($file->tempName, 'r');
					if($fp)
					{
						$saltar = 0;
						$codigo = "";
						$cont = 1;
						do {
							if ($saltar <= 1) {
								$saltar++;
								continue;
							}

							$cont++;
							$model = new Cuenta;

							$codigo = Cuenta::model()->generarCodigoDeCsv($codigo, trim($line[0]), $cont);
							$superior = Cuenta::model()->findByAttributes(array('codigo'=> (Cuenta::model()->getSuperior($codigo))));
							if(!$superior && strlen($codigo)>1)
								throw new CHttpException(400, 'Una de las cuentas no coincide con el orden de los codigos. Error ocurrido en la linea '.$cont);					
							$naturaleza = $this->obtenerNaturaleza($line[2],$cont);
							if($naturaleza == 0 && strlen($codigo) == 1)
								throw new CHttpException(400, 'Una de las cuentas Clase, o cuentas primarias no tiene especificada su naturaleza (Debe ser Deudor o Acreedor). Error ocurrido en la linea '.$cont);					
							
							$model->codigo = $codigo;
							$model->nombre = utf8_encode($line[1]);
							$model->fecha_creacion = date("d-m-Y");
							$model->descripcion = utf8_encode($line[3]);
							$model->activo = true;
							$model->naturaleza = $naturaleza;
							$model->nivel = 1;
							if($superior)
							{
								$model->naturaleza = ($naturaleza) ? $naturaleza : $superior->naturaleza;
								$model->nivel = (strlen($codigo)==1) ? 1 : ($superior->nivel + 1);
								$model->cuenta_superior = (strlen($codigo)==1) ? null : $superior->id_cuenta;
							}
							$model->save();
						}while( ($line = fgetcsv($fp, 1000, ";")) != FALSE);
					}
         		$transaction->commit();
				}
				catch(Exception $e)
				{
					print_r($e);
					exit;
					$transaction->rollBack();
            }
				$this->redirect(array("index"));
			}
		}
		$this->render("csvimport",array('model'=>$model));
	}

	public function actionDownloadCsv(){
		$path = Yii::getPathOfAlias('webroot')."/resources/files/Plan de Cuentas de Ejemplo.csv";
		$this->downloadFile($path);
	}

	public function downloadFile($fullpath){
		if(!empty($fullpath)){
			header("Content-type: csv/pdf"); //for pdf file
			//header('Content-Type:text/plain; charset=ISO-8859-15');
			//if you want to read text file using text/plain header 
			header('Content-Disposition: attachment; filename="'.basename($fullpath).'"'); 
			header('Content-Length: ' . filesize($fullpath));
			readfile($fullpath);
			Yii::app()->end();
		}
	}

	public function obtenerNaturaleza($valor, $cont)	
	{
		//verifica si el valor del el csv es valido, si recibe "acreedor" devuelve 1, si recibe "deudor" devuelve 2, si es
		//si recibe vacio devuelve 0, si recibe otro valor devuelve una exception
		if(strtoupper(trim($valor)) == "ACREEDOR")
			return 1;
		if(strtoupper(trim($valor)) == "DEUDOR")
			return 2;
		if(strlen(trim($valor)) == 0)
			return 0;
		if(strlen(trim($valor)) > 0)
			throw new CHttpException(400, 'Uno de los datos en el campo Naturaleza esta mal especificado, o esta mal escrito. Error ocurrido en la linea '.$cont);
	}
	public function actionCreateAjax()
	{
		$model=new Cuenta;

		// Uncomment the followi	ng line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cuenta']))
		{
			$model->attributes=$_POST['Cuenta'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_cuenta));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->menu = OptionsMenu::menuCuenta([], ['Cuentas', 'cuenta_Admin']);
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cuenta']))
		{
			//todo-le: si se activa una cuenta desactivada y el codigo ya esta en uso, generar una excepcion.
			$model->attributes=$_POST['Cuenta'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_cuenta));
		}
		$cuentasuperiorlist = CHtml::listData(Cuenta::model()->getCuentasList(true), 'id_cuenta', function ($p) {
			return $p->codigo . " -- " . $p->nombre;
		});
		$this->render('update',array(
			'model'=>$model,
			'cuentasuperiorlist'=>$cuentasuperiorlist,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDisabled($id)
	{
		$model = $this->loadModel($id);
		$superior = $model->cuenta_superior;
		if($model->cuentaAsientos == null)
			$model->delete();
		else {
			$model->activo = false;
			//$model->codigo =
			//todo-le: cambiar el codigo por defecto.
			$model->fecha_inactivacion = date("d-m-Y");
			$model->save();
		}

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin', 'superior'=>$superior, '#'=>'ancla'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->menu = OptionsMenu::menuCuenta([], ['Cuentas', 'cuenta_Index']);
		$arrayCuentas=Cuenta::model()->getCuentasList();
		$this->render('index',array(
			'arrayCuentas'=>$arrayCuentas,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->menu = OptionsMenu::menuCuenta([], ['Cuentas', 'cuenta_Admin']);
		$arrayCuentas=Cuenta::model()->getCuentasList();
		$this->render('admin',array(
			'arrayCuentas'=>$arrayCuentas,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Cuenta the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Cuenta::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cuenta $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cuenta-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

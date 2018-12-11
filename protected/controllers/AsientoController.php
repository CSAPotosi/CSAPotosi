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
			 // we only allow deletion via POST request
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
			array('allow',
				 'actions' => array('showLibro'),
				 'roles' => array('asientoShowLibro'),
			),
			array('allow',
				 'actions' => array('index'),
				 'roles' => array('asientoIndex'),
			),
			array('allow',
				 'actions' => array('view'),
				 'roles' => array('asientoView'),
			),
			array('allow',
				 'actions' => array('update'),
				 'roles' => array('asientoUpdate'),
			),
			array('allow',
				 'actions' => array('delete'),
				 'roles' => array('asientoDelete'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionCreate($tipo='1')
	{
		$selected = 'asiento_'.Asiento::model()->getTipo($tipo);
		$this->menu = OptionsMenu::menuAsiento([], ['Asientos', $selected]);
		$arrayCuentas = Cuenta::model()->getCuentasList();
		
		//$empresa = Entidad::model()->findByPk(1);
		$asiento = new Asiento();
		$asiento->tipo = $tipo;
		$asiento->fecha = date("d/m/Y");
		$asiento->numero_asiento = $asiento->getUltimoAsiento();
		$asiento->numero_comprobante = $asiento->getUltimoComprobante($tipo);		//todo-le: revisar como se guardan los numeros de comprobantes
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
		$this->render('create', array('asiento'=>$asiento,'arrayCuentas'=>$arrayCuentas, 'cuentasAsiento'=>$listacuentaasiento));
	}
	
	public function actionIndex($fecha_inicio='', $fecha_fin='', $tipo='0')
	{
		$this->menu = OptionsMenu::menuAsiento([], ['Asientos', 'asiento_Index']);

		$ciclo = CicloContable::model()->findByAttributes(array('activo' => true));
		if(isset($_GET["inicio"]) && isset($_GET["fin"]))
		{
			if(((bool)strtotime($_GET["inicio"])))
				$fecha_inicio = $_GET["inicio"]." 00:00:00";
			else
				$fecha_inicio = "01/01/". $ciclo->gestion." 00:00:00";	
			if(((bool)strtotime($_GET["fin"])))
				$fecha_fin = $_GET["fin"]." 23:59:59";
			else
				$fecha_fin = "31/12/". $ciclo->gestion." 23:59:59";
		}
		else
		{
			$fecha_inicio = "01/01/". $ciclo->gestion." 00:00:00";
			$fecha_fin = "31/12/". $ciclo->gestion." 23:59:59";
		}
		$criteria = new CDbCriteria;
		$criteria->condition = "fecha >= '$fecha_inicio' AND fecha <= '$fecha_fin' ".(($tipo=='0')? "" : "AND tipo = '$tipo'");
		$criteria->order = 'fecha DESC';
		$asientos = Asiento::model()->findAll($criteria);

		$this->render('index',array(
			'asientos'=>$asientos,
			'inicio'=>$fecha_inicio,
			'fin'=>$fecha_fin,
			'tipo'=>$tipo
		));
	}

	public function actionView($id)
	{
		$this->menu = OptionsMenu::menuAsiento([], ['Asientos', 'asiento_Index']);

		if(isset($_POST['pdf'])){
			$pdf = new dPdf();

			$content = $pdf->getComprobanteWrapper($_POST['pdf']);
			
			$pdf->loadHtml($content);

			$pdf->report();
		}
		$this->render('view',array(
			'asiento'=>$this->loadModel($id),
		));
	}

	public function loadModel($id)
	{
		$model=Asiento::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function actionUpdate($id)
	{
		$asiento=$this->loadModel($id);

		$selected = 'asiento_'.Asiento::model()->getTipo($asiento->tipo);
		$this->menu = OptionsMenu::menuAsiento([], ['Asientos', $selected]);
		$arrayCuentas = Cuenta::model()->getCuentasList();
		
		$listacuentaasiento = array();
		if(!empty($_POST))
		{
			$asiento->attributes = array_map('strtoupper',$_POST['Asiento']);
			$asiento->fecha_registro = date("d-m-Y");
			$asiento->id_usuario = Yii::app()->user->id;
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
						foreach($asiento->cuentaAsientos as $item){
							$item->delete();
						}
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
		}else{
			foreach($asiento->cuentaAsientos as $item){
				$listacuentaasiento[]=$item;
			}
		}
		$this->render('update', array('asiento'=>$asiento,'arrayCuentas'=>$arrayCuentas, 'cuentasAsiento'=>$listacuentaasiento));
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

	public function actionShowLibro($fecha_inicio="", $fecha_fin="")
	{
		$this->menu = OptionsMenu::menuAsiento([], ['Asientos', 'asiento_ShowLibro']);
		if(isset($_GET["fecha_inicio"]) && isset($_GET["fecha_fin"]))
		{
			$fecha_inicio = $_GET["fecha_inicio"];
			$fecha_fin = $_GET["fecha_fin"];
		}
		else
		{
			$ciclo = CicloContable::model()->findByAttributes(array('activo' => true));
			$fecha_inicio = "01/01/". $ciclo->gestion;
			$fecha_fin = "31/12/". $ciclo->gestion;
		}
		$criteria = new CDbCriteria;
		$criteria->condition = "fecha >= '$fecha_inicio' AND fecha <= '$fecha_fin'";
		$asientos = Asiento::model()->findAll($criteria);
		if(isset($_POST['pdf'])){
			$pdf = new dPdf();

			$content = $pdf->getHtmlWrapper($_POST['pdf']);
			
			$pdf->loadHtml($content);

			$pdf->report();
		}
		$this->render('showLibro',array(
			'asientos'=>$asientos
		));
	}

	public function actionDelete($id)
	{
		$asiento = $asiento=$this->loadModel($id);
		foreach($asiento->cuentaAsientos as $item){
			$item->delete();
		}
		$asiento->delete();
		$this->redirect(array('index'));
	}
}

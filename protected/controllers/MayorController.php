<?php

class MayorController extends Controller
{
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions' => array('index'),
				'roles' => array('mayorIndex'),
			),
			array('allow',
				'actions' => array('getIntervalo'),
				'roles' => array('mayorGetIntervalo'),
			),
			array('allow',
				'actions' => array('getVarios'),
				'roles' => array('mayorGetVarios'),
			),
			array('deny',  // deny all users
				'users' => array('*'),
			),
		);
	}

	public function actionIndex($fecha_inicio="",$fecha_fin="")
	{
		$this->menu = OptionsMenu::menuMayor([], ['Mayor', 'mayor_Index']);

		if(!CicloContable::model()->cicloActual())
			throw new CHttpException(400, 'Todavia no tiene Creado el Ciclo Contable de la Gestion Actual. Debe crearlo primero');
		
		$arrayCuentas = Cuenta::model()->getCuentasList();
		$cuenta = '';
		$ciclo = CicloContable::model()->findByAttributes(array('activo' => true));
		if(isset($_GET["inicio"]) && isset($_GET["fin"]))
		{
			$cuenta = Cuenta::model()->findByPk($_GET['id_cuenta']);

			$fecha_inicio = str_replace('/', '-', $_GET["inicio"]);
			$fecha_fin = str_replace('/', '-', $_GET["fin"]);
			if((bool)strtotime($fecha_inicio))
				$fecha_inicio = $fecha_inicio." 00:00:00";
			else
				$fecha_inicio = "01-01-". $ciclo->gestion." 00:00:00";	
			if((bool)strtotime($fecha_fin))
				$fecha_fin = $fecha_fin." 23:59:59";
			else
				$fecha_fin = "31-12-". $ciclo->gestion." 23:59:59";
			$arrayCuentas = Cuenta::model()->with('cuentaAsientos.asiento')->findAllByAttributes(array('activo'=>true),array('order' => 'codigo'));
		}
		else
		{
			$fecha_inicio = "01-01-". $ciclo->gestion." 00:00:00";
			$fecha_fin = date('d-m-Y h:m:s');
		}
		if(isset($_POST['pdf'])){
			$pdf = new dPdf();

			$content = $pdf->getHtmlWrapper($_POST['pdf']);
			
			$pdf->loadHtml($content);

			$pdf->report();
		}

		$this->render('index',array(
			'cuenta'=>$cuenta,
			'arrayCuentas'=>$arrayCuentas,
			'inicio'=>$fecha_inicio,
			'fin'=>$fecha_fin
		));
	}
	public function actionGetIntervalo($fecha_inicio="",$fecha_fin="",$codigo1='',$codigo2='')
	{
		$this->menu = OptionsMenu::menuMayor([], ['Mayor', 'mayor_GetIntervalo']);
		
		$arrayCuentas = Cuenta::model()->getCuentasList();
		$ciclo = CicloContable::model()->findByAttributes(array('activo' => true));
		$valid=true;
		if(isset($_GET["inicio"]) && isset($_GET["fin"]) && isset($_GET["codigo1"]) && isset($_GET["codigo2"]))
		{
			$record1=Cuenta::model()->find(array('condition'=>'codigo=:codigo', 'params'=>array(':codigo'=>$codigo1)));
			$record2=Cuenta::model()->find(array('condition'=>'codigo=:codigo', 'params'=>array(':codigo'=>$codigo2)));
			if($record1==null&&$codigo1!='')
				$codigo1='No existe Cuenta '.$codigo1;
			if($record2==null&&$codigo2!='')
				$codigo2='No existe Cuenta '.$codigo2;
			if($record1==null || $record2==null)
				$valid=false;

			$fecha_inicio = str_replace('/', '-', $_GET["inicio"]);
			$fecha_fin = str_replace('/', '-', $_GET["fin"]);
			if((bool)strtotime($fecha_inicio))
				$fecha_inicio = $fecha_inicio." 00:00:00";
			else
				$fecha_inicio = "01-01-". $ciclo->gestion." 00:00:00";	
			if((bool)strtotime($fecha_fin))
				$fecha_fin = $fecha_fin." 23:59:59";
			else
				$fecha_fin = "31-12-". $ciclo->gestion." 23:59:59";
			$arrayCuentas = Cuenta::model()->with('cuentaAsientos.asiento')->findAllByAttributes(array('activo'=>true),array('order' => 'codigo'));
		}
		else
		{
			$valid = false;
			$fecha_inicio = "01-01-". $ciclo->gestion." 00:00:00";
			$fecha_fin = date('d-m-Y h:m:s');
		}
		if(isset($_POST['pdf'])){
			$pdf = new dPdf();

			$content = $pdf->getHtmlWrapper($_POST['pdf']);
			
			$pdf->loadHtml($content);

			$pdf->report();
		}

		$this->render('intervalo',array(
			'codigo1'=>$codigo1,
			'codigo2'=>$codigo2,
			'arrayCuentas'=>$arrayCuentas,
			'inicio'=>$fecha_inicio,
			'fin'=>$fecha_fin,
			'valid'=>$valid
		));
	}

	public function actionGetVarios()
	{
		$this->menu = OptionsMenu::menuMayor([], ['Mayor', 'mayor_GetVarios']);
		$arrayCuentas = Cuenta::model()->getCuentasList();
		$ciclo = CicloContable::model()->findByAttributes(array('activo' => true));
		if(isset($_POST["inicio"]) && isset($_POST["fin"]) && isset($_POST["codigos"]))
		{
			$fecha_inicio = str_replace('/', '-', $_POST["inicio"]);
			$fecha_fin = str_replace('/', '-', $_POST["fin"]);
			if((bool)strtotime($fecha_inicio))
				$fecha_inicio = $fecha_inicio." 00:00:00";
			else
				$fecha_inicio = "01-01-". $ciclo->gestion." 00:00:00";	
			if((bool)strtotime($fecha_fin))
				$fecha_fin = $fecha_fin." 23:59:59";
			else
				$fecha_fin = "31-12-". $ciclo->gestion." 23:59:59";
			$codigos = $_POST['codigos'];
			$arrayCuentas = Cuenta::model()->with('cuentaAsientos.asiento')->findAllByAttributes(array('activo'=>true),array('order' => 'codigo'));
		}
		else
		{
			$fecha_inicio = "01-01-". $ciclo->gestion." 00:00:00";
			$fecha_fin = date('d-m-Y h:m:s');
			$codigos = '';
		}

		if(isset($_POST['pdf'])){
			$pdf = new dPdf();

			$content = $pdf->getHtmlWrapper($_POST['pdf']);
			
			$pdf->loadHtml($content);

			$pdf->report();
		}

		$this->render('varios',array(
			'codigos'=>$codigos,
			'arrayCuentas'=>$arrayCuentas,
			'inicio'=>$fecha_inicio,
			'fin'=>$fecha_fin,
		));
	}
}

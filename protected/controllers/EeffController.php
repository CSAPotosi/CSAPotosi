<?php

class EeffController extends Controller
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
				'actions' => array('balanceGeneral'),
				'roles' => array('eeffBalanceGeneral'),
			),
			array('allow',
				'actions' => array('estadoResultados'),
				'roles' => array('eeffEstadoResultados'),
			),
			array('allow',
				'actions' => array('flujoEfectivo'),
				'roles' => array('eeffFlujoEfectivo'),
			),
			array('allow',
				'actions' => array('cambiosPatrimonio'),
				'roles' => array('eeffCambiosPatrimonio'),
			),
			array('allow',
				'actions' => array('balanceComprobacionSS'),
				'roles' => array('eeffBalanceComprobacionSS'),
			),
			array('deny',  // deny all users
				'users' => array('*'),
			),
		);
	}

	public function actionBalanceGeneral()
	{
		$this->menu = OptionsMenu::menuEeff([], ['Eeff', 'eeff_BalanceGeneral']);
		$ciclo = CicloContable::model()->findByAttributes(array('activo' => true));
		$cuentas = null;
		$fecha_inicio = $ciclo->dia_inicio;
		$valid = null;
		if(isset($_GET["fin"]))
		{
			$fecha_fin = str_replace('/', '-', $_GET["fin"]);
			if((bool)strtotime($fecha_fin))
				$fecha_fin = $fecha_fin;
			else
				$fecha_fin = "31-12-". $ciclo->gestion;
			$valid = true;
			$q = "with con as(
						select id_cuenta, debe, haber from 
						asiento join cuenta_asiento 
						on asiento.id_asiento = cuenta_asiento.id_asiento 
						where fecha >= '$fecha_inicio' and fecha <= '$fecha_fin'
					) 
					select c.id_cuenta, c.codigo, c.nombre, c.nivel, c.naturaleza, sum(con.debe) as sumdebe, sum(con.haber) as sumhaber
					from cuenta as c left join con on c.id_cuenta = con.id_cuenta 
					where c.activo = true and c.codigo < '4'
					group by c.id_cuenta 
					order by c.codigo";
			$cmd = Yii::app()->db->createCommand($q);
			$cuentas = $cmd->queryAll();
			$this->addTotales($cuentas);
			// echo('<br><br><br><br><br><br><pre>');
			// var_dump($result);
			// echo('</pre>');
			// return;
		}
		else
			$fecha_fin = date('d-m-Y');
		if(isset($_POST['pdf'])){
			$pdf = new dPdf();

			$content = $pdf->getHtmlWrapper($_POST['pdf']);
			
			$pdf->loadHtml($content);

			$pdf->report();
		}

		$this->render('balanceGeneral',array(
			'cuentas'=>$cuentas,
			'fin'=>$fecha_fin,
			'valid'=>$valid,
			'niveles'=>3,
		));
	}
	public function actionEstadoResultados(){
		$this->menu = OptionsMenu::menuEeff([], ['Eeff', 'eeff_EstadoResultados']);
		$ciclo = CicloContable::model()->findByAttributes(array('activo' => true));
		$cuentas = null;
		$fecha_inicio = $ciclo->dia_inicio;
		$valid = null;
		if(isset($_GET["fin"]))
		{
			$fecha_fin = str_replace('/', '-', $_GET["fin"]);
			if((bool)strtotime($fecha_fin))
				$fecha_fin = $fecha_fin;
			else
				$fecha_fin = "31-12-". $ciclo->gestion;
			$valid = true;
			$q = "with con as(
						select id_cuenta, debe, haber from 
						asiento join cuenta_asiento 
						on asiento.id_asiento = cuenta_asiento.id_asiento 
						where fecha >= '$fecha_inicio' and fecha <= '$fecha_fin'
					) 
					select c.id_cuenta, c.codigo, c.nombre, c.nivel, c.naturaleza, sum(con.debe) as sumdebe, sum(con.haber) as sumhaber
					from cuenta as c left join con on c.id_cuenta = con.id_cuenta 
					where c.activo = true and c.codigo < '4'
					group by c.id_cuenta 
					order by c.codigo";
			$cmd = Yii::app()->db->createCommand($q);
			$cuentas = $cmd->queryAll();
			$this->addTotales($cuentas);
			// echo('<br><br><br><br><br><br><pre>');
			// var_dump($result);
			// echo('</pre>');
			// return;
		}
		else
			$fecha_fin = date('d-m-Y');
		if(isset($_POST['pdf'])){
			$pdf = new dPdf();

			$content = $pdf->getHtmlWrapper($_POST['pdf']);
			
			$pdf->loadHtml($content);

			$pdf->report();
		}

		$this->render('estadoResultados',array(
			'cuentas'=>$cuentas,
			'fin'=>$fecha_fin,
			'valid'=>$valid
		));
	}
	public function actionFlujoEfectivo()
	{
		$this->menu = OptionsMenu::menuEeff([], ['Eeff', 'eeff_EstadoResultados']);
		$ciclo = CicloContable::model()->findByAttributes(array('activo' => true));
		$cuentas = null;
		$fecha_inicio = $ciclo->dia_inicio;
		$valid = null;
		if(isset($_GET["fin"]))
		{
			$fecha_fin = str_replace('/', '-', $_GET["fin"]);
			if((bool)strtotime($fecha_fin))
				$fecha_fin = $fecha_fin;
			else
				$fecha_fin = "31-12-". $ciclo->gestion;
			$valid = true;
			$q = "with con as(
						select id_cuenta, debe, haber from 
						asiento join cuenta_asiento 
						on asiento.id_asiento = cuenta_asiento.id_asiento 
						where fecha >= '$fecha_inicio' and fecha <= '$fecha_fin'
					) 
					select c.id_cuenta, c.codigo, c.nombre, c.nivel, c.naturaleza, sum(con.debe) as sumdebe, sum(con.haber) as sumhaber
					from cuenta as c left join con on c.id_cuenta = con.id_cuenta 
					where c.activo = true and c.codigo < '4'
					group by c.id_cuenta 
					order by c.codigo";
			$cmd = Yii::app()->db->createCommand($q);
			$cuentas = $cmd->queryAll();
			$this->addTotales($cuentas);
			// echo('<br><br><br><br><br><br><pre>');
			// var_dump($result);
			// echo('</pre>');
			// return;
		}
		else
			$fecha_fin = date('d-m-Y');
		if(isset($_POST['pdf'])){
			$pdf = new dPdf();

			$content = $pdf->getHtmlWrapper($_POST['pdf']);
			
			$pdf->loadHtml($content);

			$pdf->report();
		}

		$this->render('flujoEfectivo',array(
			'cuentas'=>$cuentas,
			'fin'=>$fecha_fin,
			'valid'=>$valid
		));
	}
	public function actionCambiosPatrimonio(){
		$this->menu = OptionsMenu::menuEeff([], ['Eeff', 'eeff_EstadoResultados']);
		$ciclo = CicloContable::model()->findByAttributes(array('activo' => true));
		$cuentas = null;
		$fecha_inicio = $ciclo->dia_inicio;
		$valid = null;
		if(isset($_GET["fin"]))
		{
			$fecha_fin = str_replace('/', '-', $_GET["fin"]);
			if((bool)strtotime($fecha_fin))
				$fecha_fin = $fecha_fin;
			else
				$fecha_fin = "31-12-". $ciclo->gestion;
			$valid = true;
			$q = "with con as(
						select id_cuenta, debe, haber from 
						asiento join cuenta_asiento 
						on asiento.id_asiento = cuenta_asiento.id_asiento 
						where fecha >= '$fecha_inicio' and fecha <= '$fecha_fin'
					) 
					select c.id_cuenta, c.codigo, c.nombre, c.nivel, c.naturaleza, sum(con.debe) as sumdebe, sum(con.haber) as sumhaber
					from cuenta as c left join con on c.id_cuenta = con.id_cuenta 
					where c.activo = true and c.codigo < '4'
					group by c.id_cuenta 
					order by c.codigo";
			$cmd = Yii::app()->db->createCommand($q);
			$cuentas = $cmd->queryAll();
			$this->addTotales($cuentas);
			// echo('<br><br><br><br><br><br><pre>');
			// var_dump($result);
			// echo('</pre>');
			// return;
		}
		else
			$fecha_fin = date('d-m-Y');
		if(isset($_POST['pdf'])){
			$pdf = new dPdf();

			$content = $pdf->getHtmlWrapper($_POST['pdf']);
			
			$pdf->loadHtml($content);

			$pdf->report();
		}

		$this->render('cambiosPatrimonio',array(
			'cuentas'=>$cuentas,
			'fin'=>$fecha_fin,
			'valid'=>$valid
		));
	}
	public function actionBalanceComprobacionSS()
	{
		$this->menu = OptionsMenu::menuEeff([], ['Eeff', 'eeff_BalanceComprobacionSS']);

		$arrayCuentas = Cuenta::model()->getCuentasList();
		$ciclo = CicloContable::model()->findByAttributes(array('activo' => true));

		$fecha_inicio = $ciclo->dia_inicio;
		$valid = null;
		if(isset($_GET["fin"]))
		{
			$fecha_fin = str_replace('/', '-', $_GET["fin"]);
			if((bool)strtotime($fecha_fin))
				$fecha_fin = $fecha_fin." 23:59:59";
			else
				$fecha_fin = "31-12-". $ciclo->gestion." 23:59:59";
			$valid = true;
			$arrayCuentas = Cuenta::model()->with('cuentaAsientos.asiento')->findAllByAttributes(array('activo'=>true),array('order' => 'codigo'));
		}
		else
			$fecha_fin = date('d-m-Y h:m:s');
		if(isset($_POST['pdf'])){
			$pdf = new dPdf();

			$content = $pdf->getHtmlWrapper($_POST['pdf']);
			
			$pdf->loadHtml($content);

			$pdf->report();
		}

		$this->render('comprobacionSS',array(
			'arrayCuentas'=>$arrayCuentas,
			'inicio'=>$fecha_inicio,
			'fin'=>$fecha_fin,
			'valid'=>$valid,
		));
	}
	private function addTotales(&$r)
	{
		$len = count($r);
		$niv = 0;
		$lista[] = null;
		for($i = $len - 1; $i >= 0; $i--)
		{
			$sumtotaldebe = $sumtotalhaber = 0;
			while(end($lista))
			{
				$aux = end($lista);
				if($aux['nivel'] > $r[$i]['nivel']){
					$sumtotaldebe += (float)$aux['sumtotaldebe'];
					$sumtotalhaber += (float)$aux['sumtotalhaber'];
					array_pop($lista);
				}else
					break;
			}
			$r[$i]['sumtotaldebe'] = (float)$sumtotaldebe + (float)$r[$i]['sumdebe'];
			$r[$i]['sumtotalhaber'] = (float)$sumtotalhaber + (float)$r[$i]['sumhaber'];
			$lista[] = $r[$i];
		}
	}
}

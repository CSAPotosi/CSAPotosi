<?php

class ReporteCirugiaController extends Controller
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
                'roles' => array('reporteCirugiaIndex'),
            ),
            array('allow',
                'actions' => array('indexPDF'),
                'roles' => array('reporteCirugiaIndexPDF'),
            ),
            array('allow',
                'actions' => array('index2'),
                'roles' => array('reporteCirugiaIndex2'),
            ),
            array('allow',
                'actions' => array('index2PDF'),
                'roles' => array('reporteCirugiaIndex2PDF'),
            ),
            array('allow',
                'actions' => array('estadisticaSala'),
                'roles' => array('reporteCirugiaEstadisticaSala'),
            ),
            array('allow',
                'actions' => array('estadisticaSalaPDF'),
                'roles' => array('reporteCirugiaEstadisticaSalaPDF'),
            ),
            array('allow',
                'actions' => array('estadisticaPersonal'),
                'roles' => array('reporteCirugiaEstadisticaPersonal'),
            ),
            array('allow',
                'actions' => array('estadisticaPersonalPDF'),
                'roles' => array('reporteCirugiaEstadisticaPersonalPDF'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuReporteCirugia([],['cirugia','reporteCirugia_Index']);
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }

        $cirugiaList = Cirugia::model()->findAll([
            'condition' => 'NOT reservado AND fec_inicio::DATE BETWEEN :fec_ini and :fec_fin',
            'order'=>'fec_inicio ASC',
            'params'=>[':fec_ini'=>$fec_ini, ':fec_fin'=>$fec_fin]
        ]);
		$this->render('index',['cirugiaList'=>$cirugiaList,'fec_ini'=>$fec_ini,'fec_fin'=>$fec_fin]);
	}

	public function actionIndexPDF(){
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }
        $cirugiaList = Cirugia::model()->findAll([
            'condition' => 'NOT reservado AND fec_inicio::DATE BETWEEN :fec_ini and :fec_fin',
            'order'=>'fec_inicio ASC',
            'params'=>[':fec_ini'=>$fec_ini, ':fec_fin'=>$fec_fin]
        ]);
        spl_autoload_register(array('YiiBase', 'autoload'));
        $pdf = new MYPDF('L', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->cabecera1($pdf);
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetTextColor(80, 80, 80);
        $pdf->AddPage();
        $pdf->usuario($pdf);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->SetFillColor(115, 109, 109);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('', 'B');
        // Header
        $header = array('Fecha y hora inicio', 'Fecha y hora fin', 'Sala', 'Paciente', 'Tiempo (min)', 'Naturaleza', 'Instrumental');
        $w = array(30, 30, 30, 45,20,40,55);
        foreach($header as $i=>$h) {
            $pdf->Cell($w[$i], 7, $h, 1, 0, 'C', 1);
        }
        $pdf->Ln();
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = 0;
        foreach($cirugiaList as $cirugia){
            $pdf->Cell($w[0], 7, date('d/m/Y H:i',strtotime($cirugia->fec_inicio)), 1, 0, 'L', $fill);
            $pdf->Cell($w[1], 7, date('d/m/Y H:i',strtotime($cirugia->fec_fin)), 1, 0, 'L', $fill);
            $pdf->Cell($w[2], 7, "{$cirugia->sala->cod_sala} ({$cirugia->sala->tSala->servicio->nombre_serv})", 1, 0, 'L', $fill);
            $pdf->Cell($w[3], 7, $cirugia->historial->paciente->persona->nombreCompleto, 1, 0, 'L', $fill);
            $pdf->Cell($w[4], 7, $cirugia->tiempo_real, 1, 0, 'L', $fill);
            $pdf->Cell($w[5], 7, $cirugia->naturaleza, 1, 0, 'L', $fill);
            $pdf->Cell($w[6], 7, $cirugia->detalle_instrumental, 1, 0, 'L', $fill);
            $pdf->Ln();
            $fill = !$fill;
        }
        $pdf->Ln();
        $pdf->lastPage();
        //Close and output PDF document
        $pdf->Output('filename.pdf', 'I');
    }

    public function actionIndex2(){
        $this->menu = OptionsMenu::menuReporteCirugia([],['cirugia','reporteCirugia_Index2']);
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }

        $cirugiaList = Cirugia::model()->findAll([
            'condition' => 'reservado AND fec_reserva::DATE BETWEEN :fec_ini and :fec_fin',
            'order'=>'fec_reserva ASC',
            'params'=>[':fec_ini'=>$fec_ini, ':fec_fin'=>$fec_fin]
        ]);
        $this->render('index2',['cirugiaList'=>$cirugiaList,'fec_ini'=>$fec_ini,'fec_fin'=>$fec_fin]);
    }

    public function actionIndex2PDF(){
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }
        $cirugiaList = Cirugia::model()->findAll([
            'condition' => 'reservado AND fec_reserva::DATE BETWEEN :fec_ini and :fec_fin',
            'order'=>'fec_reserva ASC',
            'params'=>[':fec_ini'=>$fec_ini, ':fec_fin'=>$fec_fin]
        ]);
        spl_autoload_register(array('YiiBase', 'autoload'));
        $pdf = new MYPDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->cabecera1($pdf);
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetTextColor(80, 80, 80);
        $pdf->AddPage();
        $pdf->usuario($pdf);
        $pdf->SetTextColor(0, 0, 0);

        $pdf->SetFillColor(115, 109, 109);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('', 'B');
        // Header
        $header = array('Fecha y hora reserva',  'Sala', 'Paciente', 'Tiempo est.(min)');
        $w = array(30, 65, 60, 30);
        foreach($header as $i=>$h) {
            $pdf->Cell($w[$i], 7, $h, 1, 0, 'C', 1,null,1);
        }
        $pdf->Ln();
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = 0;
        foreach($cirugiaList as $cirugia){
            $pdf->Cell($w[0], 7, date('d/m/Y H:i',strtotime($cirugia->fec_reserva)), 1, 0, 'L', $fill);
            $pdf->Cell($w[1], 7, "{$cirugia->sala->cod_sala} ({$cirugia->sala->tSala->servicio->nombre_serv})", 1, 0, 'L', $fill);
            $pdf->Cell($w[2], 7, $cirugia->historial->paciente->persona->nombreCompleto, 1, 0, 'L', $fill);
            $pdf->Cell($w[3], 7, $cirugia->tiempo_estimado, 1, 0, 'L', $fill);
            $pdf->Ln();
            $fill = !$fill;
        }
        $pdf->Ln();
        $pdf->lastPage();
        //Close and output PDF document
        $pdf->Output('filename.pdf', 'I');
    }

    public function actionEstadisticaSala(){
        $this->menu = OptionsMenu::menuReporteCirugia([],['cirugia','reporteCirugia_EstadisticaSala']);
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }
        $cirugiaList = Cirugia::model()->findAll([
            'condition' => 'NOT reservado AND fec_inicio::DATE BETWEEN :fec_ini and :fec_fin',
            'order'=>'fec_inicio ASC',
            'params'=>[':fec_ini'=>$fec_ini, ':fec_fin'=>$fec_fin]
        ]);

        return $this->render('estadisticaSala',['cirugiaList'=>$cirugiaList,'fec_ini'=>$fec_ini,'fec_fin'=>$fec_fin]);
    }

    public function actionEstadisticaSalaPDF(){
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }
        $cirugiaList = Cirugia::model()->findAll([
            'condition' => 'NOT reservado AND fec_inicio::DATE BETWEEN :fec_ini and :fec_fin',
            'order'=>'fec_inicio ASC',
            'params'=>[':fec_ini'=>$fec_ini, ':fec_fin'=>$fec_fin]
        ]);

        $report = [];
        $total =0;
        foreach($cirugiaList as $cirugia){
            $id = $cirugia->sala->tSala->servicio->id_serv;
            $report[$id]['count'] = isset($report[$id]['count'])?$report[$id]['count']+1:1;
            $report[$id]['name'] = $cirugia->sala->tSala->servicio->nombre_serv;
            $report[$id]['items'][$cirugia->sala->id_sala]['count'] = isset($report[$id]['items'][$cirugia->sala->id_sala]['count'])?$report[$id]['items'][$cirugia->sala->id_sala]['count']+1:1;
            $report[$id]['items'][$cirugia->sala->id_sala]['name'] = $cirugia->sala->cod_sala;
            $total++;
        }

        spl_autoload_register(array('YiiBase', 'autoload'));
        $pdf = new MYPDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->cabecera1($pdf);
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetTextColor(80, 80, 80);
        $pdf->AddPage();
        $pdf->usuario($pdf);

        $xc = 130;
        $yc = 60;
        $r = 30;
        $init = 0;
        $pdf->SetTextColor(255);
        $pdf->SetFont('', 'B');
        $pdf->setXY(50,35);
        foreach ($report as $re){
            $end = $init+ ($re['count']*360)/$total;
            $color = [rand(0,255),rand(0,255), rand(0,255)];
            $pdf->SetFillColor($color[0],$color[1], $color[2]);
            $pdf->Cell(30,7,$re['name'],0,2,'C',1,null,1);
            $pdf->PieSector($xc, $yc, $r, $init, $end, 'FD');
            $init = $end;
        }
        $pdf->SetFillColor(115, 109, 109);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('', 'B');
        // Header
        $header = array('Fecha y hora',  'Grupo sala', 'Sala');
        $pdf->setXY(15,95);
        $w = array(40, 70, 75);
        foreach($header as $i=>$h) {
            $pdf->Cell($w[$i], 7, $h, 1, 0, 'C', 1,null,1);
        }
        $pdf->Ln();
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = 0;
        foreach($cirugiaList as $cirugia){
            $pdf->Cell($w[0], 7, date('d/m/Y H:i',strtotime($cirugia->fec_inicio)), 1, 0, 'L', $fill);
            $pdf->Cell($w[1], 7, $cirugia->sala->cod_sala, 1, 0, 'L', $fill);
            $pdf->Cell($w[2], 7, $cirugia->sala->tSala->servicio->nombre_serv, 1, 0, 'L', $fill);
            $pdf->Ln();
            $fill = !$fill;
        }
        $pdf->Ln();
        $pdf->lastPage();
        //Close and output PDF document
        $pdf->Output('filename.pdf', 'I');
    }

    public function actionEstadisticaPersonal(){
        $this->menu = OptionsMenu::menuReporteCirugia([],['cirugia','reporteCirugia_EstadisticaPersonal']);
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }
        $cirugiaList = Cirugia::model()->findAll([
            'condition' => 'NOT reservado AND fec_inicio::DATE BETWEEN :fec_ini and :fec_fin',
            'order'=>'fec_inicio ASC',
            'params'=>[':fec_ini'=>$fec_ini, ':fec_fin'=>$fec_fin]
        ]);

        return $this->render('estadisticaPersonal',['cirugiaList'=>$cirugiaList,'fec_ini'=>$fec_ini,'fec_fin'=>$fec_fin]);
    }

    public function actionEstadisticaPersonalPDF(){
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }
        $cirugiaList = Cirugia::model()->findAll([
            'condition' => 'NOT reservado AND fec_inicio::DATE BETWEEN :fec_ini and :fec_fin',
            'order'=>'fec_inicio ASC',
            'params'=>[':fec_ini'=>$fec_ini, ':fec_fin'=>$fec_fin]
        ]);
        $personalList = [];
        $total = 0;
        foreach ($cirugiaList as $cirugia){
            foreach ($cirugia->personalCirugias as $pc){
                $personalList[$pc->id_per]['nombre'] = $pc->persona->nombreCompleto;
                $personalList[$pc->id_per]['roles'][$pc->rol_cirugia] = isset($personalList[$pc->id_per]['roles'][$pc->rol_cirugia])?$personalList[$pc->id_per]['roles'][$pc->rol_cirugia]+1:1;
                $personalList[$pc->id_per]['total'] = isset($personalList[$pc->id_per]['total'])?$personalList[$pc->id_per]['total']+1:1;
            }
            $total+=$personalList[$pc->id_per]['total'];
        }
        spl_autoload_register(array('YiiBase', 'autoload'));
        $pdf = new MYPDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->cabecera1($pdf);
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetTextColor(80, 80, 80);
        $pdf->AddPage();
        $pdf->usuario($pdf);
        $pdf->Ln();
        $xc = 130;
        $yc = 60;
        $r = 30;
        $init = 0;
        $pdf->SetTextColor(255);
        $pdf->SetFont('', 'B');
        $pdf->setXY(50,35);
        foreach ($personalList as $per){
            $end = $init+ ($per['total']*360)/$total;
            $color = [rand(0,255),rand(0,255), rand(0,255)];
            $pdf->SetFillColor($color[0],$color[1], $color[2]);
            $pdf->Cell(30,7,$per['nombre'],0,2,'C',1,null,1);
            $pdf->PieSector($xc, $yc, $r, $init, $end, 'FD');
            $init = $end;
        }
        $pdf->SetFillColor(130);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('', 'B');
        // Header
        $header = array('Medico/enfermera',  'Rol', 'Participacion','Total participacion');
        $pdf->setXY(15,95);
        $w = array(60, 65,30, 30);
        foreach($header as $i=>$h) {
            $pdf->Cell($w[$i], 7, $h, 1, 0, 'C', 1,null,1);
        }
        $pdf->Ln();
        $pdf->SetFillColor(200);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = 0;
        $x = $pdf->GetX();
        $y = $pdf->GetY();
        foreach($personalList as $personal){
            $pdf->Cell($w[0], 7*count($personal['roles']), $personal['nombre'], 1, 0, 'L', $fill);
            foreach ($personal['roles'] as $r=>$rol){
              $pdf->SetX($x+$w[0]);
              $pdf->Cell($w[1], 7, $r, 1, 0, 'L', $fill);
              $pdf->Cell($w[2], 7, $rol, 1, 2, 'C', $fill);
            }
            $pdf->SetX($x+155);
            $pdf->Cell($w[3], 7*count($personal['roles']), $personal['total'], 1, 0, 'C', $fill,null,1,false,'B');
            $fill = !$fill;
            $pdf->SetX($x);
        }
        $pdf->Ln();
        $pdf->lastPage();
        $content = ltrim(substr($pdf->Output('', 'E'),124));
        Yii::app()->db->createCommand()->insert('audit_report', [
            'user_id'=>1,
            'fecha_report'=>date('d/m/Y H:i:s'),
            'name_report'=>'REPORTE ',
            'content_report'=>$content
        ]);
        header("Content-type: application/pdf");
        echo base64_decode($content);
    }

    public function actionGetReport(){

        $audit = Yii::app()->db->createCommand()
            ->from('audit_report')
            ->select('content_report')
            ->where('id_au_report = :id',[':id'=>5])
            ->queryRow();
        header("Content-type: application/pdf");
        echo base64_decode($audit['content_report']);
    }
    
}
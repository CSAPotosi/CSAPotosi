<?php

class ReporteLaboratorioController extends Controller
{
	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuReporteLaboratorio([],['lab','index']);
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }
        $labList = DetallePrestacion::model()->findAll([
            'condition'=>'fecha_solicitud between :fec_ini and :fec_fin',
            'order'=>'fecha_solicitud ASC',
            'params'=>[':fec_ini'=>$fec_ini,':fec_fin'=>$fec_fin]
        ]);
        $this->render('index',['fec_ini'=>$fec_ini,'fec_fin'=>$fec_fin,'labList'=>$labList]);
	}

    public function actionIndexPDF(){
        $this->menu = OptionsMenu::menuReporteLaboratorio([],['lab','index']);
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }
        $labList = DetallePrestacion::model()->findAll([
            'condition'=>'fecha_solicitud between :fec_ini and :fec_fin',
            'order'=>'fecha_solicitud ASC',
            'params'=>[':fec_ini'=>$fec_ini,':fec_fin'=>$fec_fin]
        ]);

        spl_autoload_register(array('YiiBase', 'autoload'));
        $pdf = new MYPDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->cabecera1($pdf);
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetTextColor(80, 80, 80);
        $pdf->AddPage();
        $pdf->usuario($pdf);

        $pdf->SetFillColor(115, 109, 109);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('', 'B');
        // Header
        $header = array('Fecha y hora',  'Paciente', 'Examen','Realizado');
        $pdf->setXY(15,95);
        $w = array(35, 65, 55,30);
        foreach($header as $i=>$h) {
            $pdf->Cell($w[$i], 7, $h, 1, 0, 'C', 1,null,1);
        }
        $pdf->Ln();
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = 0;
        $rea=0;$nr=0;
        foreach($labList as $lab){
            $pdf->Cell($w[0], 7, date('d/m/Y H:i',strtotime($lab->fecha_solicitud)), 1, 0, 'L', $fill);
            $pdf->Cell($w[1], 7, $lab->prestacion->historial->paciente->persona->nombreCompleto, 1, 0, 'L', $fill);
            $pdf->Cell($w[2], 7, $lab->servicio->nombre_serv, 1, 0, 'L', $fill);
            if($lab->realizado){
                $rea++;
                $pdf->Cell($w[3], 7, 'SI', 1, 0, 'L', $fill);
            }
            else{
                $nr++;
                $pdf->Cell($w[3], 7, 'NO', 1, 0, 'L', $fill);
            }

            $pdf->Ln();
            $fill = !$fill;
        }
        $pdf->Ln();
        $xc = 130;
        $yc = 60;
        $r = 30;
        $init = 0;
        $pdf->SetTextColor(255);
        $pdf->SetFont('', 'B');
        $pdf->setXY(50,35);
        $lista = ['Realizado'=>[$rea,0,0,255],'No realizado'=>[$nr,255,0,0]];
        $init=0;
        $totally = $rea+$nr;
        if ($totally==0)
            $totally=1;
        foreach ($lista as $i=>$re){
            $end = $init+ ($re[0]*360)/($totally);
            $pdf->SetFillColor($re[1],$re[2], $re[3]);
            $pdf->Cell(30,7,$i,0,2,'C',1,null,1);
            $pdf->PieSector($xc, $yc, $r, $init, $end, 'FD');
            $init = $end;
        }
        $pdf->lastPage();
        //Close and output PDF document
        $pdf->Output('filename.pdf', 'I');
    }

    public function actionExamenes(){
        $this->menu = OptionsMenu::menuReporteLaboratorio([],['lab','examenes']);
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }
        $labList = DetallePrestacion::model()->findAll([
            'condition'=>'fecha_solicitud between :fec_ini and :fec_fin and realizado',
            'order'=>'fecha_solicitud ASC',
            'params'=>[':fec_ini'=>$fec_ini,':fec_fin'=>$fec_fin]
        ]);
        $this->render('examenes',['fec_ini'=>$fec_ini,'fec_fin'=>$fec_fin,'labList'=>$labList]);
    }
}

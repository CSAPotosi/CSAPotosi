<?php

class ReporteInternacionController extends Controller
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
                'roles' => array('reporteInternacionIndex'),
            ),
            array('allow',
                'actions' => array('indexPDF'),
                'roles' => array('reporteInternacionIndexPDF'),
            ),
            array('allow',
                'actions' => array('graficas'),
                'roles' => array('reporteInternacionGraficas'),
            ),
            array('deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

	public function actionIndex()
	{
        $this->menu = OptionsMenu::menuReporteInternacion([],['internacion','reporteInternacion_Index']);
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }
        $internacionList = Internacion::model()->findAll([
            'order'=>'fecha_ingreso ASC',
            'condition'=>'fecha_ingreso between :fec_ini and :fec_fin',
            'params'=>[':fec_ini'=>$fec_ini,':fec_fin'=>$fec_fin]
        ]);

        $this->render('index',['internacionList'=>$internacionList,'fec_ini'=>$fec_ini,'fec_fin'=>$fec_fin]);
	}

	public function actionIndexPDF(){
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }
        $internacionList = Internacion::model()->findAll([
            'order'=>'fecha_ingreso ASC',
            'condition'=>'fecha_ingreso between :fec_ini and :fec_fin',
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
        $pdf->SetTextColor(0, 0, 0);

        $pdf->SetFillColor(115, 109, 109);
        $pdf->SetTextColor(255);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('', 'B');
        // Header
        $header = array('Fecha y hora internacion', 'Motivo', 'Procedencia', 'Paciente');
        $w = array(45,45,45,50);
        foreach($header as $i=>$h) {
            $pdf->Cell($w[$i], 7, $h, 1, 0, 'C', 1);
        }
        $pdf->Ln();
        $pdf->SetFillColor(224, 235, 255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        // Data
        $fill = 0;
        foreach($internacionList as $internacion){
            $pdf->Cell($w[0], 7, date('d/m/Y H:i',strtotime($internacion->fecha_ingreso)), 1, 0, 'L', $fill);
            $pdf->Cell($w[1], 7, Internacion::getMotivo()[$internacion->motivo_ingreso], 1, 0, 'L', $fill);
            $pdf->Cell($w[2], 7, Internacion::getProcedencia()[$internacion->procedencia_ingreso], 1, 0, 'L', $fill);
            $pdf->Cell($w[3], 7, $internacion->historial->paciente->persona->nombreCompleto, 1, 0, 'L', $fill);
            $pdf->Ln();
            $fill = !$fill;
        }
        $pdf->Ln();
        $pdf->lastPage();
        //Close and output PDF document
        $pdf->Output('filename.pdf', 'I');
    }

    public function actionGraficas(){
        $this->menu = OptionsMenu::menuReporteInternacion([],['internacion','reporteInternacion_Graficas']);
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        if(isset($_POST['fec_ini'],$_POST['fec_fin'])){
            $fec_ini = $_POST['fec_ini'];
            $fec_fin = $_POST['fec_fin'];
        }
        $condition = 'fecha_ingreso between :fec_ini and :fec_fin and motivo_ingreso = :motivo';
        $params = [':fec_ini'=>$fec_ini,':fec_fin'=>$fec_fin,':motivo'=>0];
        $motivo[0] = Internacion::model()->count($condition,$params);
        $params = [':fec_ini'=>$fec_ini,':fec_fin'=>$fec_fin,':motivo'=>1];
        $motivo[1] = Internacion::model()->count($condition,$params);
        $params = [':fec_ini'=>$fec_ini,':fec_fin'=>$fec_fin,':motivo'=>2];
        $motivo[2] = Internacion::model()->count($condition,$params);

        $condition = 'fecha_ingreso between :fec_ini and :fec_fin and procedencia_ingreso = :procedencia';
        $params = [':fec_ini'=>$fec_ini,':fec_fin'=>$fec_fin,':procedencia'=>0];
        $procedencia[0] = Internacion::model()->count($condition,$params);
        $params = [':fec_ini'=>$fec_ini,':fec_fin'=>$fec_fin,':procedencia'=>1];
        $procedencia[1] = Internacion::model()->count($condition,$params);
        $params = [':fec_ini'=>$fec_ini,':fec_fin'=>$fec_fin,':procedencia'=>2];
        $procedencia[2] = Internacion::model()->count($condition,$params);

        $this->render('graficas',['fec_ini'=>$fec_ini,'fec_fin'=>$fec_fin,'motivo'=>$motivo,'procedencia'=>$procedencia]);
    }
}
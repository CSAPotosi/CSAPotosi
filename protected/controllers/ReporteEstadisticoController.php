<?php

class ReporteEstadisticoController extends Controller
{
    public function actionIndex()
    {
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        $tipo = 0;
        if (isset($_POST['Report'])) {
            $fec_ini = $_POST['Report']['fec_ini'];
            $fec_fin = $_POST['Report']['fec_fin'];
            $tipo = $_POST['Report']['tipoEstadistico'];
        }
        $valor = ($tipo == 0) ? 0 : 1;
        $diagnosticos = Diagnostico::model()->findAll([
            'condition' => "fecha_diag::DATE BETWEEN :fec_ini and :fec_fin and tipo={$valor}",
            'params' => [':fec_ini' => $fec_ini, ':fec_fin' => $fec_fin]
        ]);
        $capitulo = [];
        foreach ($diagnosticos as $diag) {
            $valor = $diag->itemCies;
            foreach ($valor as $v) {
                $item = $v->idCat->numCap->num_cap;
                $capitulo[$item] = isset($capitulo[$item]) ? $capitulo[$item] + 1 : 1;
            }
        }
        $this->render('index', ['fec_ini' => $fec_ini, 'fec_fin' => $fec_fin, 'capitulo' => $capitulo]);
    }

    public function actionEstadisticoPdf()
    {
        $fec_ini = date('d/m/Y');
        $fec_fin = date('d/m/Y');
        $tipo = 0;
        if (isset($_POST['Report'])) {
            $fec_ini = $_POST['Report']['fec_ini'];
            $fec_fin = $_POST['Report']['fec_fin'];
            $tipo = $_POST['Report']['tipoEstadistico'];
        }
        $valor = ($tipo == 0) ? 0 : 1;
        $diagnosticos = Diagnostico::model()->findAll([
            'condition' => "fecha_diag::DATE BETWEEN :fec_ini and :fec_fin and tipo={$valor}",
            'params' => [':fec_ini' => $fec_ini, ':fec_fin' => $fec_fin]
        ]);
        $capitulo = [];
        $total = 0;
        foreach ($diagnosticos as $diag) {
            $valor = $diag->itemCies;
            foreach ($valor as $v) {
                $item = $v->idCat->numCap->num_cap;
                $capitulo[$item] = isset($capitulo[$item]) ? $capitulo[$item] + 1 : 1;
                $total++;
            }
        }
        $titulo = 'Reporte Estadistico' . ($tipo == 0) ? 'Consulta Externa' : 'Hospitalaria';
        spl_autoload_register(array('YiiBase', 'autoload'));
        $pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle("Reporte Asistencia");
        //cabecera 1 logo santa ana
        $pdf->cabecera1();
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetTextColor(80, 80, 80);
        $pdf->AddPage();
        $pdf->usuario();
        $pdf->titulo($titulo);
        $pdf->lastPage();
        $pdf->Ln(3);
        $xc = 150;
        $yc = 70;
        $r = 30;
        $init = 0;
        $pdf->SetTextColor(255);
        $pdf->SetFont('', 'B');
        $pdf->setXY(50, 35);
        foreach ($capitulo as $cap => $cant) {
            $end = $init + ($cant * 360) / $total;
            $color = [rand(0, 255), rand(0, 255), rand(0, 255)];
            $pdf->SetFillColor($color[0], $color[1], $color[2]);
            $pdf->Cell(30, 7, $cap, 0, 2, 'C', 1, null, 1);
            $pdf->PieSector($xc, $yc, $r, $init, $end, 'FD');
            $init = $end;
        }
        $pdf->SetFillColor(130);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(0, 0, 0);
        $pdf->SetLineWidth(0.3);
        $pdf->SetFont('', 'B');
        $header = array('Capitulo', 'Descripcion', 'Cantidad',);
        $pdf->setXY(15, 125);
        $w = array(15, 210, 30);
        foreach ($header as $i => $h) {
            $pdf->Cell($w[$i], 7, $h, 1, 0, 'C', 1, null, 1);
        }
        $pdf->Ln();
        foreach ($capitulo as $cap => $cant) {
            $capitulo = CapituloCie::model()->findByPk($cap);
            $pdf->Cell($w[0], 6, $cap, 'LR', 0, 'C', 0);
            $pdf->Cell($w[1], 6, $capitulo->titulo_cap, 'LR', 0, 'L', 0);
            $pdf->Cell($w[2], 6, $cant, 'LR', 0, 'C', 0);
            $pdf->Ln();
        }
        $pdf->Cell(array_sum($w), 0, '', 'T');
        //Close and output PDF document
        $pdf->Output('estadisco', 'I');
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
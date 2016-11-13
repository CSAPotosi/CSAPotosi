<?php
Yii::import('ext.tcpdf.*');

class MYPDF extends TCPDF
{

    // Load table data from file
    public function LoadData($file)
    {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach ($lines as $line) {
            $data[] = explode(';', chop($line));
        }
        return $data;
    }

    // Colored table
    public function ColoredTableAsistencia($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(0, 0, 0);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(40, 40, 40, 40, 50, 60);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row[2], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row[3], 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 6, $row[3], 'LR', 0, 'R', $fill);
            $this->Cell($w[5], 6, $row[3], 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    public function cabecera1($pdf)
    {
        $pdf->SetHeaderData('logoCSASin.png', '20px', "CLINICA SANTA ANA POTOSI", "10 de noviembre. zona San roque. Tel(2-62-645789)");
        $pdf->SetMargins(PDF_MARGIN_LEFT, '20px', PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    }

    public function usuario($pdf)
    {
        $admin = Yii::app()->user->name;
        $html = "<span class='txt-color-darken'>Usuario: </span>&nbsp;&nbsp;&nbsp;" . $admin . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span align='left'>Fecha Emision:</span>" . date('d-m-Y') . ".";
        $pdf->writeHTML($html);
        $pdf->Ln(2);
    }

    public function createTableDetalleAistencia($fecha_ini, $interval, $fecha_ini_real, $empleado)
    {
        $asignacion = AsignacionEmpleado::model()->findByPk($empleado);
        $this->SetFont('helvetica', '', 20);
        $this->Write(0, $asignacion->empleado->empleadoPersona->getNombreCompleto(), '', 0, 'L', true, 0, false, false, 0);
        $this->SetFont('helvetica', '', 8);
        $this->SetFillColor(46, 139, 87);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('');
        $this->Cell(30, 6, 'Tiqueos Validos', '', 0, 'C', 1);
        $this->SetFillColor(70, 130, 180);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('');
        $this->Cell(30, 6, 'Tiqueos Invalidos', '', 0, 'C', 1);
        $this->Ln(8);
        $header = array('Lunes', 'Martes', 'Miercoles', 'Juevez', 'Viernes', 'Sabado', 'Domingo');
        $i = 0;
        while ($i <= $interval) {
            $lunes = date('d-m-Y', strtotime($fecha_ini));
            $martes = date('d-m-Y', strtotime('+1 day', strtotime($fecha_ini)));
            $miercoles = date('d-m-Y', strtotime('+2 day', strtotime($fecha_ini)));
            $juevez = date('d-m-Y', strtotime('+3 day', strtotime($fecha_ini)));
            $viernes = date('d-m-Y', strtotime('+4 day', strtotime($fecha_ini)));
            $sabado = date('d-m-Y', strtotime('+5 day', strtotime($fecha_ini)));
            $domingo = date('d-m-Y', strtotime('+6 day', strtotime($fecha_ini)));
            $this->SetTextColor(0, 0, 0);
            $textoHtml = '';
            for ($j = 1; $j <= 7; $j++) {
                $var = '';
                if (strtotime($fecha_ini) >= strtotime($fecha_ini_real)) {
                    $registro = Registro::model()->findAll(array(
                        'condition' => "id_asignacion={$asignacion->id_asignacion} and fecha='{$fecha_ini}' order by hora_asistencia",
                    ));
                    if ($registro != []) {
                        foreach ($registro as $item) {
                            if ($item->estado) {

                                $var = "" . $var . "<b style=\"color: #00a65a\">" . $item->hora_asistencia . "</b><br>";
                            } else
                                $var = "" . $var . "<b style=\"color: blue\">" . $item->hora_asistencia . "</b><br>";
                        }
                    }
                }
                $textoHtml = "" . $textoHtml . "<td style=\"font-size:12px\" width=\"105px\">" . $var . "</td>";
                $fecha_ini = strtotime('+1 day', strtotime($fecha_ini));
                $fecha_ini = date('Y-m-d', $fecha_ini);
                $i++;
            }

            $tbl = <<<EOD
            <table cellspacing="0" cellpadding="1" border="1">
                <tr>
                    <th style="font-size:12px" width="105px">$lunes(Lun)</th>
                    <th style="font-size:12px" width="105px">$martes(Mar)</th>
                    <th style="font-size:12px" width="105px">$miercoles(Mie)</th>
                    <th style="font-size:12px" width="105px">$juevez(Jue)</th>
                    <th style="font-size:12px" width="105px">$viernes(Vie)</th>
                    <th style="font-size:12px" width="105px">$sabado(Sab)</th>
                    <th style="font-size:12px" width="105px">$domingo(Dom)</th>
                </tr>
                <tr>
                    $textoHtml
                </tr>
            </table>
EOD;
            $this->writeHTML($tbl, true, false, false, false, '');
            $this->Ln();
        }
    }
}
?>
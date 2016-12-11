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

    public function cabecera1()
    {
        $this->SetHeaderData('logoCSASin.png', '20px', "CLINICA SANTA ANA POTOSI", "10 de noviembre. zona San roque. Tel(2-62-645789)");
        $this->SetMargins(PDF_MARGIN_LEFT, '20px', PDF_MARGIN_RIGHT);
        $this->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->SetFooterMargin(PDF_MARGIN_FOOTER);
    }

    public function usuario()
    {
        $admin = Yii::app()->user->name;
        $html = "<span class='txt-color-darken'>Usuario: </span>&nbsp;&nbsp;&nbsp;" . $admin . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span align='left'>Fecha Emision:</span>" . date('d-m-Y') . ".";
        $this->writeHTML($html);
        $this->Ln(2);
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
            $lunes = date('d/m/Y', strtotime($fecha_ini));
            $martes = date('d/m/Y', strtotime('+1 day', strtotime($fecha_ini)));
            $miercoles = date('d/m/Y', strtotime('+2 day', strtotime($fecha_ini)));
            $juevez = date('d/m/Y', strtotime('+3 day', strtotime($fecha_ini)));
            $viernes = date('d/m/Y', strtotime('+4 day', strtotime($fecha_ini)));
            $sabado = date('d/m/Y', strtotime('+5 day', strtotime($fecha_ini)));
            $domingo = date('d/m/Y', strtotime('+6 day', strtotime($fecha_ini)));
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

    public function cabeceraPaciente($paciente)
    {
        $nombre = $paciente->persona->getNombreCompleto();
        $codigo_paciente = $paciente->codigo_paciente;
        $num_doc = $paciente->persona->num_doc;
        $fecha_naciemiento = date('d/m/Y', strtotime($paciente->persona->fecha_nac));
        if ($paciente->asegurado) {
            foreach ($paciente->asegurado as $item) {

                if ($item->activo == true) {
                    $nombre_seguro = $item->pacienteConvenio->nombre_convenio;
                    if ($item->tipo_asegurado == 1) {
                        $tipo_asegurado = 'titular';
                        $beneficiario = '---';
                    } else {
                        $tipo_asegurado = 'Beneficiario';
                        $beneficiario = $item->pacienteTitular->persona->getNombreCompleto();
                    }
                    break;
                } else {
                    $nombre_seguro = 'No existe';
                    $tipo_asegurado = 'No existe';
                    $beneficiario = 'No existe';
                }
            }
        } else {
            $nombre_seguro = 'No existe';
            $tipo_asegurado = 'No existe';
            $beneficiario = 'No existe';
        }

        $tbl = <<<EOD
            <table cellspacing="0" cellpadding="1"  >
                <tr>
                    <td width="20%"><b>Paciente:</b></td>
                    <td width="40%"> $nombre</td>
                    <td width="20%"><b>Codigo Paciente:</b></td>
                    <td width="20%">$codigo_paciente</td>
                    <td></td>
                </tr>
                <tr>
                    <th><b>Numero de Documento</b></th>
                    <td> $num_doc</td>
                    <th><b>fecha Naciemiento</b></th>
                    <td> $fecha_naciemiento</td>
                </tr>
                <tr>
                    <th><b>Tipo Paciente</b> $tipo_asegurado</th>
                    <td colspan="3"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Convenio Seguro:</b> $nombre_seguro&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Titular: </b> $beneficiario</td>
                    
                </tr>
                
            </table>
EOD;
        $this->writeHTML($tbl, true, false, false, false, '');
        $this->Ln();
    }

    public function titulo($texto)
    {
        $tbl = <<<EOD
            <table cellspacing="0" cellpadding="1"  >
                <tr>
                    <td width="100%" align="center" style="font-size:20px">$texto</td>
                </tr>
            </table>
EOD;
        $this->writeHTML($tbl, true, false, false, false, '');
        $this->Ln();
    }

    public function comprobante($cita)
    {
        $nombre_espe = $cita->medicoConsultaServicio->idEspecialidad->nombre_especialidad;
        $medico = $cita->medicoConsultaServicio->medico->persona->getNombreCompleto();
        $fecha = $cita->fecha;
        $hora = $cita->hora_cita;
        $estado = $cita->estado_cita;
        if ($estado == 1)
            $estado = 'Pagado';
        elseif ($estado == 0)
            $estado = 'Reservado';
        elseif ($estado == 2)
            $estado = 'Reconsulta';
        if ($estado == 'Pagado') {
            $campo = 'Costo de la Consulta';
            $monto = $cita->medicoConsultaServicio->atencionMedica->servicio->precio->monto;
        } else {
            $campo = '';
            $monto = '';
        }
        $tbl = <<<EOD
            <table cellspacing="0" cellpadding="1"  >
                <tr>
                    <td width="20%" style="font-size:14px"><b>Medico:</b></td>
                    <td width="40%" style="font-size:14px"> $medico</td>
                    <td width="20%" style="font-size:14px"><b>Especialidad: </b></td>
                    <td width="20%" style="font-size:14px">$nombre_espe</td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size:14px"><b>Fecha: </b>$fecha&nbsp;&nbsp;&nbsp;&nbsp;<b>Hora:</b> $hora</td>
                    <td colspan="2" style="font-size:14px"><b>Estado Cita </b>: $estado </td>
                </tr>
                <tr>
                    <td colspan="4" style="font-size:14px"><b>$campo</b>: $monto</td>
                </tr>
            </table>
EOD;
        $this->writeHTML($tbl, true, false, false, false, '');
        $this->Ln(5);
    }

    public function comprobantePrestacion($prestacion, $valor)
    {
        $servicio = DetallePrestacion::model()->findAll(array(
            'condition' => "id_prestacion ='{$prestacion->id_prestacion}'",
        ));
        $listalaboratorio = array();
        $listagabinete = array();
        $listaotros = array();
        foreach ($servicio as $ser):
            $det = Servicio::model()->findByPk($ser->id_servicio);
            if ($det->servExamen != null) {
                if ($det->servExamen->categoria->tipo_ex == 1)
                    $listalaboratorio[] = $det->servExamen;
                elseif ($det->servExamen->categoria->tipo_ex == 2)
                    $listagabinete[] = $det->servExamen;
            }
            if ($det->servClinico != null) {
                $listaotros[] = $det->servClinico;
            }
        endforeach;
        $html = '';
        if ($listalaboratorio != null) {
            $cat1 = 0;
            function cmp($a, $b)
            {
                if ($a == $b) {
                    return 0;
                }
                return ($a < $b) ? -1 : 1;
            }

            uasort($listalaboratorio, 'cmp');
            $html = $html . "<tr><td><h3><i><u>LABORATORIO</u></i></h3></td></tr>";
            foreach ($listalaboratorio as $lab):
                $cat2 = $lab->id_cat_ex;
                if ($cat1 != $cat2) {
                    $nombre = $lab->categoria->nombre_cat_ex;
                    $html = $html . "<tr>
                <td><h4><u>$nombre</u></h4></td>
            </tr>";

                    $cat1 = $cat2;
                } else {
                    $cat1 = $cat2;
                }
                $nombreServicio = $lab->datosServicio->nombre_serv;
                $precio = $lab->datosServicio->precio->monto;
                $cantidad = DetallePrestacion::model()->find(array(
                    'condition' => "id_prestacion='{$prestacion->id_prestacion}' and id_servicio='{$lab->datosServicio->id_serv}'",
                ));
                $cant = $cantidad->cantidad;
                $total = $lab->datosServicio->precio->monto * $cantidad->cantidad;
                $html = $html . "<tr>
            <td>$nombreServicio</td>
            <td align=\"center\">$precio</td>
            <td align=\"center\">$cant</td>
            <td align=\"center\">$total</td>
        </tr>";
            endforeach;
        }
        if ($listagabinete != null) {
            $cat1 = 0;
            function cmt($a, $b)
            {
                if ($a == $b) {
                    return 0;
                }
                return ($a < $b) ? -1 : 1;
            }

            uasort($listagabinete, 'cmt');
            $html = $html . "<tr><td><h3><i><u>RAYOS X</u></i></h3></td></tr>";
            foreach ($listagabinete as $gab):
                $cat2 = $gab->id_cat_ex;
                if ($cat1 != $cat2) {
                    $nombre = $gab->categoria->nombre_cat_ex;
                    $html = $html . "<tr>
                <td><h4><u>$nombre</u></h4></td>
            </tr>";

                    $cat1 = $cat2;
                } else {
                    $cat1 = $cat2;
                }
                $nombreServicio = $gab->datosServicio->nombre_serv;
                $precio = $gab->datosServicio->precio->monto;
                $cantidad = DetallePrestacion::model()->find(array(
                    'condition' => "id_prestacion='{$prestacion->id_prestacion}' and id_servicio='{$lab->datosServicio->id_serv}'",
                ));
                $cant = $cantidad->cantidad;
                $total = $gab->datosServicio->precio->monto * $cantidad->cantidad;
                $html = $html . "<tr>
            <td>$nombreServicio</td>
            <td align=\"center\">$precio</td>
            <td align=\"center\">$cant</td>
            <td align=\"center\">$total</td>
        </tr>";
            endforeach;
        }
        if ($listaotros != null) {
            $cat1 = 0;
            function cml($a, $b)
            {
                if ($a == $b) {
                    return 0;
                }
                return ($a < $b) ? -1 : 1;
            }

            uasort($listaotros, 'cml');
            $html = $html . "<tr><td><h3><i><u>ENFERMERIA Y OTROS</u></i></h3></td></tr>";
            foreach ($listaotros as $cli):
                $cat2 = $cli->id_cat_cli;
                if ($cat1 != $cat2) {
                    $nombre = $cli->categoria->nombre_cat_cli;
                    $html = $html . "<tr>
                <td><h4><u>$nombre</u></h4></td>
            </tr>";

                    $cat1 = $cat2;
                } else {
                    $cat1 = $cat2;
                }
                $nombreServicio = $cli->datosServicio->nombre_serv;
                $precio = $cli->datosServicio->precio->monto;
                $cantidad = DetallePrestacion::model()->find(array(
                    'condition' => "id_prestacion='{$prestacion->id_prestacion}' and id_servicio='{$cli->datosServicio->id_serv}'",
                ));
                $cant = $cantidad->cantidad;
                $total = $cli->datosServicio->precio->monto * $cantidad->cantidad;
                $html = $html . "<tr>
            <td>$nombreServicio</td>
            <td align=\"center\">$precio</td>
            <td align=\"center\">$cant</td>
            <td align=\"center\">$total</td>
        </tr>";
            endforeach;
        }
        $html = $html . "<tr>
                    <td><h3><i><u>SUMA TOTAL</u></i></h3></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
                    <td align=\"center\">$valor</td>
                </tr>";
        $tbl = <<<EOD
            <table cellpadding="5">
                <tr>
                    <td><h4>NOMBRE DEL SERVICIO</h4></td>    
                    <td align="center"><h4>PRECIO</h4></td>    
                    <td align="center"><h4>CANTIDAD</h4></td>    
                    <td align="center"><h4>TOTAL</h4></td>    
                </tr>
                    $html
            </table>
EOD;
        $this->writeHTML($tbl, true, false, false, false, '');
        $this->Ln();
    }
}
?>
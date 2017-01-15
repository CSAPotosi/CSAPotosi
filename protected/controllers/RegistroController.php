<?php

class RegistroController extends Controller
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
                'actions' => array('Create'),
                'roles' => array('registroCreate'),
            ),
            array('allow',
                'actions' => array('Subir'),
                'roles' => array('registroSubir'),
            ),
            array('allow',
                'actions' => array('reportAsistencia'),
                'roles' => array('registroReportAsistencia'),
            ),
            array('allow',
                'actions' => array('getCargosAjax'),
                'roles' => array('registroGetCargosAjax'),
            ),
            array('allow',
                'actions' => array('getEmpleadosAjax'),
                'roles' => array('registroGetEmpleadosAjax'),
            ),
            array('allow',
                'actions' => array('getEmpleadoAjax'),
                'roles' => array('registroGetEmpleadoAjax'),
            ),
            array('allow',
                'actions' => array('registroManual'),
                'roles' => array('registroRegistroManual'),
            ),
            array('allow',
                'actions' => array('busquedaCi'),
                'roles' => array('registroBusquedaCi'),
            ),
            array('allow',
                'actions' => array('registrarAsistencia'),
                'roles' => array('registroRegistrarAsistencia'),
            ),
            array('allow',
                'actions' => array('detalleAsistencia'),
                'roles' => array('registroDetalleAsistencia'),
            ),
            array('allow',
                'actions' => array('CreatePdfAsistencia'),
                'roles' => array('registroCreatePdfAsistencia'),
            ),
            array('allow',
                'actions' => array('CreatePdfDetalleAsistencia'),
                'roles' => array('registroCreatePdfDetalleAsistencia'),
            ),
            array('allow',
                'actions' => array('CreatePdfDetalleAsistenciaGeneral'),
                'roles' => array('registroCreatePdfDetalleAsistenciaGeneral'),
            ),
            array('allow',  // deny all users
                'users' => array('*'),
            ),
        );
    }
    public function actionCreate()
    {
        $this->menu = OptionsMenu::menuAsignacion([], ['asistencia', 'Crear Registro']);
        $modelRegistro = new Registro();
        if (isset($_POST['Registro'])) {
            $modelRegistro->attributes = $_POST['Registro'];
            if ($modelRegistro->save()) {
                $this->redirect(array('create'));
            }
        }
        $this->render('create', array(
            'modelRegistro' => $modelRegistro,
        ));
    }

    public function actionSubir()
    {
        $this->menu = OptionsMenu::menuAsignacion([], ['asistencia', 'Cargar Asistencia']);
        $ruta = "archivo/";
        $modelSubir = new Subir();
        $directorio = opendir('archivo/');
        $listRegistro = Registro::model()->findAll();
        if (isset($_POST['Subir'])) {
            $archivo = CUploadedFile::getInstance($modelSubir, 'uploadedfile');
            if ($archivo != null) {
                if ($archivo->getExtensionName() == "txt" || $archivo->getExtensionName() == "dat") {
                    $ruta = $ruta . basename($archivo->getName());
                    if (move_uploaded_file($archivo->tempName, $ruta)) {
                        $file = fopen($ruta, 'r');
                        while (!feof($file)) {
                            $linea = fgets($file);
                            $valor = explode("\t", $linea, 3);
                            if (count($valor) > 1) {
                                $fCompleta = explode(" ", $valor[1], 2);
                                $empleado = Empleado::model()->findAll(array('condition' => "cod_maquina={$valor[0]}"));
                                if ($empleado != null)
                                    if ($empleado[0]->asignacion != null) {
                                        $modelRegistro = new Registro();
                                        $modelRegistro->id_asignacion = $empleado[0]->asignacionValida[0]->id_asignacion;
                                        $modelRegistro->fecha = $fCompleta[0];
                                        $modelRegistro->hora_asistencia = $fCompleta[1];
                                        $modelRegistro->observaciones = "MAQUINA";
                                        $modelRegistro->estado = false;
                                        $list = Registro::model()->findByPk(array('id_asignacion' => $modelRegistro->id_asignacion, 'fecha' => $modelRegistro->fecha, 'hora_asistencia' => $modelRegistro->hora_asistencia));
                                        if (!$list)
                                            $modelRegistro->save();
                                    }
                            } else break;
                        }
                    }
                } else
                    Yii::app()->user->setFlash('extencion', 'Se Permite Archivos con Extencion .txt y .dat');
            } else
                Yii::app()->user->setFlash('vacio', 'Tiene que seleccionar un archivo de Asistencia');
        }
        $this->render('subir', array('directorio' => $directorio, 'modelSubir' => $modelSubir));
    }

    public function actionreportAsistencia()
    {
        $this->menu = OptionsMenu::menuAsignacion([], ['asistencia', 'Informacion Asistencia']);
        $listaAsistenciaEmpleados = null;
        if (isset($_POST['unidad'])) {
            $fechas = explode(' - ', $_POST['daterange'], 2);
            if ($_POST['unidad']) {
                if ($_POST['cargo'] != 0) {
                    if ($_POST['empleado'] != 0) {
                        $listaEmpleado = AsignacionEmpleado::model()->findAll(array(
                            'condition' => "id_asignacion={$_POST['empleado']} and fecha_fin is null"
                        ));
                        $listaAsistenciaEmpleados = $this->buscar($listaEmpleado, $fechas[0], $fechas[1]);
                    } else {
                        $listaEmpleado = AsignacionEmpleado::model()->findAll(array(
                            'condition' => "id_cargo={$_POST['cargo']} and fecha_fin is null",
                        ));
                        $listaAsistenciaEmpleados = $this->buscar($listaEmpleado, $fechas[0], $fechas[1]);
                    }
                } else {
                    $unidad = Unidad::model()->findByPk($_POST['unidad']);
                    $listaCargo = $unidad->cargos;
                    $listaEmpleado = array();
                    foreach ($listaCargo as $item) {
                        foreach ($item->asignacionReporte as $var) {
                            $listaEmpleado[] = $var;
                        }
                    }
                    $listaAsistenciaEmpleados = $this->buscar($listaEmpleado, $fechas[0], $fechas[1]);
                }
            } else {
                $listaEmpleado = AsignacionEmpleado::model()->findAll(array(
                    'condition' => "fecha_fin is null",
                ));
                $listaAsistenciaEmpleados = $this->buscar($listaEmpleado, $fechas[0], $fechas[1]);
            }
        }
        $this->render('reportAsistencia', array('listaEmpleadosAsistencia' => $listaAsistenciaEmpleados));
    }

    public function actiongetCargosAjax()
    {

        $unidad = $_POST['unidad'];
        $listCargo = Cargo::model()->findAll(array(
            'condition' => "id_unidad={$unidad}",
        ));
        $lista = CHtml::listData($listCargo, 'id_cargo', 'nombre_cargo');
        $i = 0;
        foreach ($lista as $valor => $descripcion) {
            if ($i == 0) {
                echo CHtml::tag('option', array('value' => 0), CHtml::encode('TODOS'), true);
            }
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($descripcion), true);
            $i++;
        }
    }

    public function actiongetEmpleadosAjax()
    {
        $empleado = $_POST['cargo'];
        $listEmpleado = AsignacionEmpleado::model()->findAll(array(
            'condition' => "id_cargo = {$empleado} and fecha_fin is null"
        ));
        $lista = CHtml::listData($listEmpleado, 'id_asignacion', 'id_empleado');
        array_unshift($lista, 'TODOS');
        foreach ($lista as $valor => $descripcion) {
            if ($descripcion != 'TODOS') {
                $persona = Persona::model()->findByPk($descripcion);
                $nombre = $persona->getNombreCompleto();
                $valor = $persona->empleado->asignacionValida[0]->id_asignacion;
            } else {
                $nombre = 'TODOS';
                $valor = 0;
            }
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($nombre), true);
        }
    }

    public function actiongetEmpleadoAjax()
    {
        $empleado = $_POST['cargo'];
        $listEmpleado = AsignacionEmpleado::model()->findAll(array(
            'condition' => "id_cargo = {$empleado} and fecha_fin is null"
        ));
        $lista = CHtml::listData($listEmpleado, 'id_asignacion', 'id_empleado');
        array_unshift($lista, 'SELECCIONE');
        foreach ($lista as $valor => $descripcion) {
            if ($descripcion != 'SELECCIONE') {
                $persona = Persona::model()->findByPk($descripcion);
                $nombre = $persona->getNombreCompleto();
                $valor = $persona->empleado->asignacionValida[0]->id_asignacion;
            } else {
                $nombre = 'SELECCIONE';
                $valor = '';
            }
            echo CHtml::tag('option', array('value' => $valor), CHtml::encode($nombre), true);
        }
    }

    private function buscar($listaEmpleado, $fecha_ini, $fecha_fin)
    {
        foreach ($listaEmpleado as $empleado) {
            $ciclo = $empleado->cargo->horario->ciclo_total;
            $fecha_inicial = $empleado->fecha_inicio;
            $date1 = date_create($fecha_inicial);
            $date2 = date_create($fecha_fin);
            $interval = date_diff($date1, $date2);
            $interval = $interval->format('%a');
            $var = 0;
            $cantidad_dias_trabajados = 0;
            $minutos_retraso = 0;
            $horas_trabajada = 0;
            while ($var <= (int)$interval) {
                for ($i = 1; $i <= $ciclo; $i++) {
                    if ($var <= $interval) {
                        $var++;
                        if (($this->check_in_range($fecha_ini, $fecha_fin, $fecha_inicial))) {
                            $fecha_en_dia = Registro::model()->findAll(array(
                                'condition' => "id_asignacion={$empleado->id_asignacion} and fecha='{$fecha_inicial}'",
                            ));
                            $horarios = HorarioPeriodo::model()->findAll(array(
                                'condition' => "dia={$i} and id_horario={$empleado->cargo->horario->id_horario}",
                            ));
                            $dia_valido = false;
                            $minutos_parcial = 0;
                            $horas_parcial = 0;
                            $bandera = 0;
                            foreach ($horarios as $item) {

                                if ($item->periodo->tipo_periodo == 1) {
                                    $fecha_dos = strtotime('+1 day', strtotime($fecha_inicial));
                                    $fecha_dos = date('Y-m-d', $fecha_dos);

                                    $fecha_en_dia_24 = Registro::model()->findAll(array(
                                        'condition' => "id_asignacion={$empleado->id_asignacion} and fecha='{$fecha_dos}'",
                                    ));
                                    if ($this->hour_in_range($item, $fecha_en_dia) != null && $this->hour_out_range($item, $fecha_en_dia_24) != null) {
                                        $listaentrada = $this->hour_in_range($item, $fecha_en_dia);
                                        $minutos_parcial = $minutos_parcial + ($this->minutos_in_retraso($item, $listaentrada));
                                        $horas_parcial = $horas_parcial + ($this->horas_trabajadas($listaentrada, $this->hour_out_range($item, $fecha_en_dia_24), $item));
                                        $horas_parcial = $horas_parcial + strtotime('+1 day', $horas_parcial);
                                        $dia_valido = true;
                                    } else {
                                        $dia_valido = false;
                                        $minutos_parcial = 0;
                                        $horas_parcial = 0;
                                        break;
                                    }
                                } else {
                                    if ($this->hour_in_range($item, $fecha_en_dia) != null && $this->hour_out_range($item, $fecha_en_dia) != null) {
                                        $listaentrada = $this->hour_in_range($item, $fecha_en_dia);
                                        $minutos_parcial = $minutos_parcial + ($this->minutos_in_retraso($item, $listaentrada));
                                        $horas_parcial = $horas_parcial + ($this->horas_trabajadas($listaentrada, $this->hour_out_range($item, $fecha_en_dia), $item));
                                        $dia_valido = true;
                                    } else {
                                        $bandera = 1;
                                    }
                                }
                            }
                            if ($dia_valido) {
                                if ($bandera == 1) {
                                    $horas_trabajada = $horas_parcial + $horas_trabajada;
                                } else {
                                    $cantidad_dias_trabajados++;
                                    $minutos_retraso = $minutos_retraso + $minutos_parcial;
                                    $horas_trabajada = $horas_parcial + $horas_trabajada;
                                }
                            } else
                                $horas_trabajada = $horas_parcial + $horas_trabajada;
                        }
                        $fecha_inicial = strtotime('+1 day', strtotime($fecha_inicial));
                        $fecha_inicial = date('Y-m-d', $fecha_inicial);
                    } else
                        break;
                }//end for
            }//end while
            $valor = $this->conversorSegundosHoras($horas_trabajada);
            $listaAsitenciaEmpleados[] = [$empleado->cargo->unidad->nombre_unidad, $empleado->cargo->nombre_cargo, $empleado->empleado->empleadoPersona->getNombreCompleto(), $cantidad_dias_trabajados, $valor, round($minutos_retraso / 60), $fecha_ini, $fecha_fin, $empleado->id_asignacion];
        }//end foreach
        return $listaAsitenciaEmpleados;
    }

    private function check_in_range($startdate, $enddate, $date)
    {
        $start = strtotime($startdate);
        $end = strtotime($enddate);
        $evalue = strtotime($date);
        return (($evalue >= $start) && ($evalue <= $end));
    }

    private function hour_in_range($item, $hora)
    {
        $inicio = date('H:i', (strtotime($item->periodo->hora_entrada) - $item->periodo->inicio_entrada * 60));
        $fin = date('H:i', (strtotime($item->periodo->hora_entrada) + $item->periodo->fin_salida * 60));
        $listaRango = array();
        foreach ($hora as $item_1) {
            $en_ini = strtotime($inicio);
            $en_fin = strtotime($fin);
            $v = strtotime($item_1->hora_asistencia);
            if (($v >= $en_ini) && ($v <= $en_fin)) {
                $listaRango[] = $item_1;
            }
        }
        return $listaRango;
    }

    private function hour_out_range($item, $hora)
    {

        $inicio = date('H:i', (strtotime($item->periodo->hora_salida) - $item->periodo->inicio_salida * 60));
        $fin = date('H:i', (strtotime($item->periodo->hora_salida) + $item->periodo->fin_salida * 60));
        $listaRango = array();
        foreach ($hora as $item_1) {
            $sa_ini = strtotime($inicio);
            $sa_fin = strtotime($fin);
            $v = strtotime($item_1->hora_asistencia);
            if (($v >= $sa_ini) && ($v <= $sa_fin)) {
                $listaRango[] = $item_1;
            }
        }
        return $listaRango;
    }

    private function minutos_in_retraso($item, $hora)
    {
        $hora_entrada = strtotime($item->periodo->hora_entrada);
        $numero_evaluar = (strtotime('24:00'));
        $r = 0;
        foreach ($hora as $var) {
            $valor = strtotime($var->hora_asistencia);
            $resultado = abs($hora_entrada - $valor);
            $r = $hora_entrada - $valor;
            if ($resultado <= $numero_evaluar) {
                foreach ($hora as $i) {
                    $i->estado = false;
                    $i->save();
                }
                $numero_evaluar = $resultado;
                $var->estado = true;
                $var->save();
            }
        }
        if ($numero_evaluar <= ($item->periodo->tolerancia * 60) || $r >= 0)
            return 0;
        else
            return $numero_evaluar - ($item->periodo->tolerancia * 60);
    }

    private function horas_trabajadas($listaEntrada, $listaSalida, $item)
    {
        $hora_salida = strtotime($item->periodo->hora_salida);
        $numero_evaluar = strtotime('00:00');
        foreach ($listaSalida as $var) {
            $valor = strtotime($var->hora_asistencia);
            $resultado = $hora_salida - $valor;
            if ($resultado < $numero_evaluar) {
                foreach ($listaSalida as $i) {
                    $i->estado = false;
                    $i->save();
                }
                $numero_evaluar = $resultado;
                $var->estado = true;
                $var->save();
            }
        }
        foreach ($listaEntrada as $a) {
            if ($a->estado == true) {
                $valor_a = $a->hora_asistencia;
                break;
            }
        }
        foreach ($listaSalida as $a) {
            if ($a->estado == true) {
                $valor_b = $a->hora_asistencia;
                break;
            }
        }
        return (strtotime($valor_b) - strtotime($valor_a));
    }

    private function conversorSegundosHoras($tiempo_en_segundos)
    {
        $horas = floor($tiempo_en_segundos / 3600);
        $minutos = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
        $segundos = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);

        return $horas . ':' . $minutos . ":" . $segundos;
    }

    public function actionregistroManual()
    {
        $this->menu = OptionsMenu::menuAsignacion([], ['asistencia', 'Registro Automatico']);
        $this->render('registroManual');
    }

    public function actionbusquedaCi()
    {
        $var = array();
        if (isset($_POST['numero'])) {
            $empleado = Persona::model()->findAll(array(
                'condition' => "num_doc='{$_POST['numero']}'",
            ));

            if ($empleado != array()) {

                if ($empleado[0]->empleado->asignacionValida[0] != null) {
                    $var[] = $empleado[0]->empleado->asignacionValida[0]->cargo->nombre_cargo;
                    $var[] = $empleado[0]->getNombreCompleto();
                    $var[] = $empleado[0]->empleado->asignacionValida[0]->id_asignacion;
                    $this->renderPartial('infoEmpleado', array('cargo' => $var));
                    return;
                }
            }
            $this->renderPartial('infoEmpleado', array('cargo' => $var));
            return;
        }
    }

    public function actionregistrarAsistencia()
    {
        $valor1 = $_POST['Registro']['id_asignacion'];
        $valor2 = $_POST['Registro']['fecha'];
        $valor3 = $_POST['Registro']['hora_asistencia'];
        $valor4 = $_POST['Registro']['observaciones'];
        $registro = new Registro();
        $registro->id_asignacion = $valor1;
        $registro->fecha = $valor2;
        $registro->hora_asistencia = $valor3;
        $registro->observaciones = $valor4;
        $registro->estado = false;
        $list = Registro::model()->findByPk(array('id_asignacion' => $registro->id_asignacion, 'fecha' => $registro->fecha, 'hora_asistencia' => $registro->hora_asistencia));
        if (!$list)
            $registro->save();
        $this->renderPartial('empleadoValido', array('empleado' => $registro));
    }

    public function actiondetalleAsistencia($fecha_ini, $fecha_fin, $empleado)
    {
        $asignacion = AsignacionEmpleado::model()->findAll(array(
            'condition' => "id_asignacion={$empleado} and fecha_fin is null",
        ));
        $dia_inicial = date('N', strtotime($fecha_ini)) - 1;
        $dia_final = 7 - date('N', strtotime($fecha_fin));
        $dia_lunes = strtotime("-" . $dia_inicial . " day", strtotime($fecha_ini));
        $dia_domingo = strtotime("+" . $dia_final . " day", strtotime($fecha_fin));
        $lunes = date('Y-m-d', $dia_lunes);
        $domingo = date('Y-m-d', $dia_domingo);
        $date1 = date_create($lunes);
        $date2 = date_create($domingo);
        $interval = date_diff($date1, $date2);
        $interval = $interval->format('%a');
        $this->render('detalleAsistencia', array(
            'asignacion' => $asignacion[0],
            'fecha_ini' => $lunes,
            'fecha_fin' => $domingo,
            'fecha_ini_start' => $lunes,
            'interval' => $interval,
            'fecha_ini_real' => $fecha_ini,
            'empleado' => $asignacion[0]->id_asignacion
        ));
    }
    public function actionCreatePdfAsistencia($data)
    {
        $lista = stripcslashes($data);
        $lista = urldecode($lista);
        $data = unserialize($lista);
        $header = array('unidad', 'Cargo de Enpleado', 'Nombre Empleado', 'Dias Trabajados. En dias', 'Horas Trabajadas. En (H:m:s)', 'Minutos de retraso. En minutos');
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
        $pdf->ColoredTableAsistencia($header, $data);
        // reset pointer to the last page
        $pdf->lastPage();
        //Close and output PDF documen
        $pdf->Output('filename.pdf', 'I');

    }

    public function actionCreatePdfDetalleAsistencia($fecha_ini, $interval, $fecha_in_real, $empleado)
    {
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
        $pdf->createTableDetalleAistencia($fecha_ini, $interval, $fecha_in_real, $empleado);
        $pdf->lastPage();
        //Close and output PDF document
        $pdf->Output('filename.pdf', 'I');
        Yii::app()->end();
    }

    public function actionCreatePdfDetalleAsistenciaGeneral($data)
    {
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
        $lista = stripcslashes($data);
        $lista = urldecode($lista);
        $data = unserialize($lista);
        $fecha_ini = $data[0][6];
        $fecha_fin = $data[0][7];
        $fecha_ini_real = $data[0][6];
        $dia_inicial = date('N', strtotime($fecha_ini)) - 1;
        $dia_final = 7 - date('N', strtotime($fecha_fin));
        $dia_lunes = strtotime("-" . $dia_inicial . " day", strtotime($fecha_ini));
        $dia_domingo = strtotime("+" . $dia_final . " day", strtotime($fecha_fin));
        $lunes = date('Y-m-d', $dia_lunes);
        $domingo = date('Y-m-d', $dia_domingo);
        $date1 = date_create($lunes);
        $date2 = date_create($domingo);
        $interval = date_diff($date1, $date2);
        $interval = $interval->format('%a');
        foreach ($data as $item) {
            $fecha_ini = $item[6];
            $asignacion = AsignacionEmpleado::model()->findByPk($item[8]);
            $pdf->SetFont('helvetica', '', 20);
            $pdf->Write(0, $item[1] . ' | ' . $asignacion->empleado->empleadoPersona->getNombreCompleto(), '', 0, 'L', true, 0, false, false, 0);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetFillColor(46, 139, 87);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetFont('');
            $pdf->Cell(30, 6, 'Tiqueos Validos', '', 0, 'C', 1);
            $pdf->SetFillColor(70, 130, 180);
            $pdf->SetTextColor(255, 255, 255);
            $pdf->SetFont('');
            $pdf->Cell(30, 6, 'Tiqueos Invalidos', '', 0, 'C', 1);
            $pdf->Ln(8);
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
                $pdf->SetTextColor(0, 0, 0);
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
                $pdf->writeHTML($tbl, true, false, false, false, '');
                $pdf->Ln();
            }
        }
        $pdf->lastPage();
        //Close and output PDF document
        $pdf->Output('filename.pdf', 'I');
        Yii::app()->end();
    }
}

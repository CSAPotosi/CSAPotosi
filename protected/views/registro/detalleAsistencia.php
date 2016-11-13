<?php
/* $this ServicioController */
$this->pageTitle = "Servicio <span> > Detalle de Asistencia</span>";
$this->breadcrumbs = array(
    'detalleAsistencia',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Deatlle de la Asistencia
                                de <?php echo $asignacion->empleado->empleadoPersona->getNombreCompleto() ?></legend>
                            <div class="row">

                            </div>
                            <div class="row">
                                <div class="col-md-10 col-lg-offset-1">
                                    <span class="label label-success" style='font-size: 15px'>Tiqueos Validos</span>&nbsp;&nbsp;<span
                                        class="label label-info" style='font-size: 15px'>Tiqueos Invalidos</span>
                                    <br><br>
                                    <?php
                                    $i = 0;
                                    while ($i <= $interval) {
                                        ?>
                                        <div class="row">
                                            <table class="table table-responsive table-bordered">
                                                <tr>
                                                    <th style="font-size:14px"
                                                        width="100px"><?php echo date('d-m-Y', strtotime($fecha_ini)) . " (Lun)" ?></th>
                                                    <th style="font-size:14px"
                                                        width="100px"><?php echo date('d-m-Y', strtotime('+1 day', strtotime($fecha_ini))) . " (Mar)" ?></th>
                                                    <th style="font-size:14px"
                                                        width="100px"><?php echo date('d-m-Y', strtotime('+2 day', strtotime($fecha_ini))) . " (Mie)" ?></th>
                                                    <th style="font-size:14px"
                                                        width="100px"><?php echo date('d-m-Y', strtotime('+3 day', strtotime($fecha_ini))) . " (Jue)" ?></th>
                                                    <th style="font-size:14px"
                                                        width="100px"><?php echo date('d-m-Y', strtotime('+4 day', strtotime($fecha_ini))) . " (Vie)" ?></th>
                                                    <th style="font-size:14px"
                                                        width="100px"><?php echo date('d-m-Y', strtotime('+5 day', strtotime($fecha_ini))) . " (Sab)" ?></th>
                                                    <th style="font-size:14px"
                                                        width="100px"><?php echo date('d-m-Y', strtotime('+6 day', strtotime($fecha_ini))) . " (Dom)" ?></th>

                                                </tr>
                                                <tr><?php for ($j = 0; $j <= 6; $j++) { ?>
                                                        <td align="center">
                                                            <?php if (strtotime($fecha_ini) >= strtotime($fecha_ini_real)) {
                                                                $registro = Registro::model()->findAll(array(
                                                                    'condition' => "id_asignacion={$asignacion->id_asignacion} and fecha='{$fecha_ini}' order by hora_asistencia",
                                                                ));
                                                                if ($registro != array())
                                                                    foreach ($registro as $item) {
                                                                        if ($item->estado == true)
                                                                            echo "<div style='padding-top: 11px'><span class='label label-success' style='font-size: 15px'>" . $item->hora_asistencia . "</span></div>";
                                                                        else
                                                                            echo "<div style='padding-top: 11px'><span class='label label-info' style='font-size: 15px'>" . $item->hora_asistencia . "</span></div>";
                                                                    }
                                                            } ?>
                                                        </td>
                                                        <?php
                                                        $fecha_ini = strtotime('+1 day', strtotime($fecha_ini));
                                                        $fecha_ini = date('Y-m-d', $fecha_ini);
                                                        $i++;
                                                    } ?>
                                                </tr>

                                            </table>
                                        </div>
                                        <?php


                                    } ?>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <?php echo CHtml::link("<i class=\"fa fa-file-pdf-o\"></i> Generar Reporte",
                                array('Registro/CreatePdfDetalleAsistencia',
                                    'fecha_ini' => $fecha_ini_start, 'interval' => $interval, 'fecha_in_real' => $fecha_ini_real, 'empleado' => $empleado),
                                array('target' => '_blank', 'class' => 'btn btn-primary')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
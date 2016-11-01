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
                                    <span class="label label-success">Tiqueos Validos</span>&nbsp;&nbsp;<span
                                        class="label label-info">Tiqueos Invalidos</span>
                                    <br><br>
                                    <?php
                                    $i = 0;
                                    while ($i <= $interval) {
                                        ?>
                                        <div class="row">
                                            <table class="table table-responsive table-bordered">
                                                <tr>
                                                    <th>Lunes</th>
                                                    <th>Martes</th>
                                                    <th>Miercoles</th>
                                                    <th>Jueves</th>
                                                    <th>Viernes</th>
                                                    <th>Sabado</th>
                                                    <th>Domingo</th>
                                                </tr>
                                                <tr><?php for ($j = 0; $j <= 6; $j++) { ?>
                                                        <td>
                                                            <?php
                                                            $registro = Registro::model()->findAll(array(
                                                                'condition' => "id_asignacion={$asignacion->id_asignacion} and fecha='{$fecha_ini}'",
                                                            ));
                                                            if ($registro != array())
                                                                foreach ($registro as $item) {
                                                                    if ($item->estado == true)
                                                                        echo "<span class='label label-success'>$item->fecha" . " | " . "$item->hora_asistencia</span>" . "<br>";
                                                                    else
                                                                        echo "<span class='label label-info'>$item->fecha" . " | " . "$item->hora_asistencia</span>" . "<br>";
                                                                }
                                                            ?>
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
                            <button type="submit" class="btn btn-primary"
                                    data-url="<?php echo CHtml::normalizeUrl(array('registro/registrarAsistencia')) ?>">
                                <i class="fa fa-save"></i> Generar Reporte
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
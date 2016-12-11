<?php
/* $this ServicioController */
$this->pageTitle = "Asignacion <span> > Asignacionn Empleado</span>";
$this->breadcrumbs = array(
    'Asignacion Empleado',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div class="widget-body">
                    <div class="widget-body-toolbar">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                <span class="input-group-addon"><i
                                        class="fa fa-search"></i></span>
                                    <input class="form-control" id="searchEmpleadoAsignado"
                                           placeholder="Empleado Asignado"
                                           type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <fieldset>
                        <legend>Lista de Asignaciones a Empleados</legend>
                        <div class="row">
                            <div class="col-md-8 col-lg-offset-2">
                                <table class="table table-responsive table-bordered">
                                    <tr>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Empleado</th>
                                        <th>Cargo Asignado</th>
                                        <th>Estado</th>
                                    </tr>
                                    <?php foreach ($listAsignacion as $item): ?>
                                        <tr class="val"
                                            data-nombre="<?php echo $item->empleado->empleadoPersona->getNombreCompleto() ?>">
                                            <td><?php echo $item->fecha_inicio ?></td>
                                            <td><?php echo ($item->fecha_fin == "") ? 'ACTIVO' : $item->fecha_fin ?></td>
                                            <td><?php echo $item->empleado->empleadoPersona->getNombreCompleto(); ?></td>
                                            <td><?php echo $item->cargo->nombre_cargo ?></td>
                                            <td class="text-align-right"><?php echo CHtml::link('<i class="fa fa-edit"></i> Editar', array('asignacionEmpleado/update', 'id' => $item->id_asignacion), array('class' => 'btn btn-primary btn-xs')); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                </div>

            </div>
        </article>
    </div>
</section>
<!--Start Scripts-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/asignacionEmpleado/index.js', CClientScript::POS_END); ?>
<!--End plugins-->
<!-- start plugins-->


<!--end plugins-->


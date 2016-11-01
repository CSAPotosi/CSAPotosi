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
                                        <tr>
                                            <td><?php echo $item->fecha_inicio ?></td>
                                            <td><?php echo ($item->fecha_fin == "") ? 'ACTIVO' : $item->fecha_fin ?></td>
                                            <td><?php echo $item->empleado->empleadoPersona->getNombreCompleto(); ?></td>
                                            <td><?php echo $item->cargo->nombre_cargo ?></td>
                                            <td class="text-align-right"><?php echo CHtml::link('Editar', array('asignacionEmpleado/update', 'id' => $item->id_asignacion), array('class' => 'btn btn-info')); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-actions">
                        <?php echo CHtml::link('Adicionar Asignacion', array('asignacionEmpleado/create'), array('class' => 'btn btn-info')); ?>
                    </div>
                </div>

            </div>
        </article>
    </div>
</section>
<!--Start Scripts-->

<!--End plugins-->
<!-- start plugins-->


<!--end plugins-->


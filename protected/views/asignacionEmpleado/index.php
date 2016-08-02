<?php
/* @var $this PacienteController */
$this->pageTitle = "Asignacion de Empleado <span> > Lista de Asignaciones de Cargo </span>";
$this->breadcrumbs = array(
    'AsignacionEmpleado',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <div class="row">
                            <article class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <caption class="text-align-center"><h5><b>Lista de Asignaciones de Cargo</b>
                                            </h5></caption>
                                        <tr>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Empleado</th>
                                            <th>Cargo Asignado</th>
                                            <th>Estado</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($listAsignacion as $item): ?>
                                            <tr>
                                                <td><?php echo $item->fecha_inicio ?></td>
                                                <td><?php echo $item->fecha_fin ?></td>
                                                <td></td>
                                                <td><?php echo $item->id_cargo ?></td>
                                                <td class="text-align-right"><?php echo CHtml::link('Editar', array('asignacionEmpleado/update', 'id' => $item->id_asignacion), array('class' => 'btn btn-info')); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="5"
                                                class="text-align-right"><?php echo CHtml::link('Adicionar Asignacion', array('asignacionEmpleado/create'), array('class' => 'btn btn-info')); ?></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
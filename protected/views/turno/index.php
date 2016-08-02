<?php
/* @var $this PacienteController */
$this->pageTitle = "Turno <span> > Lista de Turnos </span>";
$this->breadcrumbs = array(
    'Turno',
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
                            <article class="col-md-10">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <caption class="text-align-center"><h5>Lista de Turnos</h5></caption>
                                        <tr>
                                            <th>Nombre de Turno</th>
                                            <th>Hora de Entrada</th>
                                            <th>Inicio Entrada</th>
                                            <th>Fin Entrada</th>
                                            <th>Hora de Salida</th>
                                            <th>Inicio Salida</th>
                                            <th>Fin Entrada</th>
                                            <th>Tolerancia</th>
                                            <th>Tipo Turno</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($listTurno as $item): ?>
                                            <tr>
                                                <td><?php echo $item->nombre_turno; ?></td>
                                                <td><?php echo $item->hora_entrada; ?></td>
                                                <td><?php echo $item->inicio_entrada; ?></td>
                                                <td><?php echo $item->fin_entrada; ?></td>
                                                <td><?php echo $item->hora_salida; ?></td>
                                                <td><?php echo $item->inicio_salida; ?></td>
                                                <td><?php echo $item->fin_salida; ?></td>
                                                <td><?php echo $item->tolerancia; ?></td>
                                                <td><?php echo $item->tipo_turno; ?></td>
                                                <td class="text-align-right"><?php echo CHtml::link('Editar', array('turno/update', 'id' => $item->id_turno), array('class' => 'btn btn-info')); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="10"
                                                class="text-align-right"><?php echo CHtml::link('Adicionar Turno', array('turno/create'), array('class' => 'btn btn-info')); ?></td>
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
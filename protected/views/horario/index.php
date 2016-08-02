<?php
/* @var $this PacienteController */
$this->pageTitle = "Horario <span> > Lista de Horarios </span>";
$this->breadcrumbs = array(
    'Horario',
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
                                        <caption class="text-align-center"><h5>Lista de Horarios</h5></caption>
                                        <tr>
                                            <th>Nombre de Hoario</th>
                                            <th>Descripcion</th>
                                            <th>Ciclo en dias</th>
                                            <th>Cargo</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($listHorario as $item): ?>
                                            <tr>
                                                <td><?php echo $item->nombre_horario; ?></td>
                                                <td><?php echo $item->descripcion; ?></td>
                                                <td><?php echo $item->ciclo_total; ?></td>
                                                <td><?php echo $item->cargo; ?></td>
                                                <td class="text-align-right"><?php echo CHtml::link('Editar', array('horario/update', 'id' => $item->id_horario), array('class' => 'btn btn-info')); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="5"
                                                class="text-align-right"><?php echo CHtml::link('Adicionar Horario', array('horario/create'), array('class' => 'btn btn-info')); ?></td>
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
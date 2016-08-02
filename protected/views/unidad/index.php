<?php
/* @var $this PacienteController */
$this->pageTitle = "Unidad <span> > Lista </span>";
$this->breadcrumbs = array(
    'Unidad',
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
                                        <caption class="text-align-center"><h5><b>Lista de Unidades o
                                                    Departamentos<b></b></h5></caption>
                                        <tr>
                                            <th>Nombre de Unidad</th>
                                            <th>Descripcion</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($listUnidad as $item): ?>
                                            <tr>
                                                <td><?php echo $item->nombre_unidad; ?></td>
                                                <td><?php echo $item->descripcion_unidad; ?></td>
                                                <td class="text-align-center">
                                                    <?php echo CHtml::link('Editar', array('unidad/update', 'id' => $item->id_unidad), array('class' => 'btn btn-info')); ?>
                                                    <?php echo CHtml::link('Ver cargos', array('cargo/index', 'id' => $item->id_unidad), array('class' => 'btn btn-info')); ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="3"
                                                class="text-align-right"><?php echo CHtml::link('Adicionar Unidad', array('unidad/create'), array('class' => 'btn btn-info')); ?></td>
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
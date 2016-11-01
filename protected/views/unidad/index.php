<?php
/* $this ServicioController */
$this->pageTitle = "Unidad <span> > Lista de Unidades</span>";
$this->breadcrumbs = array(
    'Lista Unidades',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div class="widget-body">
                    <fieldset>
                        <legend>Lista De Unidades o departamentos</legend>
                        <div class="row">
                            <div class="col-md-6 col-lg-offset-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Nombre de Unidad</th>
                                            <th>Descripcion</th>
                                            <th>Acciones</th>
                                        </tr>
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
                                    </table>
                                    <div class="form-group">
                                        <?php echo CHtml::link('Adicionar Unidad', array('unidad/create'), array('class' => 'btn btn-info')); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </article>
    </div>
</section>
<!--Start Scripts-->

<!--End plugins-->
<!-- start plugins-->


<!--end plugins-->


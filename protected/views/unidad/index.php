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
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div class="widget-body">
                    <fieldset>
                        <legend>Lista De Unidades o departamentos</legend>
                        <div class="row">
                            <div class="col-md-6 col-lg-offset-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Nombre de Unidad</th>
                                            <th>Descripcion</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <?php foreach ($listUnidad as $item): ?>
                                            <tr>
                                                <td><?php echo $item->nombre_unidad; ?></td>
                                                <td><?php echo $item->descripcion_unidad; ?></td>
                                                <td class="text-align-center">
                                                    <?php echo CHtml::link('<i class="fa fa-edit"></i> Editar&nbsp;&nbsp;', array('unidad/update', 'id' => $item->id_unidad), array('class' => 'btn btn-primary btn-xs')); ?>
                                                    <?php echo CHtml::link('<i class="fa fa-eye"></i> Cargos', array('cargo/index', 'id' => $item->id_unidad), array('class' => 'btn btn-primary btn-xs')); ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
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


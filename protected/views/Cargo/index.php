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
                        <legend>Lista de cargos de <?php echo $modelUnidad->nombre_unidad ?></legend>
                        <div class="row">
                            <div class="col-md-6 col-lg-offset-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Nombre de Cargo</th>
                                            <th>Descripcion</th>
                                            <th>Horario</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <?php foreach ($listCargo as $item): ?>
                                            <tr>
                                                <td><?php echo $item->nombre_cargo; ?></td>
                                                <td><?php echo $item->descripcion_cargo; ?></td>
                                                <td><?php echo $item->horario->nombre_horario ?></td>
                                                <td class="text-align-right"><?php echo CHtml::link('<i class="fa fa-edit"></i> Editar', array('cargo/update', 'id' => $item->id_cargo), array('class' => 'btn btn-primary btn-xs')); ?></td>
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


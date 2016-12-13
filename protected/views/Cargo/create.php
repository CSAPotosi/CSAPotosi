<?php
/* $this ServicioController */
$this->pageTitle = "Cargo <span> > Crear Cargo</span>";
$this->breadcrumbs = array(
    'Cargo',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div class="widget-body">
                    <fieldset>
                        <legend>Crear Cargo en <?php echo $modelUnidad->nombre_unidad ?></legend>
                        <div class="row">
                            <div class="col-md-6 col-lg-offset-3">
                                <?php $this->renderPartial("_form", array('modelCargo' => $modelCargo, 'id' => $id)) ?>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-actions">
                        <?php echo CHtml::submitButton($modelCargo->isNewRecord ? "Guardar Cargo" : 'Actualizar Cargo', array('class' => 'btn btn-primary')); ?>
                    </div>
                    <?php echo CHtml::endForm(); ?>
                </div>
            </div>
        </article>
    </div>
</section>

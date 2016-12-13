<?php
/* @var $this PacienteController */
$this->pageTitle = "Unidad <span> > Actualizar Unidad </span>";
$this->breadcrumbs = array(
    'Unidad',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div class="widget-body">
                    <fieldset>
                        <legend>Actualizar Unidad</legend>
                        <div class="row">
                            <div class="col-md-6 col-lg-offset-3">
                                <?php $this->renderPartial("_form", array('modelUnidad' => $modelUnidad)) ?>
                            </div>
                    </fieldset>
                    <div class="form-actions">
                        <?php echo CHtml::submitButton($modelUnidad->isNewRecord ? 'Guardar Unidad' : 'Actualizar Unidad', array('class' => 'btn btn-primary')); ?>
                    </div>
                </div>
                <?php echo CHtml::endForm(); ?>
            </div>
        </article>
    </div>
</section>
<?php
/* @var $this PacienteController */
$this->pageTitle = "UNIDAD</span>";
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
                        <legend>ACTUALIZAR UNIDAD</legend>
                        <div class="row">
                            <div class="col-md-6 col-lg-offset-3">
                                <?php $this->renderPartial("_form", array('modelUnidad' => $modelUnidad)) ?>
                            </div>
                    </fieldset>
                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </div>
                <?php echo CHtml::endForm(); ?>
            </div>
        </article>
    </div>
</section>
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
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <div class="row">
                            <article class="col-md-6">
                                <center><h5>Actualizar Unidades</h5></center>
                                <br>
                                <div class="well no-padding">
                                    <?php $this->renderPartial("_form", array('modelUnidad' => $modelUnidad)) ?>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
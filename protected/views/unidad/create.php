<?php
/* $this ServicioController */
$this->pageTitle = "Unidad <span> > Crear Unidades</span>";
$this->breadcrumbs = array(
    'Crear Unidades ',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div class="widget-body">
                    <fieldset>
                        <legend>Registro de Unidad</legend>
                        <div class="row">
                            <div class="col-md-6 col-lg-offset-3">
                                <?php $this->renderPartial("_form", array('modelUnidad' => $modelUnidad)) ?>
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


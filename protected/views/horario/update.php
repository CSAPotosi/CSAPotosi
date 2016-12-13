<?php
/* @var $this PacienteController */
$this->pageTitle = "Horario <span> > Actualizar Horario </span>";
$this->breadcrumbs = array(
    'Horario',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <div class="row">
                            <article class="col-md-6">
                                <center><h5>Actualizar Horario</h5></center>
                                <br>
                                <div class="well no-padding">
                                    <?php $this->renderPartial("_form", array('modelHorario' => $modelHorario)) ?>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
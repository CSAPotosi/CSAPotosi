<?php
/* @var $this PacienteController */
$this->pageTitle = "Turno <span> > Crear Turno </span>";
$this->breadcrumbs = array(
    'Turno',
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
                                <center><h5>Registro de Turno</h5></center>
                                <br>
                                <div class="well no-padding">
                                    <?php $this->renderPartial("_form", array('modelTurno' => $modelTurno)) ?>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
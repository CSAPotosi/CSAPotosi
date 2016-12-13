<?php
/* @var $this PacienteController */
$this->pageTitle = "Horario <span> > Crear Horario </span>";
$this->breadcrumbs = array(
    'Cargo',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <?php $this->renderPartial("_form", array('modelHorario' => $modelHorario)) ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
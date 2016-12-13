<?php
/* @var $this PacienteController */
$this->pageTitle = "Asignacion Empleado <span> > Asignacion de Empleado </span>";
$this->breadcrumbs = array(
    'Asignacion de Empleado',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div class="widget-body">
                    <fieldset>
                        <legend>Crear Asignacion</legend>
                        <div class="row">
                            <div class="col-md-6 col-lg-offset-3">
                                <?php $this->renderPartial("_form", array('modelAsignacionEmpleado' => $modelAsignacionEmpleado)) ?>
                            </div>
                        </div>
                    </fieldset>

                </div>

            </div>
        </article>
    </div>
</section>
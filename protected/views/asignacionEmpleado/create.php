<?php
/* @var $this PacienteController */
$this->pageTitle = "Asignacion Empleado <span> > Asoignacion de Empleado </span>";
$this->breadcrumbs = array(
    'Asignacion de Empleado',
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
                                <center><h5><b>Asignacion de Empleado a Cargo</b></h5></center>
                                <br>
                                <div class="well no-padding">
                                    <?php $this->renderPartial("_form", array('modelAsignacionEmpleado' => $modelAsignacionEmpleado)) ?>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
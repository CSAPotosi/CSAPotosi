<?php
/* @var $this PacienteController */
$this->pageTitle = "Unidad <span> > Crear Cargo </span>";
$this->breadcrumbs = array(
    'Cargo',
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
                                <center><h5><b>Registro de Cargo para <?php echo $modelUnidad->nombre_unidad ?></b></h5>
                                </center>
                                <br>
                                <div class="well no-padding">
                                    <?php $this->renderPartial("_form", array('modelCargo' => $modelCargo, 'id' => $id)) ?>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
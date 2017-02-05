<?php
    $this->pageTitle = 'INTERNACION - <small>DETALLE</small>';
?>
<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$internacionModel->historial]);?>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                    <ul id="widget-tab-options" class="nav nav-tabs pull-right">
                        <li class="active">
                            <a data-toggle="tab" href="#hr1"> <i class="fa fa-lg fa-arrow-circle-o-down"></i> <span class="hidden-mobile hidden-tablet"> Indice 1 </span> </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#hr2"> <i class="fa fa-lg fa-arrow-circle-o-up"></i> <span class="hidden-mobile hidden-tablet"> Indice 2 </span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#hr3"> <i class="fa fa-lg fa-arrow-circle-o-up"></i> <span class="hidden-mobile hidden-tablet"> Salas </span></a>
                        </li>
                    </ul>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <div class="tab-content padding-10">
                            <div class="tab-pane fade in active" id="hr1">
                                contenido en 1
                            </div>
                            <div class="tab-pane fade" id="hr2">
                                contenido en 2
                            </div>
                            <div class="tab-pane fade" id="hr3">
                                <?php $this->renderPartial('_salaTable',['salas'=>$internacionModel->salas]);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
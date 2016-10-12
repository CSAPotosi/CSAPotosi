<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$dModel->historial]);?>

<section id="widget-grid">
    <div class="row">
        <div class="col-md-12">
            <div class="jarviswidget" id="widget-historial">
                <header>
                    <ul class="nav nav-tabs pull-right in" id="tab-historial">
                        <li class="active">
                            <a data-toggle="tab" href="#s1"><i class="fa fa-clock-o"></i> <span
                                    class="hidden-mobile hidden-tablet">Detalle</span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#s2"><i class="fa fa-stethoscope"></i> <span
                                    class="hidden-mobile hidden-tablet">Tratamientos</span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#s3"><span
                                    class="hidden-mobile hidden-tablet">Evolucion</span></a>
                        </li>
                    </ul>
                </header>

                <div>
                    <div class="widget-body no-padding">
                        <div id="historial-tab-content" class="tab-content padding-10">
                            <div class="tab-pane active" id="s1">
                                <?php $this->renderPartial('_detailDiagnostico');?>
                            </div>

                            <div class="tab-pane" id="s2">
                                hola
                            </div>

                            <div class="tab-pane" id="s3">
                                hola
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->pageTitle = 'DIAGNOSTICO - <small>DETALLE</small>'?>
<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$dModel->historial]);?>
<section id="widget-grid">
    <div class="row">
        <div class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget-historial">
                <header>
                    <ul class="nav nav-tabs pull-right in" id="tab-historial">
                        <li class="active">
                            <a data-toggle="tab" href="#s1"><span
                                    class="hidden-mobile hidden-tablet">Detalle</span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#s2"><span
                                    class="hidden-mobile hidden-tablet">Evolucion</span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#s3"><span
                                    class="hidden-mobile hidden-tablet">Tratamientos</span></a>
                        </li>
                    </ul>
                </header>

                <div>
                    <div class="widget-body no-padding">
                        <div id="historial-tab-content" class="tab-content padding-10">
                            <div class="tab-pane active" id="s1">
                                <?php $this->renderPartial('_detailDiagnostico',['dModel' => $dModel]);?>
                            </div>
        
                            <div class="tab-pane" id="s2">
                                <?php $this->renderPartial('/evolucion/_tableEvolucion',['evoList'=>$dModel->evoluciones]);?>
                            </div>

                            <div class="tab-pane" id="s3">
                                <?php $this->renderPartial('/tratamiento/_tableTratamiento',['tList'=>$dModel->tratamientos]);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
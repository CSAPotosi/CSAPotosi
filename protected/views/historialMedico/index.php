<?php
$this->pageTitle = "HISTORIAL MEDICO - <small>DETALLE</small>";
?>

<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$historialModel]);?>
<section id="widget-grid">
    <div class="row">
        <div class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget-historial">
                <header>
                    <ul class="nav nav-tabs pull-right in" id="tab-historial">
                        <li class="active">
                            <a data-toggle="tab" href="#s2"><span class="hidden-mobile hidden-tablet">DIAGNOSTICOS</span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#s3"><span
                                    class="hidden-mobile hidden-tablet">INTERNACIONES</span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#s4"><span
                                    class="hidden-mobile hidden-tablet">EXAMENES</span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#s5"><span
                                    class="hidden-mobile hidden-tablet">CIRUGIAS</span></a>
                        </li>
                    </ul>
                </header>

                <div>
                    <div class="widget-body no-padding">
                        <div id="historial-tab-content" class="tab-content padding-10">
                            <div class="tab-pane active" id="s2">
                                <?php $this->renderPartial('_diagnosticoTable',['dList'=>$historialModel->diagnosticos]);?>
                            </div>

                            <div class="tab-pane" id="s3">
                                <?php $this->renderPartial('_internacionTable',['iList'=>$historialModel->internaciones, 'currentIModel'=>$historialModel->internacionActual]);?>
                            </div>

                            <div class="tab-pane" id="s4">
                                examenes
                            </div>

                            <div class="tab-pane" id="s5">
                                cirugias
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
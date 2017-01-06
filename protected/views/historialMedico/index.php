<?php
$this->pageTitle = "Historial Medico";
?>

<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$historialModel]);?>
<section id="widget-grid">
    <div class="row">
        <div class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget-historial">
                <header>
                    <ul class="nav nav-tabs pull-right in" id="tab-historial">
                        <li class="active">
                            <a data-toggle="tab" href="#s1"><i class="fa fa-clock-o"></i> <span
                                    class="hidden-mobile hidden-tablet">Live Stats</span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#s2"><i class="fa fa-stethoscope"></i> <span
                                    class="hidden-mobile hidden-tablet">Diagnosticos</span></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#s3"><span
                                    class="hidden-mobile hidden-tablet">Internaciones</span></a>
                        </li>
                    </ul>
                </header>

                <div>
                    <div class="widget-body no-padding">
                        <div id="historial-tab-content" class="tab-content padding-10">
                            <div class="tab-pane active" id="s1">
                                <?php echo $historialModel->paciente->persona->nombres;?>
                            </div>

                            <div class="tab-pane" id="s2">
                                <?php $this->renderPartial('_diagnosticoTable',['dList'=>$historialModel->diagnosticos]);?>
                            </div>

                            <div class="tab-pane" id="s3">
                                <?php $this->renderPartial('_internacionTable',['iList'=>$historialModel->internaciones, 'currentIModel'=>$historialModel->internacionActual]);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
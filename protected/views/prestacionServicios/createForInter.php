<?php $this->pageTitle = 'INTERNACION - <small>OTORGAR SERVICIO</small>'?>
<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$iModel->historial]);?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>PRESTACION DE SERVICIOS (INTERNACION)</legend>
                            <div class="row">
                                <div class="col-md-7">
                                    <?php $this->renderPartial('_servicioList');?>
                                </div>
                                <div class="col-md-5">
                                    <?php $this->renderPartial('_prestacionForm');?>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/prestacionServicios/createForInter.js',CClientScript::POS_END);
?>
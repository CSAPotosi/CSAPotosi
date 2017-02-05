<?php $this->pageTitle = 'INTERNACION - <small>NOTAS DE ENFERMERIA</small>';?>
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
                            <legend>NOTAS DE ENFERMERIA</legend>
                            <div class="margin-bottom-10 text-align-right<?php echo ($neModel->hasErrors())?' hidden':'';?>" id="add-nota">
                                <button class="btn btn-primary" id="show-form">
                                    <i class="fa fa-plus"></i>
                                    Nuevo
                                </button>
                            </div>
                            <div class="margin-bottom-10<?php echo ($neModel->hasErrors())?'':' hidden';?>" id="new-nota">
                                <?php echo CHtml::errorSummary($neModel,'<h4 class="alert-heading"><i class="fa fa-warning"></i> Debe corregir los siguientes errores:</h4>',null,['class'=>'alert alert-danger error-message']);?>
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <?php $this->renderPartial('_formNota',['iModel'=>$iModel,'neModel'=>$neModel]);?>
                                    </div>
                                </div>
                            </div>

                            <?php $this->renderPartial('_tableNotas',['notasList'=>$iModel->notasEnfermeria]);?>
                        </fieldset>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/notaEnfermeria/index.js', CClientScript::POS_END); ?>
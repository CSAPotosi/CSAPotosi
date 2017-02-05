<?php
$this->pageTitle = 'INTERNACION - <small>ALTA</small>';
?>

<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$internacionModel->historial]);?>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <?php echo CHtml::beginForm();?>
                        <fieldset>
                            <legend>ALTA DE PACIENTE</legend>
                            <?php echo CHtml::errorSummary($internacionModel,'<h4 class="alert-heading"><i class="fa fa-warning"></i> Debe corregir los siguientes errores:</h4>',null,['class'=>'alert alert-danger error-message']);?>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($internacionModel, 'fecha_alta');?>
                                        <div class="input-group date" id="fecha-alta">
                                            <?php echo CHtml::activeTextField($internacionModel, 'fecha_alta', ['class'=>'form-control', 'data-mask'=>'99/99/9999 99:99', 'data-mask-placeholder'=>'-']);?>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        <?php echo CHtml::error($internacionModel,'fecha_alta',['class'=>'label label-danger error-message']);?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($internacionModel, 'tipo_alta');?>
                                        <?php echo CHtml::activeTextField($internacionModel, 'tipo_alta', ['class'=>'form-control']);?>
                                        <?php echo CHtml::error($internacionModel,'tipo_alta',['class'=>'label label-danger error-message']);?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($internacionModel, 'observacion_alta');?>
                                        <?php echo CHtml::activeTextArea($internacionModel, 'observacion_alta', ['class'=>'form-control']);?>
                                        <?php echo CHtml::error($internacionModel,'observacion_alta',['class'=>'label label-danger error-message']);?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
                        </div>
                        <?php echo CHtml::endForm();?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/masked-input/jquery.maskedinput.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/moment/moment-with-locales.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',CClientScript::POS_END)
    ->registerCssFile(Yii::app()->baseUrl.'/resources/js/plugin/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/internacion/alta.js',CClientScript::POS_END);
?>

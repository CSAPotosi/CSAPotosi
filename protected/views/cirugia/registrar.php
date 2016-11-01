<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <?php echo CHtml::beginForm();?>
                        <fieldset>
                            <legend>
                                Registro de cirugia
                            </legend>
                            <?php echo CHtml::errorSummary($cirugia);?>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($cirugia,'fec_inicio');?>
                                        <div class="input-group date" id="fecha-inicio">
                                            <?php echo CHtml::activeTextField($cirugia,'fec_inicio',['class'=>'form-control']);?>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        <?php echo CHtml::error($cirugia,'fec_inicio',['class'=>'label label-danger']);?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($cirugia,'fec_fin');?>
                                        <div class="input-group date" id="fecha-fin">
                                            <?php echo CHtml::activeTextField($cirugia,'fec_fin',['class'=>'form-control']);?>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        <?php echo CHtml::error($cirugia,'fec_fin',['class'=>'label label-danger']);?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($cirugia,'naturaleza');?>
                                        <?php echo CHtml::activeTextArea($cirugia,'naturaleza',['class'=>'form-control']);?>
                                        <?php echo CHtml::error($cirugia,'naturaleza',['class'=>'label label-danger']);?>
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
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/cirugia/common.js',CClientScript::POS_END);
?>

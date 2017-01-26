<?php
    $modelTSala = ServTipoSala::model()->with([
        'servicio'=>['condition'=>'activo AND tipo_cobro = 1']
    ])->findAll();

    $this->pageTitle = 'CIRUGIAS';
?>
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
                            <legend>
                                PROGRAMACION DE CIRUGIA
                            </legend>
                            <?php echo CHtml::errorSummary($cirugia,'<h4 class="alert-heading"><i class="fa fa-warning"></i> Debe corregir los siguientes errores:</h4>',null,['class'=>'alert alert-danger error-message']);?>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="form-group">
                                        <?php
                                        $text = $cirugia->id_historial? $cirugia->historial->paciente->persona->nombreCompleto." ( {$cirugia->historial->paciente->persona->num_doc} )" :'';
                                        ?>
                                        <?php echo CHtml::  activeLabelEx($cirugia,'id_historial');?>
                                        <div class="input-group">
                                            <input type="text" id="paciente" class="form-control" value="<?php echo $text;?>" placeholder="Seleccione un paciente" disabled>
                                            <?php echo CHtml::activeHiddenField($cirugia,'id_historial');?>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-paciente">
                                                    <i class="fa fa-search"></i> Buscar
                                                </button>
                                            </div>
                                        </div>
                                        <?php echo CHtml::error($cirugia,'id_historial',['class'=>'label label-danger error-message']);?>
                                    </div>


                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($cirugia,'fec_reserva');?>
                                        <div class="input-group date" id="fecha-reserva">
                                            <?php echo CHtml::activeTextField($cirugia,'fec_reserva',['class'=>'form-control', 'value'=>$cirugia->fec_reserva?date('d/m/Y H:i',strtotime($cirugia->fec_reserva)):'' ]);?>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                        <?php echo CHtml::error($cirugia,'fec_reserva',['class'=>'label label-danger error-message']);?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($cirugia,'tiempo_estimado');?>
                                        <?php echo CHtml::activeTextField($cirugia,'tiempo_estimado',['class'=>'form-control']);?>
                                        <?php echo CHtml::error($cirugia,'tiempo_estimado',['class'=>'label label-danger error-message']);?>
                                    </div>

                                    <div class="form-group">
                                        <?php
                                            $text = $cirugia->id_sala? $cirugia->sala->cod_sala." ( {$cirugia->sala->tSala->servicio->nombre_serv} )" :'';
                                        ?>
                                        <?php echo CHtml::  activeLabelEx($cirugia,'id_sala');?>
                                        <div class="input-group">
                                            <input type="text" id="quirofano" class="form-control" value="<?php echo $text;?>" placeholder="Seleccione un quirofano" disabled>
                                            <?php echo CHtml::activeHiddenField($cirugia,'id_sala');?>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-quirofano">
                                                    <i class="fa fa-search"></i> Buscar
                                                </button>
                                            </div>
                                        </div>
                                        <?php echo CHtml::error($cirugia,'id_sala',['class'=>'label label-danger error-message']);?>
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

<div class="modal fade modal-primary" id="modal-quirofano" data-url="<?php echo CHtml::normalizeUrl(['Servicio/getSalasAjax'])?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="modal-title">Seleccione quirofano</h4>
                    </div>
                    <div class="col-md-6">
                        <?php echo CHtml::dropDownList('tSala',null,CHtml::listData($modelTSala,'id_serv','servicio.nombre_serv'),['class'=>'input-sm form-control pull-left'])?>
                    </div>
                </div>
            </div>
            <div class="modal-body no-padding">
                <div class="well no-margin">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-primary" id="modal-paciente" data-url="<?php echo CHtml::normalizeUrl(['paciente/getMinimalListAjax']);?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="modal-title">Seleccione paciente</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="input-sm form-control pull-left" placeholder="Buscar paciente">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body no-padding">
                <div class="well no-margin">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/masked-input/jquery.maskedinput.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/moment/moment-with-locales.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',CClientScript::POS_END)
    ->registerCssFile(Yii::app()->baseUrl.'/resources/js/plugin/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/bootstrap-touchspin/jquery.bootstrap-touchspin.js',CClientScript::POS_END)
    ->registerCssFile(Yii::app()->baseUrl.'/resources/js/plugin/bootstrap-touchspin/jquery.bootstrap-touchspin.css')
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/cirugia/common.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/cirugia/programar.js',CClientScript::POS_END);
?>

<?php
$modelTSala = ServTipoSala::model()->with([
    'servicio'=>['condition'=>'activo AND tipo_cobro = 1']
])->findAll();
?>
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
                                Datos de cirugia
                            </legend>
                            <?php echo CHtml::errorSummary(array_merge([$cirugia],$persList),'<h4 class="alert-heading"><i class="fa fa-warning"></i> Debe corregir los siguientes errores:</h4>',null,['class'=>'alert alert-danger']);?>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <?php if ($cirugia->isNewRecord):?>
                                        <div class="form-group">
                                            <?php
                                            $text = $cirugia->id_historial? $cirugia->historial->paciente->persona->nombres." ( {$cirugia->historial->paciente->persona->num_doc} )" :'';
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
                                            <?php echo CHtml::error($cirugia,'id_historial',['class'=>'label label-danger']);?>
                                        </div>
                                    <?php endif;?>

                                    <div class="form-group">
                                        <?php
                                        $text = $cirugia->id_sala? $cirugia->sala->cod_sala." ( {$cirugia->sala->tSala->servicio->nombre_serv} )" :'';
                                        ?>
                                        <?php echo CHtml::activeLabelEx($cirugia,'id_sala');?>
                                        <div class="input-group">
                                            <input type="text" id="quirofano" class="form-control" value="<?php echo $text;?>" placeholder="Seleccione un quirofano" disabled>
                                            <?php echo CHtml::activeHiddenField($cirugia,'id_sala');?>
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-quirofano">
                                                    <i class="fa fa-search"></i> Buscar
                                                </button>
                                            </div>
                                        </div>
                                        <?php echo CHtml::error($cirugia,'id_sala',['class'=>'label label-danger']);?>
                                    </div>

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

                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($cirugia,'detalle_instrumental');?>
                                        <?php echo CHtml::activeTextArea($cirugia,'detalle_instrumental',['class'=>'form-control']);?>
                                        <?php echo CHtml::error($cirugia,'detalle_instrumental',['class'=>'label label-danger']);?>
                                    </div>
                                </div>
                            </div>
                            <?php $this->renderPartial('_personalForm',['persList'=>$persList]);?>
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
<div id="template" style="display: none">
    <div class="row margin-bottom-5">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar medico/enfermera" disabled>
                <?php echo CHtml::activeHiddenField(new PersonalCirugia(),'[]id_per');?>
                <div class="input-group-btn">
                    <button type="button" class="btn btn-primary btn-select-p" data-toggle="modal" data-target="#modal-personal"><i class="fa fa-search"></i> Buscar</button>
                </div>
            </div>
            <?php echo CHtml::error(new PersonalCirugia(),"[]id_per",['class'=>'label label-danger']);?>
        </div>
        <div class="col-md-4">
            <?php echo CHtml::activeDropDownList(new PersonalCirugia(),'[]rol_cirugia',PersonalCirugia::getRolPersonal(),['class'=>'form-control']);?>
        </div>
        <div class="col-md-1">
            <div class="radio">
                <label class="radio-label">
                    <?php echo CHtml::activeRadioButton(new PersonalCirugia(),'[]responsable',['class'=>'responsable radiobox style-0']);?>
                    <span></span>
                </label>
            </div>
        </div>
        <div class="col-md-1">
            <button type="button" class="btn btn-danger remove-p"><i class="fa fa-minus"></i></button>
        </div>
    </div>
</div>
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
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/iCheck/icheck.min.js',CClientScript::POS_END)
    ->registerCssFile(Yii::app()->baseUrl.'/resources/js/plugin/iCheck/square/_all.css',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/cirugia/common.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/cirugia/registrar.js',CClientScript::POS_END);
?>

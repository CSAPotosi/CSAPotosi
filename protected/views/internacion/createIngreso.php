<?php
    $this->pageTitle = 'HISTORIAL MEDICO - <small>INTERNAR PACIENTE</small>';
    $modelTSala = ServTipoSala::model()->with([
        'servicio'=>['condition'=>'activo AND tipo_cobro = 2']
    ])->findAll();
?>

<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$historialModel]);?>
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
                            <legend>INTERNACION DE PACIENTE</legend>
                            <?php echo CHtml::errorSummary($internacionModel,'<h4 class="alert-heading"><i class="fa fa-warning"></i> Debe corregir los siguientes errores:</h4>',null,['class'=>'alert alert-danger error-message']);?>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="small-box bg-primary" id="selected-sala">
                                                <div class="inner text-align-center">
                                                    <h3><i class="fa fa-bed"></i></h3>
                                                    <p>Ninguno</p>
                                                </div>
                                                <a href="#" id="btn-select-sala" class="small-box-footer" data-toggle="modal" data-target="#modal-sala">
                                                    Elegir sala
                                                </a>
                                                <div class="input-inter-sala">
                                                    <?php echo CHtml::activeHiddenField(new InternacionSala(),'id_sala',['value'=>0]);?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <?php echo CHtml::activeLabelEx($internacionModel,'fecha_ingreso');?>
                                                <?php echo CHtml::activeTextField($internacionModel,'fecha_ingreso',['class'=>'form-control']);?>
                                                <?php echo CHtml::error($internacionModel,'fecha_ingreso',['class'=>'label label-danger error-message']);?>
                                            </div>
                                            <div class="form-group">
                                                <?php echo CHtml::activeLabelEx($internacionModel,'motivo_ingreso');?><br>
                                                <?php echo CHtml::activeRadioButtonList($internacionModel,'motivo_ingreso',Internacion::getMotivo(),['class'=>'icheck-radio','separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;']);?>
                                                <?php echo CHtml::error($internacionModel,'motivo_ingreso',['class'=>'label label-danger error-message']);?>
                                            </div>
                                            <div class="form-group">
                                                <?php echo CHtml::activeLabelEx($internacionModel,'procedencia_ingreso');?><br>
                                                <?php echo CHtml::activeRadioButtonList($internacionModel,'procedencia_ingreso',Internacion::getProcedencia(),['class'=>'icheck-radio','separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;']);?>
                                                <?php echo CHtml::error($internacionModel,'procedencia_ingreso',['class'=>'label label-danger error-message']);?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($internacionModel,'observacion_ingreso');?>
                                        <?php echo CHtml::activeTextArea($internacionModel,'observacion_ingreso',['class'=>'form-control']);?>
                                        <?php echo CHtml::error($internacionModel,'observacion_ingreso',['class'=>'label label-danger error-message']);?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Guardar
                            </button>
                        </div>
                        <?php echo CHtml::endForm();?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<div class="modal fade modal-primary" id="modal-sala" data-url="<?php echo CHtml::normalizeUrl(['Servicio/getSalasAjax'])?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="modal-title">Seleccione sala</h4>
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

<?php
    Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/iCheck/icheck.min.js',CClientScript::POS_END)
    ->registerCssFile(Yii::app()->baseUrl.'/resources/js/plugin/iCheck/all.css')
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/internacion/createIngreso.js',CClientScript::POS_END);
?>
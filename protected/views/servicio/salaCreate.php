<?php
    $this->pageTitle = 'Nuevo tipo de sala';
?>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <?php echo CHtml::beginForm();?>
                        <fieldset>
                            <legend>
                                Formulario tipo sala
                            </legend>
                            <?php echo CHtml::errorSummary($tSala,'<h4 class="alert-heading"><i class="fa fa-warning"></i> Debe corregir los siguientes errores:</h4>',null,['class'=>'alert alert-danger']);?>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($tSala,'nombre_serv');?>
                                        <?php echo CHtml::activeTextField($tSala, 'nombre_serv',['class'=>'form-control']);?>
                                        <?php echo CHtml::error($tSala, 'nombre_serv',['class'=>'label label-danger']);?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($tSala,'activo');?>
                                        <span class="onoffswitch pull-right">
                                            <?php echo CHtml::activeCheckBox($tSala,'activo',['class'=>'onoffswitch-checkbox']);?>
                                            <?php echo CHtml::activeLabel($tSala,'activo',['class'=>'onoffswitch-label','label'=>'<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span><span class="onoffswitch-switch"></span>']);?>
                                        </span>
                                        <?php echo CHtml::error($tSala, 'activo',['class'=>'label label-danger']);?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($tSala,'id_entidad');?>
                                        <?php echo CHtml::activeDropDownList($tSala,'id_entidad',CHtml::listData(Entidad::model()->findAll(),'id_entidad','razon_social'),['class'=>'form-control'] )?>
                                        <?php echo CHtml::error($tSala, 'id_entidad',['class'=>'label label-danger']);?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($tSala,'monto');?>
                                        <div class="input-group">
                                            <span class="input-group-addon">Bs.</span>
                                            <?php echo CHtml::activeTextField($tSala, 'monto',['class'=>'form-control']);?>
                                        </div>
                                        <?php echo CHtml::error($tSala, 'monto',['class'=>'label label-danger']);?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo CHtml::label('TIPO DE SALA',null);?>
                                        <?php echo CHtml::activeDropDownList($tSala,'tipo_cobro',['2'=>'INTERNACION','1'=>'QUIROFANO'],['class'=>'form-control'] )?>
                                        <?php echo CHtml::error($tSala, 'tipo_cobro',['class'=>'label label-danger']);?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($tSala,'descripcion_t_sala');?>
                                        <?php echo CHtml::activeTextArea($tSala, 'descripcion_t_sala',['class'=>'form-control']);?>
                                        <?php echo CHtml::error($tSala, 'descripcion_t_sala',['class'=>'label label-danger']);?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                Guardar
                            </button>
                        </div>
                        <?php echo CHtml::endForm();?>
                    </div>
                </div>
            </div>
         </article>
    </div>
</section>
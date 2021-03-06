<?php
/* @var $this UsuarioController */

$this->pageTitle = "Actualizar <span> > Servicio </span>";
$this->breadcrumbs = array(
    'Update',
);
?>
    <section id="widget-grid">
        <div class="row">
            <article class="col-md-12">
                <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                    <header></header>
                    <div>
                        <div class="widget-body">
                            <?php echo CHtml::beginForm(); ?>
                            <fieldset>
                                <legend>Crear Servicio Clinico</legend>
                                <?php echo CHtml::errorSummary($servicio, '<h4 class="alert-heading"><i class="fa fa-warning"></i> DEBE CORREGIR LOS SIGUIENTES ERRORES </h4>', null, array('class' => 'alert alert-danger error-message')); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabelEx($servicio, 'cod_serv'); ?>
                                            <?php echo CHtml::activeTextField($servicio, 'cod_serv', array('class' => 'form-control', 'placeholder' => 'Codigo Servicio')); ?>
                                            <?php echo CHtml::error($servicio, 'cod_serv', array('class' => 'label label-danger error-message')); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabel($servicio, 'nombre_serv'); ?>
                                            <?php echo CHtml::activeTextField($servicio, 'nombre_serv', array('class' => 'form-control', 'placeholder' => 'Nombre Servicio')); ?>
                                            <?php echo CHtml::error($servicio, 'nombre_serv', array('class' => 'label label-danger error-message')); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabel($servicio, 'tipo_cobro'); ?>
                                            <?php echo CHtml::activeDropDownList($servicio, 'tipo_cobro', array('1' => 'POR UNIDAD', '2' => 'POR DIA'), array('class' => 'form-control', 'placeholder' => 'Tipo de Cobro')); ?>
                                            <?php echo CHtml::error($servicio, 'tipo_cobro', array('class' => 'label label-danger error-message')); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabel($servicio, 'unidad_medida'); ?>
                                            <?php echo CHtml::activeTextField($servicio, 'unidad_medida', array('class' => 'form-control', 'placeholder' => 'Unidad de Medida')); ?>
                                            <?php echo CHtml::error($servicio, 'unidad_medida', array('class' => 'label label-danger error-message')); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabel($servicio, 'monto'); ?>
                                            <?php echo CHtml::activeTextField($servicio, 'monto', array('class' => 'form-control', 'placeholder' => 'Precio')); ?>
                                            <?php echo CHtml::error($servicio, 'monto', array('class' => 'label label-danger error-message')); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabel($servicio, 'descripcion_cli'); ?>
                                            <?php echo CHtml::activeTextArea($servicio, 'descripcion_cli', array('class' => 'form-control expandible', 'rows' => '1', 'placeholder' => 'Descripcion')); ?>
                                            <?php echo CHtml::error($servicio, 'descripcion_cli', array('class' => 'label label-danger error-message')); ?>
                                        </div>
                                        <div class="form-group">
                                            <br><br>
                                            <?php echo CHtml::activeLabel($servicio, 'activo'); ?>
                                            <span class="onoffswitch pull-right">
                                        <?php echo CHtml::activeCheckBox($servicio, 'activo', ['class' => 'onoffswitch-checkbox', 'checked' => ($servicio->activo) ? 'checked' : '']); ?>
                                        <?php echo CHtml::activeLabel($servicio, 'activo', ['class' => 'onoffswitch-label', 'label' => '<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span><span class="onoffswitch-switch"></span>']); ?>
                                        </span>
                                            <?php echo CHtml::error($servicio, 'activo', array('class' => 'label label-danger error-message')); ?>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-actions">
                                <?php echo CHtml::submitButton('Guardar', array('class' => 'btn btn-primary btn-lg')); ?>
                            </div>
                            <?php echo CHtml::endForm(); ?>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/servicio/clinicoCreateUpdate.js', CClientScript::POS_END);
?>
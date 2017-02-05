<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>


<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'usuario-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
)); ?>

<fieldset>
    <legend><?php echo ($model->id_usuario == null) ? 'CREAR NUEVO USUARIO' : 'ACTUALIZAR USUARIO' ?></legend>
    <?php echo CHtml::errorSummary($model, '<h4 class="alert-heading"><i class="fa fa-warning"></i> DEBE CORREGIR LOS SIGUIENTES ERRORES </h4>', null, array('class' => 'alert alert-danger error-message')); ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'id_usuario'); ?>
                <?php echo $form->dropDownList($model, 'id_usuario', $personas, array("class" => 'form-control', 'empty' => 'ESCOJA UNA PERSONA', 'id' => 'selectpersona', 'disabled' => ($model->id_usuario == null) ? '' : 'disabled')); ?>
                <?php echo $form->error($model, 'id_usuario', array('class' => 'label label-danger error-message')); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'nombre_usuario'); ?>
                <?php echo $form->textField($model, 'nombre_usuario', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'nombre_usuario', array('class' => 'label label-danger error-message')); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'clave'); ?>
                <?php echo $form->passwordField($model, 'clave', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'clave', array('class' => 'label label-danger error-message')); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'claveCompare'); ?>
                <?php echo $form->passwordField($model, 'claveCompare', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'claveCompare', array('class' => 'label label-danger error-message')); ?>
            </div>

            <?php if ($model->id_usuario != null): ?>
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'estado_usuario'); ?>
                    <span class="onoffswitch pull-right">
							<?php echo $form->checkBox($model, 'estado_usuario', ['class' => 'onoffswitch-checkbox', 'checked' => ($model->estado_usuario) ? 'checked' : '']); ?>
                            <?php echo $form->labelEx($model, 'estado_usuario', ['class' => 'onoffswitch-label', 'label' => '<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span><span class="onoffswitch-switch"></span>']); ?>
						</span>
                    <?php echo $form->error($model, 'estado_usuario', array('class' => 'label label-danger error-message')); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-togglebutton="false" data-widget-deletebutton="false"
                 data-widget-fullscreenbutton="false" data-widget-custombutton="false">
                <header>
                    <h2><strong>LISTADO DE ROLES</strong></h2>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="input-filter" placeholder="BUSCAR...">
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" style="overflow: auto; height: 500px;">
                            <table class="table table-condensed table-bordered " id="desasignado" width="100%;">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Accion</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($roles as $item): ?>
                                    <?php if (!(Yii::app()->authManager->checkAccess($item->name, $model->id_usuario))): ?>
                                        <tr id="<?php echo str_replace(" ", "_", $item->name); ?>">
                                            <td><?php echo $item->name; ?></td>
                                            <td><?php echo $item->description; ?></td>
                                            <td>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" class="checkbox style-0 rol" name="roles[]"
                                                           value="<?php echo $item->name; ?>">
                                                    <span></span>
                                                </label>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="jarviswidget jarviswidget-color-blue" id="widget2" data-widget-togglebutton="false" data-widget-deletebutton="false"
                 data-widget-fullscreenbutton="false" data-widget-custombutton="false">
                <header>
                    <h2><strong>ROLES ASIGNADOS</strong></h2>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <div class="widget-body-toolbar">
                            <span class="label label-info">SELECCIONE ROLES DE LA TABLA DE LA IZQUIERDA</span>
                        </div>
                        <div class="table-responsive" style="overflow: auto; height: 500px;">
                            <table class="table table-condensed table-bordered" id="asignado">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Accion</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($rolesAsignados as $item): ?>
                                    <tr id="<?php echo str_replace(" ", "_", $item->name); ?>">
                                        <td><?php echo $item->name; ?></td>
                                        <td><?php echo $item->description; ?></td>
                                        <td>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" class="checkbox style-0 rol" name="roles[]"
                                                       value="<?php echo $item->name; ?>" checked>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</fieldset>
<div class="form-actions">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'CREAR' : 'GUARDAR', array('class' => 'btn btn-primary btn-lg')); ?>
</div>

<?php $this->endWidget(); ?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/select2/select2.min.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/usuario/usuarioCreateUpdate.js', CClientScript::POS_END); ?>

<?php
/* @var $this UsuarioController */

$this->pageTitle = "Crear <span> > Servicio </span>";
$this->breadcrumbs = array(
    'Create',
);
?>
    <section id="widget-grid">
        <div class="row">
            <article class="col-md-12">
                <div class="jarviswidget" id="widget1">
                    <header></header>
                    <div>
                        <div class="widget-body">
                            <?php echo CHtml::beginForm(); ?>
                            <fieldset>
                                <legend>Crear Servicio Clinico</legend>
                                <?php echo CHtml::errorSummary($servicio, '<h4 class="alert-heading"><i class="fa fa-warning"></i> DEBE CORREGIR LOS SIGUIENTES ERRORES </h4>', null, array('class' => 'alert alert-danger')); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabelEx($servicio, 'cod_serv'); ?>
                                            <?php echo CHtml::activeTextField($servicio, 'cod_serv', array('class' => 'form-control', 'placeholder' => 'Codigo Servicio')); ?>
                                            <?php echo CHtml::error($servicio, 'cod_serv', array('class' => 'label label-danger')); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabel($servicio, 'nombre_serv'); ?>
                                            <?php echo CHtml::activeTextField($servicio, 'nombre_serv', array('class' => 'form-control', 'placeholder' => 'Nombre Servicio')); ?>
                                            <?php echo CHtml::error($servicio, 'nombre_serv', array('class' => 'label label-danger')); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabel($servicio, 'tipo_cobro'); ?>
                                            <?php echo CHtml::activeTextField($servicio, 'tipo_cobro', array('class' => 'form-control', 'placeholder' => 'Tipo de Cobro')); ?>
                                            <?php echo CHtml::error($servicio, 'tipo_cobro', array('class' => 'label label-danger')); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabel($servicio, 'unidad_medida'); ?>
                                            <?php echo CHtml::activeTextField($servicio, 'unidad_medida', array('class' => 'form-control', 'placeholder' => 'Unidad de Medida')); ?>
                                            <?php echo CHtml::error($servicio, 'unidad_medida', array('class' => 'label label-danger')); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabel($servicio, 'monto'); ?>
                                            <?php echo CHtml::activeTextField($servicio, 'monto', array('class' => 'form-control', 'placeholder' => 'Precio')); ?>
                                            <?php echo CHtml::error($servicio, 'monto', array('class' => 'label label-danger')); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>EL SERVICIO PERTENECE A:</label><br>
                                        <span>
                                            <input value="1"
                                                   id="id_entidad_1" <?php echo ($servicio->id_entidad == '1') ? 'checked' : ''; ?>
                                                   type="radio" name="ServicioForm[id_entidad]"/>
                                            <label for="id_entidad_1">CLINICA SANTA ANA SRL</label>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input value=""
                                                   id="id_entidad_null" <?php echo ($servicio->id_entidad == '1') ? '' : 'checked'; ?>
                                                   type="radio" name="ServicioForm[id_entidad]"/>
                                            <label for="entidad_null">OTRO</label>
                                        </span>
                                            <div id="divselect"
                                                 data="<?php echo ($servicio->id_entidad == '1') ? 'hide' : 'show' ?>">
                                                <select style="width:100%" name="ServicioForm[id_entidad]"
                                                        id="selectentidad">
                                                    <option value="a"
                                                            disabled <?php echo ($servicio->id_entidad == '1' || $servicio->id_entidad == null) ? 'selected' : ''; ?> >
                                                        ----- Seleccione una Entidad -----
                                                    </option>
                                                    <?php foreach ($entidad as $item): ?>
                                                        <option
                                                            value="<?php echo $item->id_entidad; ?>" <?php echo ($servicio->id_entidad == $item->id_entidad) ? 'selected' : ''; ?> >
                                                            <?php echo $item->razon_social; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div><?php CHtml::radioButtonList("ss", '1', array(), array()) ?>
                                            <?php echo CHtml::error($servicio, 'id_entidad', array('class' => 'label label-danger')); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabel($servicio, 'id_cat_cli'); ?>
                                            <select style="width:100%" name="ServicioForm[id_cat_cli]"
                                                    id="selectcategoria">
                                                <option
                                                    disabled <?php echo ($servicio->id_cat_cli == null) ? 'selected' : ''; ?> >
                                                    ----- Seleccione una Categoria -----
                                                </option>
                                                <?php foreach ($categoria as $item): ?>
                                                    <option value="<?php echo $item->id_cat_cli; ?>"
                                                            data-descripcion="<?php echo $item->descripcion_cat_cli; ?>" <?php echo ($servicio->id_cat_cli == $item->id_cat_cli) ? 'selected' : ''; ?> >
                                                        <?php echo $item->nombre_cat_cli; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php echo CHtml::error($servicio, 'id_cat_cli', array('class' => 'label label-danger')); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabel($servicio, 'descripcion_cli'); ?>
                                            <?php echo CHtml::activeTextArea($servicio, 'descripcion_cli', array('class' => 'form-control expandible', 'rows' => '1', 'placeholder' => 'Descripcion')); ?>
                                            <?php echo CHtml::error($servicio, 'descripcion_cli', array('class' => 'label label-danger')); ?>
                                        </div>
                                        <div class="form-group">
                                            <br><br>
                                            <?php echo CHtml::activeLabel($servicio, 'activo'); ?>
                                            <span class="onoffswitch pull-right">
                                        <?php echo CHtml::activeCheckBox($servicio, 'activo', ['class' => 'onoffswitch-checkbox', 'checked' => ($servicio->activo) ? 'checked' : '']); ?>
                                        <?php echo CHtml::activeLabel($servicio, 'activo', ['class' => 'onoffswitch-label', 'label' => '<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span><span class="onoffswitch-switch"></span>']); ?>
                                        </span>
                                            <?php echo CHtml::error($servicio, 'activo', array('class' => 'label label-danger')); ?>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-actions">
                                <?php echo CHtml::submitButton('Crear', array('class' => 'btn btn-primary btn-lg')); ?>
                        </div>
                            <?php echo CHtml::endForm(); ?>
                    </div>
                </div>
                </div>
            </article>
        </div>
    </section>


<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/select2/select2.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/iCheck/icheck.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/resources/js/plugin/iCheck/all.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/servicio/clinicoCreateUpdate.js', CClientScript::POS_END);
?>
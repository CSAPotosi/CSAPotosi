<?php
/* $this ServicioController */
$this->pageTitle = "Servicio <span> > Atencion Medica</span>";
$this->breadcrumbs = array(
    'AtencionMedica',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Registro de Asistencia Manual</legend>
                            <div class="row">
                                <div class="col-md-8 col-lg-offset-2">
                                    <?php echo CHtml::beginForm(); ?>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Unidad</label>
                                                <?php echo CHtml::dropDownList('unidad', null,
                                                    CHtml::listData(Unidad::model()->findAll(), 'id_unidad', 'nombre_unidad'),
                                                    array(
                                                        'ajax' => array(
                                                            'type' => 'post',
                                                            'url' => CHtml::normalizeUrl(['Registro/getCargosAjax']),
                                                            'update' => '#cargo',
                                                        ), 'class' => 'form-control', 'prompt' => 'SELECCIONE'
                                                    )
                                                ); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Cargo</label>
                                                <?php echo CHtml::dropDownList('cargo', null,
                                                    array(), array(
                                                        'ajax' => array(
                                                            'type' => 'post',
                                                            'url' => CHtml::normalizeUrl(['Registro/getEmpleadoAjax']),
                                                            'update' => '#Registro_id_asignacion',
                                                        ), 'class' => 'form-control', 'prompt' => 'SELECCIONE'
                                                    )
                                                ); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Empleado</label>
                                                <?php echo CHtml::activedropDownList($modelRegistro, 'id_asignacion', [], ['class' => 'form-control', 'prompt' => 'SELECCIONE']); ?>
                                                <?php echo CHtml::error($modelRegistro, 'id_asignacion', ['class' => 'label label-danger']); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activeLabel($modelRegistro, 'Fecha'); ?>
                                                <?php echo CHtml::activeDateField($modelRegistro, 'fecha', ['class' => 'form-control datepicker', 'data-dateformat' => 'dd/mm/yy']) ?>
                                                <?php echo CHtml::error($modelRegistro, 'fecha', ['class' => 'label label-danger']); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activeLabel($modelRegistro, 'Hora'); ?>
                                                <?php echo CHtml::activeTextField($modelRegistro, 'hora_asistencia', ['class' => 'form-control clockpicker', 'data-autoclose' => 'true']); ?>
                                                <?php echo CHtml::error($modelRegistro, 'hora_asistencia', ['class' => 'label label-danger']); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <?php echo CHtml::activeLabel($modelRegistro, 'Observaciones'); ?>
                                                <?php echo CHtml::activeTextField($modelRegistro, 'observaciones', ['class' => 'form-control','placeholder'=>'Observaciones']) ?>
                                                <?php echo CHtml::error($modelRegistro, 'observaciones'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo CHtml::endForm(); ?>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!--Start Scripts-->

<!--End plugins-->
<!-- start plugins-->
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/clockpicker/clockpicker.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/registro/create.js', CClientScript::POS_END);
?>


<!--end plugins-->
<script>

</script>

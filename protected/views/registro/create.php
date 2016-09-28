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
                                    <?php echo CHtml::errorSummary($modelRegistro); ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <?php echo CHtml::activeLabel($modelRegistro, 'Empleado'); ?>
                                                <?php echo CHtml::activeTextField($modelRegistro, 'id_asignacion', ['class' => 'form-control']); ?>
                                                <?php echo CHtml::error($modelRegistro, 'id_asignacion'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activeLabel($modelRegistro, 'Fecha'); ?>
                                                <?php echo CHtml::activeDateField($modelRegistro, 'fecha', ['class' => 'form-control']) ?>
                                                <?php echo CHtml::error($modelRegistro, 'fecha'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activeLabel($modelRegistro, 'Hora'); ?>
                                                <?php echo CHtml::activeTimeField($modelRegistro, 'hora_asistencia', ['class' => 'form-control']) ?>
                                                <?php echo CHtml::error($modelRegistro, 'hora_asistencia'); ?>
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

                                    <div class="form-group">
                                        <?php echo CHtml::submitButton('Guardar', ['class' => 'btn btn-primary']); ?>
                                    </div>
                                    <?php echo CHtml::endForm(); ?>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!--Start Scripts-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/servicio/index.js', CClientScript::POS_END); ?>
<!--End plugins-->
<!-- start plugins-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/jquery-nestable/jquery.nestable.min.js', CClientScript::POS_END); ?>

<!--end plugins-->
<script>

</script>

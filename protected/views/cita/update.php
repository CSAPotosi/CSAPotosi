<?php
/* $this ServicioController */
$this->pageTitle = "Cita <span> > Detalle Cita</span>";
$this->breadcrumbs = array(
    'Detalle de Cita',
);
$this->renderPartial('/layouts/_cardProfile', ['historialModel' => $modelCita->paciente->historialMedico]); ?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Datos de Cita</legend>
                            <div class="col-md-8 col-lg-offset-2">
                                <table class="table table-responsive table-bordered">
                                    <tr>
                                        <td>Medico</td>
                                        <td><?php echo $modelCita->medicoConsultaServicio->medico->persona->getNombreCompleto() ?></td>
                                    </tr>
                                    <tr>
                                        <td>Especialiadad</td>
                                        <td><?php echo $modelCita->medicoConsultaServicio->idEspecialidad->nombre_especialidad ?></td>
                                    </tr>
                                </table>
                                <?php echo CHtml::beginForm(array(), 'post', array()); ?>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php echo CHtml::activelabelEx($modelCita, 'Fecha'); ?>
                                            <?php echo CHtml::activeTextField($modelCita, 'fecha', array('class' => 'form-control datepicker', 'data-dateformat' => 'dd/mm/yy', 'placeholder' => 'dd/mm/aaaa')); ?>
                                            <?php echo CHtml::error($modelCita, 'fecha', array('class' => 'label label-danger')); ?>
                                        </div>
                                        <div class="col-md-6">

                                            <?php echo CHtml::activelabelEx($modelCita, 'hora_cita'); ?>
                                            <?php echo CHtml::activetimeField($modelCita, 'hora_cita', array('class' => 'form-control')); ?>
                                            <?php echo CHtml::error($modelCita, 'hora_cita', array('class' => 'label label-danger')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php echo CHtml::activelabelEx($modelCita, 'Estado Cita'); ?>
                                            <?php echo CHtml::activedropDownList($modelCita, 'estado_cita', array('0' => 'reservado', '1' => 'confirmado', '2' => 'reconsulta'), array('class' => 'form-control', 'disabled' => ($modelCita->estado_cita == 1) ? 'disabled' : '')); ?>
                                            <?php echo CHtml::error($modelCita, 'estado_cita', array('class' => 'label label-danger')); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php if ($modelCita->estado_cita == 1) { ?>
                                                <br>
                                                <div class="alert alert-info fade in">
                                                    <i class="fa-fw fa fa-info"></i>
                                                    <strong>Informacion!</strong> Cita Confirmada.
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <?php echo CHtml::link('<i class="fa fa-file-pdf-o"></i> Generar Comprobante',
                                array('Cita/pdfComprobanteCita', 'id' => $modelCita->id_cita),
                                array('class' => 'btn btn-primary', 'title' => 'Detalle')); ?>
                            <button type="submit" class="btn btn-primary" id="btn-cita"><i class="fa fa-save"></i>
                                Actualizar
                            </button>
                        </div>
                        <?php echo CHtml::endForm(); ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/paciente/update.js', CClientScript::POS_END);
?>


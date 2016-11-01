<div class="row">
    <div class="col-md-12">
        <?php
        /* @var $this AgendaController */
        /* @var $model Cita */
        /* @var $form CActiveForm */
        ?>
        <div class="form">
            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'cita-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class' => 'form-horizontal'),
            )); ?>
            <div class="box-body">
                <?php echo $form->errorSummary($modelCita, null, null, array('class' => 'alert alert-error')); ?>
                <div class="form-group">
                    <label>Paciente</label>
                    <div class="input-group">
                        <input class="form-control" id="appendbutton" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="button">
                                Buscar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Atencion Medica</label>
                    <div class="input-group">
                        <input class="form-control" id="appendbutton" type="text">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="button">
                                Especialidad
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $form->labelEx($modelCita, 'fecha'); ?>
                            <?php echo $form->dateField($modelCita, 'fecha', array('class' => 'form-control', 'placeholder' => 'fecha', 'id' => 'date')); ?>
                            <?php echo $form->error($modelCita, 'fecha', array('class' => 'label label-danger')); ?>
                        </div>
                        <div class="col-md-6">

                            <?php echo $form->labelEx($modelCita, 'hora_cita'); ?>
                            <?php echo $form->timeField($modelCita, 'hora_cita', array('class' => 'form-control')); ?>
                            <?php echo $form->error($modelCita, 'hora_cita', array('class' => 'label label-danger')); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $form->hiddenField($modelCita, 'medico_consulta_servicio', array('class' => 'form-control', 'id' => 'codigoatencion')); ?>

                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo $form->labelEx($modelCita, 'Estado Cita'); ?>
                            <?php echo $form->dropDownList($modelCita, 'estado_cita', array('0' => 'reservado', '1' => 'confirmado', '2' => 'reconsulta'), array('class' => 'form-control')); ?>
                            <?php echo $form->error($modelCita, 'estado_cita', array('class' => 'label label-danger')); ?>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <input type="button" value="Guardar Cita" class="btn btn-primary" target="_blank"
                                   id="btnformcita">
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->endWidget(); ?>
        </div><!-- form -->
    </div>
</div>

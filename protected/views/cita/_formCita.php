<div class="row">
    <div class="col-md-12">
        <?php
        /* @var $this AgendaController */
        /* @var $model Cita */
        /* @var $form CActiveForm */
        ?>
        <div class="form">
            <?php echo CHtml::beginForm(array(), 'post', array()); ?>
            <div class="box-body">
                <div class="form-group">
                    <label>PACIENTE</label>
                    <div class="input-group">
                        <input class="form-control" id="appendbutton" type="text" disabled
                               value="<?php echo ($paciente != '') ? $paciente->persona->getNombreCompleto() : '' ?>">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="button" data-target="#modalPaciente"
                                    data-toggle="modal"> Paciente
                            </button>
                        </div>
                    </div>
                    <?php echo CHtml::error($modelCita, 'id_paciente', array('class' => 'label label-danger')); ?>
                </div>
                <div class="form-group">
                    <label>ATENCION MEDICA</label>
                    <div class="input-group">
                        <input class="form-control" id="especialidad" type="text" disabled>
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="button" data-target="#modalAtencion"
                                    data-toggle="modal">
                                Especialidad
                            </button>
                        </div>
                    </div>
                    <?php echo CHtml::error($modelCita, 'medico_consulta_servicio', array('class' => 'label label-danger')); ?>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>FECHA</label>
                            <?php echo CHtml::activeTextField($modelCita, 'fecha', array('class' => 'form-control datepicker', 'data-dateformat' => 'dd/mm/yy', 'placeholder' => 'dd/mm/aaaa')); ?>
                            <?php echo CHtml::error($modelCita, 'fecha', array('class' => 'label label-danger')); ?>
                        </div>
                        <div class="col-md-6">

                            <label>HORA DE LA CITA</label>
                            <?php echo CHtml::activeDropDownList($modelCita, 'hora_cita', [], array('class' => 'form-control', 'disabled' => 'disabled', 'data-atencion' => CHtml::normalizeUrl(array('Cita/BuscarHora')))); ?>
                            <?php echo CHtml::error($modelCita, 'hora_cita', array('class' => 'label label-danger')); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo CHtml::activeHiddenField($modelCita, 'medico_consulta_servicio', array('class' => 'form-control', 'id' => 'codigoatencion')); ?>
                    <?php echo CHtml::activeHiddenField($modelCita, 'id_paciente', array('class' => 'form-control', 'id' => 'paciente', 'value' => ($paciente != '') ? $paciente->id_paciente : '')); ?>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label>ESTADO DE LA CITA</label>
                            <?php echo CHtml::activedropDownList($modelCita, 'estado_cita', array('0' => 'reservado', '1' => 'confirmado', '2' => 'reconsulta'), array('class' => 'form-control')); ?>
                            <?php echo CHtml::error($modelCita, 'estado_cita', array('class' => 'label label-danger')); ?>
                        </div>
                        <div class="col-md-6">
                            <br>
                            <button type="submit" id="btnformcita" class="btn btn-primary"><i class="fa fa-save">
                                    Guardar</i></button>

                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <?php echo CHtml::endForm(); ?>
        </div><!-- form -->
    </div>
</div>

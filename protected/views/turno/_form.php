<?php echo CHtml::beginForm(array(), 'post', array()); ?>
    <div class="row">
        <div class="col-md-6">
            <?php echo CHtml::activelabelEx($modelTurno, 'nombre_turno'); ?>
            <?php echo CHtml::activetextField($modelTurno, 'nombre_turno', array('class' => 'form-control', 'placeholder' => 'Nombre de Turno')); ?>
            <?php echo CHtml::error($modelTurno, 'nombre_turno', array('class' => 'label label-danger')); ?>
        </div>
        <div class="col-md-6">
            <?php echo CHtml::activelabelEx($modelTurno, 'tipo_turno'); ?>
            <?php echo CHtml::activedropDownList($modelTurno, 'tipo_turno', $modelTurno->getTipoTurno(), array('class' => 'form-control')); ?>
            <?php echo CHtml::error($modelTurno, 'tipo_turno', array('class' => 'label label-danger')); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php $value = ($modelTurno->hora_entrada == "") ? "" : date("h:i A", strtotime($modelTurno->hora_entrada)); ?>
            <?php echo CHtml::activelabelEx($modelTurno, 'hora_entrada'); ?>
            <?php echo CHtml::activetimeField($modelTurno, 'hora_entrada', array('value' => $value, 'class' => 'form-control', 'data-inputmask' => '"mask":"99:99 aM"', 'placeholder' => 'hora', 'data-mask' => 'data-mask')); ?>
            <?php echo CHtml::error($modelTurno, 'hora_entrada', array('class' => 'label label-danger')); ?>
        </div>
        <div class="col-md-4">
            <?php echo CHtml::activelabelEx($modelTurno, 'inicio_entrada'); ?>
            <?php echo CHtml::activetextField($modelTurno, 'inicio_entrada', array('class' => 'form-control', 'placeholder' => 'Inicio entrada')); ?>
            <?php echo CHtml::error($modelTurno, 'inicio_entrada', array('class' => 'label label-danger')); ?>
        </div>
        <div class="col-md-4">
            <?php echo CHtml::activelabelEx($modelTurno, 'fin_entrada'); ?>
            <?php echo CHtml::activetextField($modelTurno, 'fin_entrada', array('class' => 'form-control', 'placeholder' => 'Fin entrada')); ?>
            <?php echo CHtml::error($modelTurno, 'fin_entrada', array('class' => 'label label-danger')); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?php $value = ($modelTurno->hora_salida == "") ? "" : date("h:i A", strtotime($modelTurno->hora_salida)); ?>
            <?php echo CHtml::activelabelEx($modelTurno, 'hora_salida'); ?>
            <?php echo CHtml::activetimeField($modelTurno, 'hora_salida', array('value' => $value, 'class' => 'form-control', 'data-inputmask' => '"mask":"99:99 aM"', 'placeholder' => 'hora', 'data-mask' => 'data-mask')); ?>
            <?php echo CHtml::error($modelTurno, 'hora_salida', array('class' => 'label label-danger')); ?>
        </div>
        <div class="col-md-4">
            <?php echo CHtml::activelabelEx($modelTurno, 'inicio_salida'); ?>
            <?php echo CHtml::activetextField($modelTurno, 'inicio_salida', array('class' => 'form-control', 'placeholder' => 'Inicio salida')); ?>
            <?php echo CHtml::error($modelTurno, 'inicio_salida', array('class' => 'label label-danger')); ?>
        </div>
        <div class="col-md-4">
            <?php echo CHtml::activelabelEx($modelTurno, 'fin_salida'); ?>
            <?php echo CHtml::activetextField($modelTurno, 'fin_salida', array('class' => 'form-control', 'placeholder' => 'Fin salida')); ?>
            <?php echo CHtml::error($modelTurno, 'fin_salida', array('class' => 'label label-danger')); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php echo CHtml::activelabelEx($modelTurno, 'tolerancia'); ?>
            <?php echo CHtml::activetextField($modelTurno, 'tolerancia', array('class' => 'form-control', 'placeholder' => 'tolerancia')); ?>
            <?php echo CHtml::error($modelTurno, 'tolerancia', array('class' => 'label label-danger')); ?>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-12">
            <?php echo CHtml::submitButton($modelTurno->isNewRecord ? 'Guardar Turno' : 'Actualizar Turno', array('class' => 'btn btn-info pull-rigth')); ?>
        </div>
    </div>
<?php echo CHtml::endForm(); ?>
<?php echo CHtml::beginForm(array(), 'post', array()); ?>
    <div class="box-body">
        <div class="form-group">
            <?php echo CHtml::activelabelEx($modelHorario, 'nombre_horario'); ?>
            <?php echo CHtml::activetextField($modelHorario, 'nombre_horario', array('class' => 'form-control', 'placeholder' => 'Escribe un nombre para el horario')); ?>
            <?php echo CHtml::error($modelHorario, 'nombre_horario', array('class' => 'label label-danger')); ?>
        </div>
        <div class="form-group">
            <?php echo CHtml::activelabelEx($modelHorario, 'descripcion'); ?>
            <?php echo CHtml::activetextField($modelHorario, 'descripcion', array('class' => 'form-control', 'placeholder' => 'Descripcion del Horario')); ?>
            <?php echo CHtml::error($modelHorario, 'descripcion', array('class' => 'label label-danger')); ?>
        </div>
        <div class="form-group">
            <?php echo CHtml::activelabelEx($modelHorario, 'Ciclo de Trabajo'); ?>
            <?php echo CHtml::activetextField($modelHorario, 'ciclo_total', array('class' => 'form-control', 'placeholder' => 'Ciclo de trabajo en dias')); ?>
            <?php echo CHtml::error($modelHorario, 'ciclo_total', array('class' => 'label label-danger')); ?>
        </div>
        <div class="form-group">
            <?php echo CHtml::activelabelEx($modelHorario, 'cargo'); ?>
            <?php echo CHtml::activedropDownList($modelHorario, 'cargo', $modelHorario->getCargo(), array('class' => 'form-control')); ?>
            <?php echo CHtml::error($modelHorario, 'cargo', array('class' => 'label label-danger')); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php echo CHtml::submitButton($modelHorario->isNewRecord ? 'Guardar Horario' : 'Actualizar Horario', array('class' => 'btn btn-info pull-rigth')); ?>
        </div>
    </div>
<?php echo CHtml::endForm(); ?>
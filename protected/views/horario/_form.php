<?php echo CHtml::beginForm(array(), 'post', array()); ?>
    <fieldset>
        <legend><?php echo ($modelHorario->isNewRecord)?'Crear':'Editar'; ?> Horario</legend>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="form-group">
                    <?php echo CHtml::activelabelEx($modelHorario, 'nombre_horario'); ?>
                    <?php echo CHtml::activetextField($modelHorario, 'nombre_horario', array('class' => 'form-control', 'placeholder' => 'Escribe un nombre para el horario')); ?>
                    <?php echo CHtml::error($modelHorario, 'nombre_horario', array('class' => 'label label-danger')); ?>
                </div>
                <div class="form-group">
                    <?php echo CHtml::activelabelEx($modelHorario, 'Ciclo de Trabajo'); ?>
                    <?php echo CHtml::activetextField($modelHorario, 'ciclo_total', array('class' => 'form-control', 'placeholder' => 'Ciclo de trabajo en dias')); ?>
                    <?php echo CHtml::error($modelHorario, 'ciclo_total', array('class' => 'label label-danger')); ?>
                </div>
                <div class="form-group">
                    <?php echo CHtml::activelabelEx($modelHorario, 'descripcion'); ?>
                    <?php echo CHtml::activetextArea($modelHorario, 'descripcion', array('class' => 'form-control', 'placeholder' => 'Descripcion del Horario')); ?>
                    <?php echo CHtml::error($modelHorario, 'descripcion', array('class' => 'label label-danger')); ?>
                </div>
            </div>
        </div>

    </fieldset>
    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Guardar
        </button>
    </div>
<?php echo CHtml::endForm(); ?>
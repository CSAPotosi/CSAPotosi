<?php echo CHtml::beginForm(array(), 'post', array()); ?>
    <div class="form-group">
        <?php echo CHtml::activelabelEx($modelUnidad, 'nombre_unidad'); ?>
        <?php echo CHtml::activetextField($modelUnidad, 'nombre_unidad', array('class' => 'form-control', 'placeholder' => 'Nombre de la Unidad')); ?>
        <?php echo CHtml::error($modelUnidad, 'nombre_unidad', array('class' => 'label label-danger error-message')); ?>
    </div>
    <div class="form-group">
        <?php echo CHtml::activelabelEx($modelUnidad, 'descripcion_unidad'); ?>
        <?php echo CHtml::activetextField($modelUnidad, 'descripcion_unidad', array('class' => 'form-control', 'placeholder' => 'Nombre de la Unidad')); ?>
        <?php echo CHtml::error($modelUnidad, 'descripcion_unidad', array('class' => 'label label-danger error-message')); ?>
    </div>


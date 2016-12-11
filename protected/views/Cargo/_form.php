<?php echo CHtml::beginForm(array(), 'post', array()); ?>
    <div class="form-group">
        <?php echo CHtml::activelabelEx($modelCargo, 'nombre_cargo'); ?>
        <?php echo CHtml::activetextField($modelCargo, 'nombre_cargo', array('class' => 'form-control', 'placeholder' => 'Nombre de la Unidad')); ?>
        <?php echo CHtml::error($modelCargo, 'nombre_cargo', array('class' => 'label label-danger')); ?>
    </div>
    <div class="form-group">
        <?php echo CHtml::activelabelEx($modelCargo, 'descripcion_cargo'); ?>
        <?php echo CHtml::activetextField($modelCargo, 'descripcion_cargo', array('class' => 'form-control', 'placeholder' => 'Nombre de la Unidad')); ?>
        <?php echo CHtml::error($modelCargo, 'descripcion_cargo', array('class' => 'label label-danger')); ?>
    </div>
    <div class="form-group">
        <?php echo CHtml::activelabelEx($modelCargo, 'Horario'); ?>
        <?php echo CHtml::activeDropDownList($modelCargo, 'id_horario', $modelCargo->getHorario(), array('class' => 'form-control')); ?>
        <?php echo CHtml::error($modelCargo, 'descripcion_cargo', array('class' => 'label label-danger')); ?>
    </div>
    <input type="hidden" name="Cargo[id_unidad]" value="<?php echo $id ?>">
    
    
<input id="flag" type="hidden" value="1">
<div class="form">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => ('formEspecialidad'),
    )); ?>
    <?php echo CHtml::activeHiddenField($modelEspecialidad, 'id_especialidad', array()); ?>
    <? ?>
    <div class="form-group">
        <?php echo $form->labelEx($modelEspecialidad, 'Especialidad'); ?>
        <?php echo $form->textField($modelEspecialidad, 'nombre_especialidad', array('class' => 'form-control', 'placeholder' => 'Nombre de Especialidad')); ?>
        <?php echo $form->error($modelEspecialidad, 'nombre_especialidad', array('class' => 'label label-danger')); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($modelEspecialidad, 'Descripcion'); ?>
        <?php echo $form->textField($modelEspecialidad, 'descripcion', array('class' => 'form-control', 'placeholder' => 'Descripcion de Especialidad')); ?>
        <?php echo $form->error($modelEspecialidad, 'descripcion', array('class' => 'label label-danger')); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
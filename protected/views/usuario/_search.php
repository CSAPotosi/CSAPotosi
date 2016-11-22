<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    )); ?>

    <div class="row">
        <?php echo $form->label($model, 'id_usuario'); ?>
        <?php echo $form->textField($model, 'id_usuario'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'nombre_usuario'); ?>
        <?php echo $form->textField($model, 'nombre_usuario', array('size' => 32, 'maxlength' => 32)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'clave'); ?>
        <?php echo $form->textField($model, 'clave', array('size' => 60, 'maxlength' => 128)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'estado_usuario'); ?>
        <?php echo $form->textField($model, 'estado_usuario'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->
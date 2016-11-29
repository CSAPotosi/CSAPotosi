<?php
/* @var $this UsuarioController */
/* @var $data Usuario */
?>
<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id_usuario), array('view', 'id' => $data->id_usuario)); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('nombre_usuario')); ?>:</b>
    <?php echo CHtml::encode($data->nombre_usuario); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('clave')); ?>:</b>
    <?php echo CHtml::encode($data->clave); ?>
    <br/>

    <b><?php echo CHtml::encode($data->getAttributeLabel('estado_usuario')); ?>:</b>
    <?php echo CHtml::encode($data->estado_usuario); ?>
    <br/>

</div>
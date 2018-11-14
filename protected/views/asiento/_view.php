<?php
/* @var $this AsientoController */
/* @var $data Asiento */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_asiento')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_asiento), array('view', 'id'=>$data->id_asiento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_registro')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('glosa')); ?>:</b>
	<?php echo CHtml::encode($data->glosa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero_asiento')); ?>:</b>
	<?php echo CHtml::encode($data->numero_asiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero_comprobante')); ?>:</b>
	<?php echo CHtml::encode($data->numero_comprobante); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('referencia')); ?>:</b>
	<?php echo CHtml::encode($data->referencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_ciclo')); ?>:</b>
	<?php echo CHtml::encode($data->id_ciclo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_usuario')); ?>:</b>
	<?php echo CHtml::encode($data->id_usuario); ?>
	<br />

	*/ ?>

</div>
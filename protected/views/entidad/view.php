<?php
/* @var $this EntidadController */
/* @var $model Entidad */

$this->breadcrumbs=array(
	'Entidads'=>array('index'),
	$model->id_entidad,
);

?>

<h1>View Entidad #<?php echo $model->id_entidad; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_entidad',
		'razon_social',
		'direccion',
		'telefono',
		'tipo_entidad',
		'naturaleza_juridica',
	),
)); ?>

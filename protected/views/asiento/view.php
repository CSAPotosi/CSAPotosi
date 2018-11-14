<?php
/* @var $this AsientoController */
/* @var $model Asiento */

$this->breadcrumbs=array(
	'Asientos'=>array('index'),
	$model->id_asiento,
);

$this->menu=array(
	array('label'=>'List Asiento', 'url'=>array('index')),
	array('label'=>'Create Asiento', 'url'=>array('create')),
	array('label'=>'Update Asiento', 'url'=>array('update', 'id'=>$model->id_asiento)),
	array('label'=>'Delete Asiento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_asiento),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Asiento', 'url'=>array('admin')),
);
?>

<h1>View Asiento #<?php echo $model->id_asiento; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_asiento',
		'tipo',
		'fecha_registro',
		'fecha',
		'glosa',
		'numero_asiento',
		'numero_comprobante',
		'id_ciclo',
		'referencia',
	),
)); ?>

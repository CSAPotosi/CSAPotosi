<?php
/* @var $this AsientoController */
/* @var $model Asiento */

$this->breadcrumbs=array(
	'Asientos'=>array('index'),
	$model->id_asiento=>array('view','id'=>$model->id_asiento),
	'Update',
);

$this->menu=array(
	array('label'=>'List Asiento', 'url'=>array('index')),
	array('label'=>'Create Asiento', 'url'=>array('create')),
	array('label'=>'View Asiento', 'url'=>array('view', 'id'=>$model->id_asiento)),
	array('label'=>'Manage Asiento', 'url'=>array('admin')),
);
?>

<h1>Update Asiento <?php echo $model->id_asiento; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
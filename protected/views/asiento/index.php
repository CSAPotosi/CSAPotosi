<?php
/* @var $this AsientoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Asientos',
);

?>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

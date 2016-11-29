<?php
$this->breadcrumbs=array(
	'Manage'=>array('index'),
);?>
<h1> Administracion de backups</h1>
<pre>
<?php var_dump($this->menu);?>	
</pre>

<?php $this->renderPartial('_list', array(
		'dataProvider'=>$dataProvider,
));
?>

<?php
/* @var $this MedicamentoController */

$this->breadcrumbs=array(
	'Medicamento',
);

$mediList = Medicamento::model()->findAll([
    'condition'=>'estado_med > 0'
]);
?>

<style>
	table thead tr th{
		text-align: center;
		vertical-align: middle;
	}
</style>

<section id="widget-grid">
	<div class="row">
		<article class="col-md-12">
			<div class="jarviswidget jarviswidget-color-blue" id="widget1">
				<header></header>
				<div>
					<div class="widget-body no-padding">
						<?php $this->renderPartial('_tableMedicamento',['mediList'=>$mediList,'selectable'=>false]);?>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>


<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/jquery.dataTables.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.colVis.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.tableTools.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.bootstrap.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatable-responsive/datatables.responsive.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/medicamento/index.js', CClientScript::POS_END);
?>
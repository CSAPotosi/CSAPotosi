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
			<div class="jarviswidget" id="widget1">
				<header></header>
				<div>
					<div class="widget-body">
						<?php $this->renderPartial('_tableMedicamento',['mediList'=>$mediList,'selectable'=>false]);?>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>



<?php
/* @var $this EntidadController */
/* @var $model Entidad */

$this->breadcrumbs=array(
	'Entidads'=>array('index'),
	$modelEntidad->id_entidad=>array('view','id'=>$modelEntidad->id_entidad),
	'Update',
);

?>
<section id="widget-grid">
	<div class="row">
		<article class="col-md-12">
			<div class="jarviswidget jarviswidget-color-blue">
				<header>Actualizar de Entidad </header>
				<div>
					<div class="widget-body">
						<?php $this->renderPartial('_form', array('modelEntidad'=>$modelEntidad)); ?>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>

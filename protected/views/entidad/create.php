<?php
/* @var $this EntidadController */
/* @var $model Entidad */
$this->pageTitle = "Crear <span> > Entidad </span>";
$this->breadcrumbs=array(
	'Entidads'=>array('index'),
	'Create',
);

?>

<section id="widget-grid">
	<div class="row">
		<article class="col-md-12">
			<div class="jarviswidget jarviswidget-color-blue">
				<header>Formulario de Registro de Entidad </header>
				<div>
					<div class="widget-body">
						<?php $this->renderPartial('_form', array('modelEntidad'=>$modelEntidad)); ?>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>
<?php
/* @var $this EntidadController */
/* @var $model Entidad */

$this->breadcrumbs=array(
	'Entidades'=>array('index'),
	'Manage',
);
?>



<section id="widget-grid">
	<div class="row">
		<article class="col-md-12">
			<div class="jarviswidget">
				<header>Entidad </header>
				<div>
					<div class="widget-body">

						<?php $this->widget('zii.widgets.grid.CGridView', array(
							'id'=>'entidad-grid',
							'dataProvider'=>$model->search(),
							'filter'=>$model,
							'columns'=>array(
								'id_entidad',
								'razon_social',
								'nit',
								'direccion',
								'telefono',
								'tipo_entidad',
								
								'naturaleza_juridica',
								array(
									'class'=>'CButtonColumn',
								),
							),
						)); ?>

					</div>
				</div>
			</div>
		</article>
	</div>
</section>


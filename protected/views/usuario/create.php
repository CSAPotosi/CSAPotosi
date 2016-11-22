<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->pageTitle = 'CREAR NUEVO USUARIO';
?>

<section id="widget-grid">
	<div class="row">
		<article class="col-md-12">
			<div class="jarviswidget jarviswidget-color-blue">
				<header></header>
				<div>
					<div class="widget-body">
						<?php $this->renderPartial('_form', array('model' => $model, 'personas' => $personas, 'roles' => $roles, 'rolesAsignados' => $rolesAsignados)); ?>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>






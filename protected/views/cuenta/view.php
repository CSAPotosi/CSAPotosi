<?php
/* @var $this CuentaController */
/* @var $model Cuenta */

$this->pageTitle = 'Cuenta: '.$model->codigo;
?>
<section id="widget-grid">
	<div class="row">
		<article class="col-md-12">
			<div class="jarviswidget jarviswidget-color-blue" id="widget1">
				<header></header>
				<div>
					<div class="widget-body">
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<table class="table table-bordered">
									<tr>
										<td>CODIGO</td>
										<td><?php echo $model->codigo?></td>
									</tr>
									<tr>
										<td>NOMBRE</td>
										<td><?php echo $model->nombre?></td>
									</tr>
									<tr>
										<td>DESCRIPCION</td>
										<td><?php echo $model->descripcion?></td>
									</tr>
									<tr>
										<td>NIVEL DE LA CUENTA</td>
										<td><?php echo $model->getNiveles()[$model->nivel]; ?></td>
									</tr>
									<tr>
										<td>NATURALEZA DE CUENTA</td>
										<td><?php echo $model->getTipos()[$model->naturaleza];?></td>
									</tr>
									<tr>
										<td>FECHA DE CREACION</td>
										<td><?php echo date("d-m-Y",strtotime($model->fecha_creacion)); ?></td>
									</tr>
									<tr>
										<td>ACTIVO</td>
										<td><?php echo ($model->activo)?"SI":"NO"?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>

<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/resources/js/plugin/treetable/jquery.treetable.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/resources/js/plugin/treetable/jquery.treetable.theme.default.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/treetable/jquery.treetable.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/cuenta/admin.js', CClientScript::POS_END);

?>

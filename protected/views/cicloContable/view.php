<?php
$this->pageTitle = 'Datos de Ciclo Contable';
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
										<td>GESTION</td>
										<td><?php echo $ciclo->gestion?></td>
									</tr>
									<tr>
										<td>DIA DE INICIO</td>
										<td><?php echo $ciclo->dia_inicio?></td>
									</tr>
									<tr>
										<td>DESCRIPCION</td>
										<td><?php echo $ciclo->descripcion?></td>
									</tr>
									<tr>
										<td>ESTADO</td>
										<td><?php echo ($ciclo->activo)? '<span class="label label-success">Vigente</span>' : '<span class="label label-danger">Pasado</span>'?></td>
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

<?php
$this->pageTitle = 'Ciclos Contables';
?>
<section id="widget-grid">
	<div class="row">
		<article class="col-md-12">
			<div class="jarviswidget jarviswidget-color-blue" id="widget1">
				<header></header>
				<div>
					<div class="widget-body">
						<h2 class="text-center">Listado de Todos los Ciclos Contables</h2>
						<table class = "table table-bordered contable">
							<thead>
								<tr>
									<th class='ancho-10'>GESTION</th>
									<th class='ancho-10'>INICIO</th>
									<th>DESCRIPCION</th>
									<th class='ancho-10'>ESTADO</th>
									<th class='ancho-5'>ACCIONES</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($ciclos as $ciclo): ?>
									<tr>
										<td><?php echo $ciclo->gestion?></td>
										<td><?php echo date("d/m/Y", strtotime($ciclo->dia_inicio))?></td>
										<td><?php echo $ciclo->descripcion?></td>
										<td><?php echo ($ciclo->activo)? '<span class="label label-success">Vigente</span>' : '<span class="label label-danger">Pasado</span>'?>
										<td class='text-right'>
											<a href="<?php echo $this->createAbsoluteUrl('cicloContable/view', array('id' => $ciclo->id_ciclo));?>" class="btn btn-default btn-xs" title="Ver Datos" ><label class="fa fa-eye"></label></a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>

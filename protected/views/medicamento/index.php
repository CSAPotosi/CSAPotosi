<?php
/* @var $this MedicamentoController */

$this->breadcrumbs=array(
	'Medicamento',
);

$mediList = Medicamento::model()->findAll();

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
						<?php if(count($mediList)>0):?>
						<table class="table table-hovered table-bordered">
							<thead>
								<tr>
									<th width="5%">Codigo</th>
									<th width="55%%">Medicamento</th>
									<th width="15%">Forma farmaceutica</th>
									<th width="15%">Concentracion</th>
									<th width="5%">Clasificacion A.T.Q.</th>
									<th width="5%%">Uso restringido</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($mediList as $medi):?>
									<tr>
										<td><?php echo $medi->codigo; ?></td>
										<td><?php echo $medi->nombre_med;?></td>
										<td><?php echo $medi->forma_farm;?></td>
										<td><?php echo $medi->concentracion;?></td>
										<td><?php echo $medi->ATQ;?></td>
										<td><?php echo ($medi->restringido)?'R':''; ?></td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>
						<?php endif;?>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>



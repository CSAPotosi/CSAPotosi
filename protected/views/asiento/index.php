<?php
/* @var $this AsientoController */
/* @var $model Asiento */
$this->pageTitle = 'Asientos Del Libro Diario';

?>
	<section id="widget-grid">
		<div class="row">
			<article class="col-md-12">
				<div class="jarviswidget jarviswidget-color-blue" id="widget1">
					<header></header>
					<div>
						<div class="widget-body">
							<?php echo CHtml::beginForm(array('asiento/index'),'get'); ?>
							<div class = 'row' >
								<div class="col-md-4">
									<label for='inicio' class='col-md-2 control-label'>Fecha Inicio</label>
									<div class='col-md-10'>
										<input type="datepicker" class="form-control datepicker"
												data-dateformat="dd-mm-yy" name="inicio"
												placeholder="dd/mm/aaaa"'
										value=<?php echo $inicio; ?> >
									</div>
								</div>
								<div class="col-md-4">
									<label for='fin' class='col-md-2 control-label'>Fecha Fin</label>
									<div class='col-md-10'>
										<input type="datepicker" class="form-control datepicker"
												data-dateformat="dd-mm-yy" name="fin"
												placeholder="dd/mm/aaaa"'
										value=<?php echo $fin; ?> >
									</div>
								</div>
								<div class = 'col-md-3'>
									<?php echo CHtml::Label('Tipo','tipo', array('class'=>'col-md-2 control-label')); ?>
									<div class='col-md-10'>
										<?php echo CHtml::dropDownList('tipo', $tipo, array_merge(array(0=>'Todo'), Asiento::model()->tipos), array('class'=>'form-control')) ?>
									</div>
								</div>
								<div class = 'col-md-1'>
									<?php echo CHtml::submitButton('Buscar', array('class' => 'btn btn-primary pull-right')); ?>
								</div>
							</div>
							<?php echo CHtml::endForm(); ?>

							<table class="table">
								<thead>
								<tr>
									<th>FECHA</th>
									<th>ASIENTO</th>
									<th>TIPO</th>
									<th>REFERENCIA</th>
									<th>GLOSA</th>
									<th>IMPORTE</th>
									<th>USUARIO</th>
									<th style='width: 90px'>ACCIONES</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($asientos as $item):	?>
									<tr>
										<td>
											<?php echo date("d-m-Y", strtotime($item->fecha));?>
										</td>
										<td>
											<?php echo $item->numero_asiento;?>
										</td>
										<td>
											<?php echo $item->getTipo($item->tipo);?>
										</td>
										<td>
											<?php echo $item->referencia;?>
										</td>
										<td>
											<?php echo substr($item->glosa, 0, 100).((strlen($item->glosa)>100)?" ...":"");?>
										</td>
										<td>
											<?php echo $item->getImporte();?>
										</td>
										<td>
											<?php echo Yii::app()->user->name;?>
										</td>
										<td>
											<div class = "btn-group">
												<a href="<?php echo $this->createAbsoluteUrl('asiento/view', array('id' => $item->id_asiento));?>" class="btn btn-default btn-xs"  title="Ver Datos" ><label class="fa fa-eye"></label></a>
												<a href="<?php echo $this->createAbsoluteUrl('asiento/update', array('id' => $item->id_asiento));?>" class="btn btn-info btn-xs" title="Actualizar Datos" ><label class="fa fa-pencil"></label></a>
												<a href="<?php echo $this->createAbsoluteUrl('asiento/delete', array('id' => $item->id_asiento));?>" class="btn btn-danger btn-xs btn-delete" title="Eliminar Asiento" ><label class="fa fa-close"></label></a>
											</div>
										</td>
									</tr>
								<?php endforeach;?>
								</tbody>
							</table>
						</div>	
					</div>
				</div>
			</article>
		</div>
	</section>

<?php
Yii::app()->clientScript->registerScript('myjquery', '
$(".btn-delete").on("click",function(e){
	if(!confirm("¿Esta seguro de eliminar el asiento?"))
		e.preventDefault();
})
');
?>

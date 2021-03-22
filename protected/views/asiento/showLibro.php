<?php
/* @var $this CuentaController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = 'Administrar Plan de Cuentas';
?>
	<section id="widget-grid">
		<div class="row">
			<article class="col-md-12">
				<div class="jarviswidget jarviswidget-color-blue" id="widget1">
					<header></header>
					<div>
						<div class="widget-body">
							<?php echo CHtml::beginForm(array('asiento/showLibro'),'get'); ?>
							<div class = 'row' >
								<div class="col-md-2">
								</div>
								<div class="col-md-3">
									<label for='inicio' class='col-md-2 control-label'>Fecha Inicio</label>
									<div class='col-md-10'>
										<input type="datepicker" class="form-control datepicker"
												data-dateformat="dd-mm-yy" name="inicio"
												placeholder="dd/mm/aaaa"'
										value=<?php echo $inicio; ?> >
									</div>
								</div>
								<div class="col-md-3">
									<label for='fin' class='col-md-2 control-label'>Fecha Fin</label>
									<div class='col-md-10'>
										<input type="datepicker" class="form-control datepicker"
												data-dateformat="dd-mm-yy" name="fin"
												placeholder="dd/mm/aaaa"'
										value=<?php echo $fin; ?> >
									</div>
								</div>
								<div class = 'col-md-4'>
									<?php echo CHtml::submitButton('Mostrar', array('class' => 'btn btn-primary')); ?>
								</div>
							</div>
							<?php echo CHtml::endForm(); ?>
							<div id="report">
								<table style='width:100%; margin: 0px -20px;' >
									<tr>
										<td class='ancho-15' ></td>
										<td><h3 class='text-center'>Libro Diario</h3></td>
										<td class='ancho-10' >
										<div class='reportButton'>
											<?php echo CHtml::beginForm(null,'post',array('target'=>'_blank')); ?>
				
											<?php echo CHtml::hiddenField('pdf' , '', array('id' => 'hiddenpdf')); ?>
											
											<div class="row submit">
												<?php echo CHtml::submitButton('Reporte', array('id' => 'buttonpdf', 'class' => 'btn btn-primary pull-right')); ?>
											</div>

											<?php echo CHtml::endForm(); ?>
										<div>
										</td>
									</tr>
								</table>
								<p class="text-center">(DEL <?php echo date("d-m-Y",strtotime($inicio)); ?> AL <?php echo date("d-m-Y",strtotime($fin)); ?>)</p>
								<table class = "table table-bordered contable">
									<thead>
										<tr>
											<th class='ancho-15' >FECHA / CODIGO</th>
											<th>DETALLE</th>
											<th class='ancho-10' >DEBE</th>
											<th class='ancho-10' >HABER</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($asientos as $asiento): ?>
											<tr>
												<td><u><?php echo date("d-m-Y", strtotime($asiento->fecha)); ?></u></td>
												<td class= "text-center">-------------------- Asiento Nro. <?php echo $asiento->numero_asiento; ?> --------------------</td>
												<td></td>
												<td></td>
											</tr>
											<?php $d = 0; $h = 0; ?>
											<?php foreach($asiento->cuentaAsientos as $cuentasiento): ?>
												<tr>
													<td><?php echo $cuentasiento->cuenta->codigo; ?></td>
													<td>
														<?php echo (isset($cuentasiento->haber))? "&nbsp;&nbsp;&nbsp;&nbsp;":"";  ?>
														<?php echo $cuentasiento->cuenta->nombre; ?>
													</td>
													<td class='text-right'><?php if($cuentasiento->debe) echo number_format((float)$cuentasiento->debe, 2, '.', ''); ?></td>
													<td class='text-right'><?php if($cuentasiento->haber) echo number_format((float)$cuentasiento->haber, 2, '.', ''); ?></td>
													<?php $d = $d + $cuentasiento->debe; $h = $h + $cuentasiento->haber; ?>
												</tr>	
											<?php endforeach; ?>
											<tr>
												<td></td>
												<td><i><?php echo $asiento->glosa; ?></i></td>
												<td class='text-right'><u><?php echo number_format((float)$d, 2, '.', ''); ?> </u></td>
												<td class='text-right'><u><?php echo number_format((float)$h, 2, '.', ''); ?> </u></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>	
					</div>
				</div>
			</article>
		</div>
	</section>

<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/asiento/report.js', CClientScript::POS_END);

?>

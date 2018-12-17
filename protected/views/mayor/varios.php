<?php
/* @var $this AsientoController */
/* @var $model Asiento */
$this->pageTitle = 'Libro Mayor por Cuentas';

?>
	<section id="widget-grid">
		<div class="row">
			<article class="col-md-12">
				<div class="jarviswidget jarviswidget-color-blue" id="widget1">
					<header></header>
					<div>
						<div class="widget-body">
							<p><i>Seleccione una cuenta y un Intervalo de fechas para generar el contenido del libro Mayor</i></p>
							<?php echo CHtml::beginForm(array('mayor/getVarios'),'post',array('class'=>'form-horizontal')); ?>
							<div class='row'>
								<div class='col-md-6 col-md-offset-2'>
									<div class="form-group">
										<label for='inicio' class='col-md-3 control-label'>FECHA INICIO</label>
										<div class='col-md-9'>
											<input type="datepicker" class="form-control datepicker"
													data-dateformat="dd-mm-yy" name="inicio"
													placeholder="dd/mm/aaaa"'
											value=<?php echo $inicio; ?> >
										</div>
									</div>
									<div class="form-group">
										<label for='fin' class='col-md-3 control-label'>FECHA FIN</label>
										<div class='col-md-9'>
											<input type="datepicker" class="form-control datepicker"
													data-dateformat="dd-mm-yy" name="fin"
													placeholder="dd/mm/aaaa"'
											value=<?php echo $fin; ?> >
										</div>
									</div>
									<div class="form-group">
										<label for='' class='col-md-3 control-label'>CUENTAS</label>
										<div class='col-md-9'>
											<select multiple name="codigos[]" style="width:100%" class="select2 form-control">
												<?php foreach($arrayCuentas as $cuenta): ?>
													<?php if($cuenta->nivel>3): ?>
														<option value="<?php echo $cuenta->codigo ?>" > <?php echo $cuenta->codigo." ".$cuenta->nombre; ?></option>
													<?php endif; ?>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div>
									<div>
										<?php echo CHtml::submitButton('Mostrar', array('class' => 'btn btn-primary')); ?>
									</div>
								</div>
							</div>
							<?php echo CHtml::endForm(); ?>
							<div id='report'>
								<?php if($codigos==''): ?>
									<br/><br/>
									<p><i></i></p>
									<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
								<?php else: ?>
									<table style='width:100%; margin: 0px -20px;' >
										<tr>
											<td class='ancho-15' ></td>
											<td><h3 class='text-center'>Libro Mayor</h3></td>
											<td class='ancho-15' >
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
									<?php foreach($arrayCuentas as $cuenta): ?>
										<?php if(in_array($cuenta->codigo,$codigos)): ?>
											<table class = "table table-bordered contable">
												<thead>
													<tr>
														<th colspan='6'> <h4 class='text-left'> <i> <?php echo $cuenta->codigo." ".$cuenta->nombre; ?> </i> </h4> </th>
													</tr>
													<tr>
														<th class='ancho-15'>FECHA</th>
														<th>DETALLE</th>
														<th class='ancho-5'># AS.</th>
														<th class='ancho-5'>DEBE</th>
														<th class='ancho-5'>HABER</th>
														<th class='ancho-10'>SALDO</th>
													</tr>
												</thead>
												<tbody>
													<?php $d = 0; $h = 0; $saldo=0?>
													<?php foreach($cuenta->cuentaAsientos as $cuentaasiento): ?>
														<?php if(($cuentaasiento->asiento->fecha >= $inicio) && ($cuentaasiento->asiento->fecha <= $fin)): ?>
															<?php $saldo+=$cuentaasiento->debe; $saldo-=$cuentaasiento->haber; ?>
															<tr>
																<td><?php echo date('d-m-Y',strtotime($cuentaasiento->asiento->fecha))?></td>
																<td><?php echo $cuentaasiento->asiento->glosa?></td>
																<td class='text-center'><?php echo $cuentaasiento->asiento->numero_asiento?></td>
																<td class='text-right'><?php if($cuentaasiento->debe) echo number_format((float)$cuentaasiento->debe, 2, '.', ''); ?></td> 
																<td class='text-right'><?php if($cuentaasiento->haber) echo number_format((float)$cuentaasiento->haber, 2, '.', ''); ?></td>
																<td class='text-right'><?php if($saldo) echo number_format((float)$saldo, 2, '.', ''); ?></td>
															</tr>
															<?php $d = $d + $cuentaasiento->debe; $h = $h + $cuentaasiento->haber; ?>
														<?php endif; ?>
													<?php endforeach; ?>
												</tbody>
												<tfoot>
													<tr>
														<td colspan='3' class='text-right'>TOTAL</td>
														<td class='text-right'><u><?php echo number_format((float)$d, 2, '.', ''); ?> </u></td>
														<td class='text-right'><u><?php echo number_format((float)$h, 2, '.', ''); ?> </u></td>
														<td></td>
													</tr>
												</tfoot>
											</table>
										<?php endif; ?>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
						</div>	
					</div>
				</div>
			</article>
		</div>
	</section>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/select2/select2.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/mayor/varios.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/mayor/report.js', CClientScript::POS_END);

?>
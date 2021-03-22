<?php
$this->pageTitle = 'Balance de Comprobacion de Sumas y Saldos';

?>
	<section id="widget-grid">
		<div class="row">
			<article class="col-md-12">
				<div class="jarviswidget jarviswidget-color-blue" id="widget1">
					<header></header>
					<div>
						<div class="widget-body">
							<?php echo CHtml::beginForm(array('eeff/balanceComprobacionSS'),'get'); ?>
							<div class = 'row' >
								<div class="col-md-3">
								</div>
								<div class="col-md-4">
									<label for='fin' class='col-md-2 control-label'>Fecha</label>
									<div class='col-md-10'>
										<input type="datepicker" class="form-control datepicker"
												data-dateformat="dd-mm-yy" name="fin"
												placeholder="dd/mm/aaaa"'
										value=<?php echo $fin; ?> >
									</div>
								</div>
								<div class = 'col-md-5'>
									<?php echo CHtml::submitButton('Mostrar', array('class' => 'btn btn-primary')); ?>
								</div>
							</div>
							<?php echo CHtml::endForm(); ?>
							<div id="report">
								<?php if(!$valid): ?>
									<br/><br/>
									<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
								<?php else: ?>
									<table style='width:100%; margin: 0px -20px;' >
										<tr>
											<td class='ancho-15' ></td>
											<td><h3 class='text-center'>Balance de Comprobacion de Sumas y Saldos</h3></td>
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
									<p class="text-center">(PRACTICADO A FECHA <?php echo date("d-m-Y",strtotime($fin)); ?>)</p>
									<table class = "table table-bordered contable">
										<thead>
											<tr>
												<th class='ancho-5' rowspan='2'>No</th>
												<th class='ancho-10' rowspan='2'>CODIGO</th>
												<th rowspan='2'>CUENTAS</th>
												<th class='' colspan='2'>SUMAS</th>
												<th class='' colspan='2'>SALDOS</th>
											</tr>
											<tr>
												<th class='ancho-10'>DEBITOS</th>
												<th class='ancho-10'>CREDITOS</th>
												<th class='ancho-10'>DEUDOR</th>
												<th class='ancho-10'>ACREEDOR</th>
											</tr>
										</thead>
										<tbody>
											<?php $cont = 1; $totalSumaDebe=0; $totalSumaHaber=0; $totalSaldoDebe=0; $totalSaldoHaber=0;  ?>
											<?php foreach($arrayCuentas as $cuenta): ?>
												<?php $debe=$cuenta->getSumaDebitos(); $haber=$cuenta->getSumaCreditos(); $saldo = $debe-$haber; ?>
												<?php if(!($debe==0 && $haber==0)): ?>
													<tr>
														<td><?=$cont++?></td>
														<td><?=$cuenta->codigo?></td>
														<td><?=$cuenta->nombre?></td>
														<td class='text-right'><?php if($debe>0) echo number_format((float)$debe, 2, '.', '');?></td>
														<td class='text-right'><?php if($haber>0) echo number_format((float)$haber, 2, '.', '');?></td>
														<td class='text-right'><?php if($saldo>=0) echo number_format((float)$saldo, 2, '.', ''); ?></td>
														<td class='text-right'><?php if($saldo<0) echo number_format((float)($saldo*(-1)), 2, '.', '');?></td>
														<?php
															$totalSumaDebe += $debe;
															$totalSumaHaber += $haber;
															if($saldo>=0)
																$totalSaldoDebe += $saldo;
															else
																$totalSaldoHaber += ($saldo*(-1));
														?>
													</tr>
												<?php endif; ?>
											<?php endforeach; ?>
										</tbody>
										<tfoot>
											<tr>
												<td class='text-right' colspan='3'>TOTALES</td>
												<td class='text-right'><?=number_format((float)$totalSumaDebe, 2, '.', '')?></td>
												<td class='text-right'><?=number_format((float)$totalSumaHaber, 2, '.', '')?></td>
												<td class='text-right'><?=number_format((float)$totalSaldoDebe, 2, '.', '')?></td> 
												<td class='text-right'><?=number_format((float)$totalSaldoHaber, 2, '.', '')?></td>
											</tr>
										</tfoot>
									</table>
								<?php endif;?>
							</div>
						</div>	
					</div>
				</div>
			</article>
		</div>
	</section>

<?php

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/mayor/report.js', CClientScript::POS_END);

?>
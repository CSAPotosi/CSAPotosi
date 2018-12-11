<?php

?>

<section id="widget-grid">
	<div class="row">
		<article class="col-md-12">
			<div class="jarviswidget jarviswidget-color-blue" id="widget1">
				<header></header>
				<div>
					<div class="widget-body">
						<div id="report">
							<div>
								<table style='width:100%; margin: 0px -20px;' >
									<tr>
										<td class='ancho-15' ></td>
										<td><h3 class='text-center'>Comprobante de <?php echo $asiento->getTipo($asiento->tipo);?></h3></td>
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
								<table class = 'table no-border'>
									<tr>
										<td class='ancho-10'><strong>FECHA:</strong></td>
										<td>Potosi <?php echo date("d-m-Y", strtotime($asiento->fecha)); ?></td>
										<td rowspan="3" class='ancho-10'>
											<span class="pull-right text-center">
												<?php echo $asiento->getTipo($asiento->tipo); ?>  No: <strong><?php echo $asiento->numero_comprobante ?></strong>
											</span>
										</td>
									</tr>
									<?php if($asiento->tipo<3): ?>
									<tr>
										<td><strong><?php echo ($asiento->tipo == 1)? 'RECIBIDO DE: ': 'PAGADO A: '; ?></strong></td>
										<td><?php echo $asiento->referencia; ?></td>
									</tr>
									<?php endif; ?>
									<tr>
										<td><strong>CONCEPTO:</strong></td>
										<td><?php echo $asiento->glosa ?></td>
									</tr>
								</table>
							</div>
							<table class = "table table-bordered contable">
								<thead>
									<tr>
										<th class='ancho-15'>CODIGO</th>
										<th>CUENTA</th>
										<th class='ancho-10'>DEBE</th>
										<th class='ancho-10'>HABER</th>
									</tr>
								</thead>
								<tbody>
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
								</tbody>
								<tfoot>
									<tr>
										<td colspan="2"> <span>SON: <?php echo $asiento->getLiteral($d);?></span> <span class='pull-right'>TOTALES</span></td>
										<td class='text-right'><u><?php echo number_format((float)$d, 2, '.', ''); ?> </u></td>
										<td class='text-right'><u><?php echo number_format((float)$h, 2, '.', ''); ?> </u></td>
									</tr>
								</tfoot>
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
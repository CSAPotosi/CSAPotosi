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
							<?php echo CHtml::beginForm(array('mayor/getIntervalo'),'get',array('class'=>'form-horizontal')); ?>
							<div class='row'>
								<div class='col-md-5 col-md-offset-1'>
									<div class="form-group">
										<label for='codigo1' class='col-md-2 control-label'>CUENTA #1</label>
										<div class="col-md-10">
											<?php echo CHtml::textField('codigo1', $codigo1,['class'=>'form-control codigoinput','placeholder'=>'Doble Click Aqui']); ?>
										</div>
									</div>
									<div class="form-group">
										<label for='codigo2' class='col-md-2 control-label'>CUENTA #2</label>
										<div class="col-md-10">
											<?php echo CHtml::textField('codigo2', $codigo2,['class'=>'form-control codigoinput','placeholder'=>'Doble Click Aqui']); ?>
										</div>
									</div>
								</div>
								<div class='col-md-5'>
									<div class="form-group">
										<label for='inicio' class='col-md-2 control-label'>FECHA INICIO</label>
										<div class='col-md-10'>
											<input type="datepicker" class="form-control datepicker"
													data-dateformat="dd-mm-yy" name="inicio"
													placeholder="dd/mm/aaaa"'
											value=<?php echo $inicio; ?> >
										</div>
									</div>
									<div class="form-group">
										<label for='fin' class='col-md-2 control-label'>FECHA FIN</label>
										<div class='col-md-10'>
											<input type="datepicker" class="form-control datepicker"
													data-dateformat="dd-mm-yy" name="fin"
													placeholder="dd/mm/aaaa"'
											value=<?php echo $fin; ?> >
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
								<?php if(!$valid): ?>
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
									<?php $flag=false; ?>
									<?php foreach($arrayCuentas as $cuenta): ?>
										<?php if($cuenta->codigo == $codigo1) $flag=true; ?>
										<?php if($flag && $cuenta->nivel > 3): ?>
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
														<?php if((date('d-m-Y',strtotime($cuentaasiento->asiento->fecha)) >= $inicio) && (date('d-m-Y',strtotime($cuentaasiento->asiento->fecha)) <= $fin)): ?>
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
										<?php if($cuenta->codigo == $codigo2) $flag=false; ?>
									<?php endforeach; ?>
								<?php endif; ?>
							</div>
						</div>	
					</div>
				</div>
			</article>
		</div>
	</section>
<div class="modal fade" id="modalListaCuenta"  role="dialog" >
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">PLAN DE CUENTAS</h4>
				<p>(Haga click sobre uno de los codigos en fondo verde para copiarlo en el formulario)</p>
			</div>
			<div class="modal-body">
				<table class="table table-bordered table-condensed">
					<thead>
					<tr>
						<th>CODIGO</th>
						<th>NOMBRE DE LA CUENTA</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($arrayCuentas as $item):	?>
							<tr>
								<td class="<?php echo ($item->nivel>3)?'bg-success id_cuenta':'';?>" data-idcuenta = "<?php echo $item->id_cuenta; ?>" id="<?php echo $item->codigo;?>" >
									<?php echo $item->codigo;?>
								</td>
								<td><?php echo $item->nombre;?></td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/mayor/intervalo.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/mayor/report.js', CClientScript::POS_END);

?>
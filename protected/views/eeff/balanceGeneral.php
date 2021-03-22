<?php
$this->pageTitle = 'Balance General';

?>
	<section id="widget-grid">
		<div class="row">
			<article class="col-md-12">
				<div class="jarviswidget jarviswidget-color-blue" id="widget1">
					<header></header>
					<div>
						<div class="widget-body">
							<?php echo CHtml::beginForm(array('eeff/balanceGeneral'),'get'); ?>
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
											<td><h3 class='text-center'>Balance General</h3></td>
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
									<table class = "table contable">
										<tbody>
											<?php $lista[] = null; ?>
											<?php foreach($cuentas as $cuenta): ?>
												<?php 
													while(end($lista))
													{
														$aux = end($lista);
														if($cuenta['nivel'] <= $aux['nivel']){
															$valor = ($aux['naturaleza'] == 1) ? $aux['sumtotalhaber'] : $aux['sumtotaldebe'];
															if($aux['nivel'] == 1)
																echo '<tr><td class="text-right">TOTAL &nbsp;&nbsp;'.$aux['nombre'].'</td><td style="width:5%"></td><td class="text-right"><u>'.number_format((float)$valor, 2, '.', '').'</u></td></tr>';
															if($aux['nivel'] == 2)
																echo '<tr><td class="text-right"><u>TOTAL &nbsp;&nbsp;'.$aux['nombre'].'</u></td><td style="width:5%"></td><td style="width:5%"></td><td class="text-right" style="width:5%"><u>'.number_format((float)$valor, 2, '.', '').'</u></td></tr>';
															array_pop($lista);
														}else
															break;
													}
													if($cuenta['nivel']<3){
														$lista[]=$cuenta;
													}
													if($cuenta['nivel'] <= 3){
														$valor = ($cuenta['naturaleza'] == 1) ? $cuenta['sumtotalhaber'] : $cuenta['sumtotaldebe'];
														echo '<tr><td>';
														if($cuenta['nivel'] == 1)
															echo '<strong class="lead">'.$cuenta['nombre'].'</strong>';
														if($cuenta['nivel'] == 2)
															echo '<strong class="lead">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$cuenta['nombre'].'</strong>';
														if($cuenta['nivel'] == 3)
														echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$cuenta['nombre'];
														echo '</td><td>'.number_format((float)$valor, 2, '.', '').'</td></tr>';
													}
												?>
											<?php endforeach;?>
										</tbody>
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
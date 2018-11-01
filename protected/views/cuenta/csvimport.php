<?php
$this->pageTitle = 'Importar Csv';
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
								<div class="form">
									<?php
									$form = $this->beginWidget('CActiveForm', array(
										'id'=>'service-form',
										'enableAjaxValidation'=>false,
										'method'=>'post',
										'htmlOptions'=>array(
											'enctype'=>'multipart/form-data',
											'class'=>'smart-form'
										)
									)); ?>

									<fieldset>
										
										<?php echo $form->errorSummary($model, 'Opps!!!', null, array('class'=>'alert alert-error span12')); ?>
										<div class="jumbotron">
											<p>
												<h2><i>Importar El Plan de Cuentas</i></h2>
											</p>
											<p>
												El Plan de cuentas debe ser exportado en un archivo en formato .csv 
											</p>
											<p>
												Este formato puedo ser editado con el programa Excel. Este es un ejemplo de un Plan de cuentas que puede importar:
												<?php echo CHtml::link('Descargar',array('cuenta/downloadCsv'), array('class'=>'btn btn-primary btn-sm')); ?>
											</p>
											<p>
												El sistema de codificacion debe ser el siguiente:
												<table class = 'table'>
													<tr>
														<td>1</td>
														<td>CLASE DE CUENTA</td>
														<td>De un digito</td>
													</tr>
													<tr>
														<td>11</td>
														<td>GRUPO</td>
														<td>De 2 digitos</td>
													</tr>
													<tr>
														<td>111</td>
														<td>SUB GRUPO</td>
														<td>De 3 digitos</td>
													</tr>
													<tr>
														<td>11101</td>
														<td>CUENTA MAYOR</td>
														<td>De 5 digitos</td>
													</tr>
													<tr>
														<td>1110101</td>
														<td>SUB CUENTA</td>
														<td>De 7 digitos</td>
													</tr>
													<tr>
														<td>111010101</td>
														<td>AUXILIAR</td>
														<td>De 9 digitos</td>
													</tr>
												</table>
											</p>
											<br />
										</div>
										
										<div class="form-group">
											<?php echo $form->labelEx($model,'file'); ?>
											
											<div class="input input-file">
												<span class="button">
													<?php echo $form->fileField($model,'file',array('class'=>'form-control', 'onchange'=>'document.getElementById("showfile").value = this.value.substring(12)')); ?>
													Examinar ...
												</span>
												<input type="text" id="showfile" placeholder="Especifica el archivo ..." readonly="">
											</div>
										</div>
									</fieldset>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<?php echo CHtml::submitButton('Importar', array('class' => 'btn btn-primary btn-lg')); ?>
						</div>
						<?php $this->endWidget(); ?>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>

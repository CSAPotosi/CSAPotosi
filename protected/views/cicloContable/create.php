<?php
$this->pageTitle = 'Iniciar Nuevo Ciclo Contable';
?>
<section id="widget-grid">
	<div class="row">
		<article class="col-md-12">
			<div class="jarviswidget jarviswidget-color-blue" id="widget1">
				<header></header>
				<div>
					<div class="widget-body">
						<?php if(!$ciclo->cicloActual()): ?>
							<div class="row">
								<div class="col-md-10 col-md-offset-1">
									<?php $form=$this->beginWidget('CActiveForm', array(
										'id'=>'ciclo-form',
										'htmlOptions' => array('autoComplete'=>'off'),
										'enableAjaxValidation'=>false,
									)); ?>
									<fieldset>
										<legend>Crear un Nuevo Ciclo Contable</legend>
										<?php echo CHtml::errorSummary($ciclo, '<h4 class="alert-heading"><i class="fa fa-warning"></i> DEBE CORREGIR LOS SIGUIENTES ERRORES </h4>', null, array('class' => 'alert alert-danger')); ?>

										<div class="form-group">
											<?php echo $form->labelEx($ciclo,'gestion'); ?>
											<?php echo $form->dropDownList($ciclo,'gestion', $ciclo->getAnios(), array('class'=>'form-control','empty'=>'')); ?>
											<?php echo $form->error($ciclo,'gestion',array('class'=>'label label-danger')); ?>
										</div>

										<div class="form-group">
											<?php echo $form->labelEx($ciclo,'dia_inicio'); ?>
											<input type="datepicker" class="form-control datepicker"
													data-dateformat="dd-mm-yy" name="CicloContable[dia_inicio]"
													placeholder="dd-mm-aaaa"'
											value="<?php echo $ciclo->dia_inicio ?>">
											<?php echo $form->error($ciclo,'dia_inicio',array('class'=>'label label-danger')); ?>
										</div>

										<div class="form-group">
											<?php echo $form->labelEx($ciclo,'descripcion'); ?>
											<?php echo $form->textArea($ciclo,'descripcion',array('rows'=>3, 'class'=>'form-control')); ?>
											<?php echo $form->error($ciclo,'descripcion',array('class'=>'label label-danger')); ?>
										</div>
									</fieldset>
								</div>
							</div>
							<div class="form-actions">
								<?php echo CHtml::submitButton('Crear', array('class' => 'btn btn-primary btn-lg')); ?>
							</div>
							<?php $this->endWidget(); ?>
						<?php else: ?>
						<div class="jumbotron text-center">
							<p>
								<h2><i>Ya esta en curso un ciclo contable</i></h2>
							</p>
							<p>
								Podra crear un nuevo ciclo contable despues de que haya hecho el asiento de cierre de la gestion actual
							</p>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>

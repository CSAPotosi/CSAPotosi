<?php
/* @var $this CuentaController */
/* @var $model Cuenta */
/* @var $form CActiveForm */
$this->pageTitle = 'Actualizar Cuenta';
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
								<?php $form=$this->beginWidget('CActiveForm', array(
									'id'=>'cuenta-form',
									'htmlOptions' => array('autoComplete'=>'off'),
									// Please note: When you enable ajax validation, make sure the corresponding
									// controller action is handling ajax validation correctly.
									// There is a call to performAjaxValidation() commented in generated controller code.
									// See class documentation of CActiveForm for details on this.
									'enableAjaxValidation'=>false,
								)); ?>
								<fieldset>
									<legend>Actualizar Cuenta</legend>
									<?php echo CHtml::errorSummary($model, '<h4 class="alert-heading"><i class="fa fa-warning"></i> DEBE CORREGIR LOS SIGUIENTES ERRORES </h4>', null, array('class' => 'alert alert-danger')); ?>
									<p class="note">Los Campos con <span class="required">*</span> son requeridos.</p>

									<div class="form-group">
										<?php echo $form->labelEx($model,'codigo'); ?>
										<?php echo $form->textField($model,'codigo',array('maxlength'=>16, 'class'=>'form-control', 'disabled'=>'disabled')); ?>
										<?php echo $form->error($model,'codigo',array('class'=>'label label-danger')); ?>
									</div>

									<div class="form-group">
										<?php echo $form->labelEx($model,'nombre'); ?>
										<?php echo $form->textField($model,'nombre',array('maxlength'=>128, 'class'=>'form-control')); ?>
										<?php echo $form->error($model,'nombre',array('class'=>'label label-danger')); ?>
									</div>

									<div class="form-group">
										<?php echo $form->labelEx($model,'descripcion'); ?>
										<?php echo $form->textArea($model,'descripcion',array('rows'=>3, 'class'=>'form-control')); ?>
										<?php echo $form->error($model,'descripcion',array('class'=>'label label-danger')); ?>
									</div>

									<div class="form-group">
										<?php echo $form->labelEx($model,'cuenta_superior'); ?>
										<?php echo $form->dropDownList($model,'cuenta_superior', $cuentasuperiorlist, array('class'=>'form-control','empty'=>'', 'disabled'=>'disabled')); ?>
										<?php echo $form->error($model,'cuenta_superior',array('class'=>'label label-danger')); ?>
									</div>

									<div class="form-group">
										<?php echo $form->labelEx($model,'naturaleza'); ?> <span class="note"> <a href="" >(Cambiar)</a> </span>
										<?php echo $form->dropDownList($model,'naturaleza', $model->getTipos() ,array('class'=>'form-control','empty'=>'', 'disabled'=>'disabled')); ?>
										<?php echo $form->error($model,'naturaleza',array('class'=>'label label-danger')); ?>
									</div>
								</fieldset>
							</div>
						</div>
						<div class="form-actions">
							<?php echo CHtml::submitButton('Guardar', array('class' => 'btn btn-primary btn-lg')); ?>
						</div>
						<?php $this->endWidget(); ?>
					</div>
				</div>
			</div>
		</article>
	</div>
</section>

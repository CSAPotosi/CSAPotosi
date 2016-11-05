<?php
/* @var $this EntidadController */
/* @var $model Entidad */
/* @var $form CActiveForm */
?>

<?php echo CHtml::beginForm(); ?>
<fieldset>
	<legend>ENTIDAD</legend>
	<?php echo CHtml::errorSummary($modelEntidad, '<h4 class="alert-heading"><i class="fa fa-warning"></i> DEBE CORREGIR LOS SIGUIENTES ERRORES </h4>', null, array('class' => 'alert alert-danger')); ?>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<?php echo CHtml::activeLabelEx($modelEntidad, 'razon_social'); ?>
				<?php echo CHtml::activeTextField($modelEntidad, 'razon_social', array('class' => 'form-control', 'placeholder' => 'Razon Social')); ?>
				<?php echo CHtml::error($modelEntidad, 'razon_social', array('class' => 'label label-danger')); ?>
			</div>
			<div class="form-group">
				<?php echo CHtml::activeLabelEx($modelEntidad, 'nit'); ?>
				<?php echo CHtml::activeTextField($modelEntidad, 'nit', array('class' => 'form-control', 'placeholder' => 'NIT')); ?>
				<?php echo CHtml::error($modelEntidad, 'nit', array('class' => 'label label-danger')); ?>
			</div>
			<div class="form-group">
				<?php echo CHtml::activeLabelEx($modelEntidad, 'direccion'); ?>
				<?php echo CHtml::activeTextField($modelEntidad, 'direccion', array('class' => 'form-control', 'placeholder' => 'Direccion')); ?>
				<?php echo CHtml::error($modelEntidad, 'direccion', array('class' => 'label label-danger')); ?>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<?php echo CHtml::activeLabelEx($modelEntidad, 'telefono'); ?>
				<?php echo CHtml::activeTextField($modelEntidad, 'telefono', array('class' => 'form-control', 'placeholder' => 'Telefono')); ?>
				<?php echo CHtml::error($modelEntidad, 'telefono', array('class' => 'label label-danger')); ?>
			</div>
			<div class="form-group">
				<?php echo CHtml::activeLabelEx($modelEntidad, 'tipo_entidad'); ?>
				<?php echo CHtml::activeDropDownList($modelEntidad, 'tipo_entidad', array('1' => 'INTERNO', '2' => 'EXTERNO'), array('class' => 'form-control', 'placeholder' => 'Tipo Entidad')); ?>
				<?php echo CHtml::error($modelEntidad, 'tipo_entidad', array('class' => 'label label-danger')); ?>
			</div>
			<div class="form-group">
				<?php echo CHtml::activeLabelEx($modelEntidad, 'naturaleza_juridica'); ?>
				<?php echo CHtml::activeDropDownList($modelEntidad, 'naturaleza_juridica', array('1' => 'NATURAL', '2' => 'JURIDICO'), array('class' => 'form-control', 'placeholder' => 'Naturaleza Juridica')); ?>
				<?php echo CHtml::error($modelEntidad, 'naturaleza_juridica', array('class' => 'label label-danger')); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">

		</div>
	</div>
</fieldset>
<div class="form-actions">
	<?php echo CHtml::submitButton('Crear', array('class' => 'btn btn-primary btn-lg')); ?>
</div>
<?php echo CHtml::endForm(); ?>

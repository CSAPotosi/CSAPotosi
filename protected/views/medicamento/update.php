<a href="<?php echo CHtml::normalizeUrl(['medicamento/download'])?>" class="btn btn-primary">
	Descargar Archivo
	<i class="fa fa-download"></i>
</a>

<?php echo CHtml::beginForm(['medicamento/upload'],'post',['enctype'=>'multipart/form-data']);?>
	<?php echo CHtml::activeLabel($uploadModel,'medExcel');?>
	<?php echo CHtml::activeFileField($uploadModel,'medExcel');?>
	<?php echo CHtml::error($uploadModel,'medExcel')?>

	<?php echo CHtml::submitButton('Enviar')?>
<?php echo CHtml::endForm();?>

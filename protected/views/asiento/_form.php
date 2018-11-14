<div class="form">

<?php echo CHtml::beginForm(["asiento/create"],"post"); ?>

<?php echo CHtml::errorSummary(array_merge([$asiento],$cuentas),'Para poder continuar debito corregir los siguientes problemas:',null,['class'=>'alert alert-danger']);?>

<div class="form-group">
	<div class="row">
		<div class="col-md-3">
			<label>Fecha</label>
			<input type="datepicker" class="form-control datepicker"
					data-dateformat="dd/mm/yy" name="Asiento[fecha]"
					placeholder="dd/mm/aaaa"'
			value="<?php echo $asiento->fecha ?>">
			<?php echo CHtml::error($asiento, 'fecha', ['class' => 'label label-danger error-message']); ?>
		</div>
		<div class="col-md-9">
			<?php if($asiento->tipo < 3): ?>
				<label for="Asiento_referencia"> <?php echo ($asiento->tipo == 1)? 'Recibido de:': 'Pagado A:'; ?> </label>
				<?php echo CHtml::activeTextField($asiento,'referencia',array('maxlength'=>128,'class'=>'form-control')); ?>
				<?php echo CHtml::error($asiento,'referencia'); ?>
			<?php endif; ?>
		</div>
	</div>
	
</div>

<div class="form-group">
	<label for="Asiento_glosa" class = required> Glosa </label>
	<?php echo CHtml::activeHiddenField($asiento,'tipo',array('class'=>'form-control', 'value'=>$asiento->tipo));?>
	<?php echo CHtml::activeTextArea($asiento,'glosa',array('maxlength'=>255,'class'=>'form-control','rows'=>1)); ?>
	<?php echo CHtml::error($asiento,'glosa'); ?>
</div>


<?php echo CHtml::label('Detalle',null);?>
<table class="table table-bordered" id="DetalleDeCuentas">
	<thead>
		<tr>
			<th>CODIGO</th>
			<th style="width:60%;">CUENTA</th>
			<th>DEBE</th>
			<th>HABER</th>
		</tr>
	</thead>
	<tbody>
		<?php $index=0; $cuentaasiento= new CuentaAsiento();?>
		<?php foreach($cuentas as $itemcuenta):?>
			<tr data-index="<?php echo $index;?>">
				<td class="contenedor" style="padding:1px;">
					<?php echo CHtml::activeHiddenField($itemcuenta,"[$index]id_cuenta",['class'=>'form-control']);?>
					<?php echo CHtml::textField('codigocuenta',($itemcuenta->id_cuenta!=null)?$itemcuenta->idCuenta->codigo:'',['class'=>'form-control codigoinput']); ?>
					<?php echo CHtml::error($itemcuenta,"[$index]id_cuenta",['class'=>'label label-danger']);?>
				</td>
				<td style="padding:1px;"><?php echo CHtml::textField('nombrecuenta',($itemcuenta->id_cuenta!=null)?$itemcuenta->idCuenta->nombre:'',['class'=>'form-control text-med']); ?></td>
				<td style="padding:1px;"><?php echo CHtml::activeTextField($itemcuenta,"[$index]debe",['class'=>'form-control debito']); echo CHtml::error($itemcuenta,"[$index]debito",['class'=>'label label-danger']);?></td>
				<td style="padding:1px;"><?php echo CHtml::activeTextField($itemcuenta,"[$index]haber",['class'=>'form-control credito']); echo CHtml::error($itemcuenta,"[$index]credito",['class'=>'label label-danger']);?></td>
			</tr>
			<?php $index++;?>
		<?php endforeach;?>
		<?php if($index==0): ?>
			<tr  data-index="<?php echo $index;?>">
				<td style="padding:1px;">
					<?php echo CHtml::activeHiddenField($cuentaasiento,"[$index]id_cuenta",['class'=>'form-control']);?>
					<?php echo CHtml::textField('codigocuenta',null,['class'=>'form-control codigoinput','placeholder'=>'Doble Click Aqui']); ?>
				</td>
				<td style="padding:1px;"><?php echo CHtml::textField('nombrecuenta',null,['class'=>'form-control text-nom']); ?></td>
				<td style="padding:1px;"><?php echo CHtml::activeTextField($cuentaasiento,"[$index]debe",['class'=>'form-control debito']);?></td>
				<td style="padding:1px;"><?php echo CHtml::activeTextField($cuentaasiento,"[$index]haber",['class'=>'form-control credito']);?></td>
			</tr>
		<?php endif; ?>
	</tbody>
	<tfoot>
		<tr>
			<td>
				<button type="button" class="btn btn-info btn-sm" id="btn-add-cuentavalor"><i class="fa fa-plus"></i></button>
				<button type="button" class="btn btn-info btn-sm" id="btn-remove-cuentavalor"><i class="fa fa-minus"></i></button>
			</td>
			<td><p class="pull-right">TOTAL</p></td>
			<td><p id="debitos">0</p></td>
			<td><p id="creditos">0</p></td>
		</tr>
	</tfoot>
</table>

<div class="form-actions">
	<?php echo CHtml::submitButton($asiento->isNewRecord ? 'Registrar Asiento' : 'Modificar',array("class"=>"btn btn-lg btn-primary")); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->


<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/asiento/registrarasiento.js', CClientScript::POS_END);

?>
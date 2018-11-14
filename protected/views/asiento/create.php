<?php

$this->pageTitle = 'Asiento Contable No: '.$asiento->numero_asiento;
?>

<section id="widget-grid">
	<div class="row">
		<article class="col-md-12">
			<div class="jarviswidget jarviswidget-color-blue" id="widget1">
				<header></header>
				<div>
					<div class="widget-body">
						<fieldset>
							<legend>Registro de <?php echo $asiento->getTipo($asiento->tipo); ?></legend>
								<div class="row">
									<div class="col-md-12">
										<spam style="border: 1px solid;padding: 5px;" class="pull-right"><strong>Comprobante <?php echo $asiento->getTipo($asiento->tipo); ?>  No: <?php echo $asiento->numero_comprobante ?></strong></spam>
									</div>
								</div>
						</fieldset>
						<fieldset>
								<?php $this->renderPartial('_form', array('asiento'=>$asiento,'cuentas'=>$cuentas)); ?>
						</fieldset>
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
				<p>(Haga click sobre uno de los codigos para que se copie en el formulario)</p>
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
								<td class="id_cuenta" data-idcuenta = "<?php echo $item->id_cuenta; ?>" id="<?php echo $item->codigo;?>">
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

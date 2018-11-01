<?php
/* @var $this CuentaController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = 'Administrar Plan de Cuentas';
?>
	<section id="widget-grid">
		<div class="row">
			<article class="col-md-12">
				<div class="jarviswidget jarviswidget-color-blue" id="widget1">
					<header></header>
					<div>
						<div class="widget-body">

							<table id="plan-contable" class="table table-bordered table-condensed">
								<caption>
									<a href="#" onclick="jQuery('#plan-contable').treetable('expandAll'); return false;">Expand all</a>
									<a href="#" onclick="jQuery('#plan-contable').treetable('collapseAll'); return false;">Collapse all</a>
								</caption>
								<thead>
								<tr>
									<th>CODIGO</th>
									<th>NOMBRE DE LA CUENTA</th>
									<th style="width: 15%;">ACCIONES</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($arrayCuentas as $item):	?>
									<tr data-tt-id='<?php echo $item->id_cuenta;?>' data-tt-parent-id='<?php echo $item->cuenta_superior;?>' class="<?php if(isset($_GET["cuenta"])) echo ($_GET["cuenta"]==$item->id_cuenta)?"selected":"" ?>">
										<td>
											<?php if (isset($_GET["superior"])) echo ($_GET["superior"]==$item->id_cuenta)?"<a name='ancla'> </a>":""; ?>
											<?php echo $item->codigo;?>
										</td>
										<td><?php echo $item->nombre;?></td>
										<td>
											<a href="<?php echo $this->createAbsoluteUrl('cuenta/view', array('id' => $item->id_cuenta));?>" class="btn btn-default btn-xs"><label class="fa fa-eye"></label></a>
											<a href="<?php echo $this->createAbsoluteUrl('cuenta/update', array('id' => $item->id_cuenta));?>" class="btn btn-info btn-xs"><label class="fa fa-pencil"></label></a>
											<?php if($item->nivel<6): ?>
												<a href="<?php echo $this->createAbsoluteUrl('cuenta/create', array('id' => $item->id_cuenta));?>" class="btn btn-primary btn-xs"><label class="fa fa-plus"></label></a>
											<?php endif; ?>
											<a href="<?php echo $this->createAbsoluteUrl('cuenta/disabled', array('id' => $item->id_cuenta));?>" class="btn btn-danger btn-xs borrado"><label class="fa fa-trash-o"></label></a>
										</td>
									</tr>
								<?php endforeach;?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</article>
		</div>
	</section>

<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/resources/js/plugin/treetable/jquery.treetable.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/resources/js/plugin/treetable/jquery.treetable.theme.default.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/treetable/jquery.treetable.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/cuenta/admin.js', CClientScript::POS_END);

?>

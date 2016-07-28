<?php
/* @var $this CieController */

$this->breadcrumbs=array(
	'CIE 10',
);

$this->pageTitle = 'CIE 10';
?>

<section id="widget-grid">
	<div class="row">
		<div class="col-md-12">
			<div class="jarviswidget" id="cie-widget">
				<header></header>
				<div>
					<div class="widget-body">
						<form>
							<div class="form-group">
								<?php echo CHtml::label('CAPITULO','cie-cap-select');?>
								<?php echo CHtml::dropDownList('cie-cap-select',null,CHtml::listData(CapituloCie::model()->findAll(),'num_cap','titulo_cap'),['class'=>'form-control','style'=>'width:100%','data-url'=>CHtml::normalizeUrl(['cie/getCategoryAjax'])]); ?>
							</div>

							<div class="form-group">
								<?php echo CHtml::label('CATEGORIA','cie-cat-select');?>
								<?php echo CHtml::dropDownList('cie-cat-select',null,[],['class'=>'form-control','style'=>'width:100%','data-url'=>CHtml::normalizeUrl(['cie/getGroupAjax'])]); ?>
							</div>

							<div class="form-group">
								<?php echo CHtml::label('GRUPO','cie-group-select');?>
								<?php echo CHtml::dropDownList('cie-group-select',null,[],['class'=>'form-control','style'=>'width:100%','data-url'=>CHtml::normalizeUrl(['cie/getItemAjax'])]); ?>
							</div>
						</form>

						<label for="item-cie-table">ITEM</label>
						<div class="table-responsive" id="cie-item-table">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<td colspan="3">
											<div class="form-group has-feedback no-margin">
												<input type="text" class="form-control" placeholder="Escriba Codigo, titulo o descripcion para buscar" id="search-item">
												<span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
											</div>
										</td>
									</tr>
									<tr>
										<th width="10%">Codigo</th>
										<th width="80%">Titulo</th>
										<th width="10%"></th>
									</tr>
								</thead>
								<tbody>
								<tr>
									<td>&nbsp;</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td></td>
									<td></td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modal-detail-cie" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title">Modal</h4>
			</div>
			<div class="modal-body">
				hola mundo
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Cerrar
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<?php 	Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/select2/select2.min.js',CClientScript::POS_END)
	->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/x-editable/x-editable.min.js',CClientScript::POS_END)
	->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/cie/index.js',CClientScript::POS_END);
?>

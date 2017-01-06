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
			<div class="jarviswidget jarviswidget-color-blue" id="cie-widget">
				<header></header>
				<div>
					<div class="widget-body">
						<?php $this->renderPartial('_cie');?>
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

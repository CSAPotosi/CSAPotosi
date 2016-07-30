<section id="widget-grid">
	<div class="row">
		<div class="col-md-12">
			<div class="jarviswidget" id="widget-index">
				<header></header>
				<div>
					<div class="widget-body">
						<div class="widget-body-toolbar text-right">
							<div class="row category-new-form <?php echo ($catExModel->hasErrors())?'hidden':''; ?> ">
								<div class="col-md-12">
									<button class="btn btn-primary btn-new-category">Nuevo</button>
								</div>
							</div>

							<div class="row category-new-form <?php echo ($catExModel->hasErrors())?'':'hidden'; ?>">
								<?php echo CHtml::beginForm(['categoriaServicio/create','tipo'=>$tipo],'post');?>
									<div class="col-md-2">
										<?php echo CHtml::activeTextField($catExModel,'cod_cat_ex',['class'=>'form-control','placeholder'=>'CODIGO']);?>
										<?php echo CHtml::error($catExModel,'cod_cat_ex',['class'=>'label label-danger'])?>
									</div>
									<div class="col-md-3">
										<?php echo CHtml::activeTextField($catExModel,'nombre_cat_ex',['class'=>'form-control','placeholder'=>'NOMBRE']);?>
										<?php echo CHtml::error($catExModel,'nombre_cat_ex',['class'=>'label label-danger'])?>
									</div>
									<div class="col-md-3">
										<?php echo CHtml::activeTextField($catExModel,'descripcion_cat_ex',['class'=>'form-control','placeholder'=>'DESCRIPCION']);?>
										<?php echo CHtml::error($catExModel,'descripcion_cat_ex',['class'=>'label label-danger'])?>
									</div>
									<div class="col-md-1">
										<span class="onoffswitch">
											<?php echo CHtml::activeCheckBox($catExModel,'activo',['class'=>'onoffswitch-checkbox']);?>
											<?php echo CHtml::activeLabel($catExModel,'activo',['class'=>'onoffswitch-label','label'=>'<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span><span class="onoffswitch-switch"></span>']);?>
										</span>
									</div>
									<div class="col-md-3">
										<?php echo CHtml::activeHiddenField($catExModel,'tipo_ex',['value'=>$tipo]);?>
										<button class="btn btn-danger btn-cancel-category" type="button">Cancelar</button>
										<button class="btn btn-primary btn-submit-category" type="submit">Guardar</button>
									</div>
								<?php echo CHtml::endForm();?>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-2">
										<strong>CODIGO</strong>
									</div>
									<div class="col-md-3">
										<strong>NOMBRE</strong>
									</div>
									<div class="col-md-4">
										<strong>DESCRIPCION</strong>
									</div>
									<div class="col-md-2">
										<strong>ACTIVO</strong>
									</div>
									<div class="col-md-1">

									</div>
								</div>
							</div>
							<ul class="list-group no-margin">
								<?php foreach ($catExList as $catExItem): ?>
									<li class="list-group-item">
										<div class="row category-detail">
											<div class="col-md-2">
												<?php echo $catExItem->cod_cat_ex; ?>
											</div>
											<div class="col-md-3">
												<?php echo $catExItem->nombre_cat_ex; ?>
											</div>
											<div class="col-md-4">
												<?php echo $catExItem->descripcion_cat_ex; ?>
											</div>
											<div class="col-md-2">
												<span class="onoffswitch">
													<input type="checkbox" name="nuevo" class="onoffswitch-checkbox" id="check<?php echo $catExItem->id_cat_ex;?>" <?php echo ($catExItem->activo)?'checked':''; ?>>
													<label class="onoffswitch-label" for="check<?php echo $catExItem->id_cat_ex;?>">
														<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span>
														<span class="onoffswitch-switch"></span>
													</label>
												</span>
											</div>
											<div class="col-md-1">
												<button type="button" class="btn btn-primary btn-xs btn-edit-category">
													<i class="fa fa-edit"></i>
													Editar
												</button>
											</div>
										</div>
										<div class="row hidden category-form">
											<form action="">
												<div class="col-md-2">
													<?php echo CHtml::activeTextField($catExItem,'cod_cat_ex',['class'=>'form-control']);?>
													<?php echo CHtml::error($catExItem,'cod_cat_ex',['class'=>'label label-danger'])?>
												</div>
												<div class="col-md-3">
													<?php echo CHtml::activeTextField($catExItem,'nombre_cat_ex',['class'=>'form-control']);?>
													<?php echo CHtml::error($catExItem,'nombre_cat_ex',['class'=>'label label-danger'])?>
												</div>
												<div class="col-md-3">
													<?php echo CHtml::activeTextField($catExItem,'descripcion_cat_ex',['class'=>'form-control']);?>
													<?php echo CHtml::error($catExItem,'descripcion_cat_ex',['class'=>'label label-danger'])?>
												</div>
												<div class="col-md-1">
													<span class="onoffswitch">
														<?php echo CHtml::activeCheckBox($catExItem,'activo',['class'=>'onoffswitch-checkbox']);?>
														<?php echo CHtml::activeLabel($catExItem,'activo',['class'=>'onoffswitch-label','label'=>'<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span><span class="onoffswitch-switch"></span>']);?>
													</span>
												</div>
												<div class="col-md-3 text-align-right">
													<button class="btn btn-danger btn-cancel-category" type="button">Cancelar</button>
													<button class="btn btn-primary btn-submit-category" type="submit">Guardar</button>
												</div>
											</form>
										</div>
									</li>
								<?php endforeach;?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/categoriaServicio/categoriaExamenIndex.js',CClientScript::POS_END);
?>
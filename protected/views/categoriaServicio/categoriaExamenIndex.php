<section id="widget-grid">
	<div class="row">
		<div class="col-md-12">
			<div class="jarviswidget jarviswidget-color-blue" id="widget-index">
				<header></header>
				<div>
					<div class="widget-body">
						<div class="widget-body-toolbar text-right">
							<div class="row category-new-form">
								<div class="col-md-12">
									<button class="btn btn-primary btn-new-category">Nuevo</button>
								</div>
							</div>

							<div class="row category-new-form hidden">
								<?php
									$form = $this->beginWidget('CActiveForm',[
										'action'=>['categoriaServicio/create','grupo'=>$dataUrl['grupo'],'tipo'=>$dataUrl['tipo']],
										'enableAjaxValidation'=>true,
										'clientOptions'=>[
											'validateOnSubmit'=>true,
											'validateOnChange'=>false
										]
									]);
								?>

								<div class="col-md-4">
										<?php echo $form->textField($catExModel,'nombre_cat_ex',['class'=>'form-control','placeholder'=>'NOMBRE']);?>
										<?php echo $form->error($catExModel,'nombre_cat_ex',['class'=>'label label-danger'])?>
									</div>
								<div class="col-md-4">
										<?php echo $form->textField($catExModel,'descripcion_cat_ex',['class'=>'form-control','placeholder'=>'DESCRIPCION']);?>
										<?php echo $form->error($catExModel,'descripcion_cat_ex',['class'=>'label label-danger'])?>
									</div>
									<div class="col-md-1">
										<span class="onoffswitch">
											<?php echo $form->checkBox($catExModel,'activo',['class'=>'onoffswitch-checkbox']);?>
											<?php echo $form->label($catExModel,'activo',['class'=>'onoffswitch-label','label'=>'<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span><span class="onoffswitch-switch"></span>']);?>
										</span>
									</div>
									<div class="col-md-3">
										<?php echo $form->hiddenField($catExModel,'tipo_ex',['value'=>$dataUrl['tipo']]);?>
										<button class="btn btn-danger btn-cancel-category" type="reset">Cancelar</button>
										<button class="btn btn-primary btn-submit-category" type="submit">Guardar</button>
									</div>
								<?php $this->endWidget(); ?>
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
													<input type="checkbox" name="nuevo" class="onoffswitch-checkbox update-active-category" id="check<?php echo $catExItem->id_cat_ex;?>" <?php echo ($catExItem->activo)?'checked':''; ?>>
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
											<?php
											$form = $this->beginWidget('CActiveForm',[
												'action'=>['categoriaServicio/update','grupo'=>$dataUrl['grupo'], 'tipo'=>$dataUrl['tipo'], 'id'=>$catExItem->id_cat_ex],
												'enableAjaxValidation'=>true,
												'clientOptions'=>[
													'validateOnSubmit'=>true,
													'validateOnChange'=>false
												]
											]);
											?>
												<div class="col-md-2">
													<?php echo $form->textField($catExItem,'cod_cat_ex',['class'=>'form-control']);?>
													<?php echo $form->error($catExItem,'cod_cat_ex',['class'=>'label label-danger']);?>
												</div>
												<div class="col-md-3">
													<?php echo $form->textField($catExItem,'nombre_cat_ex',['class'=>'form-control']);?>
													<?php echo $form->error($catExItem,'nombre_cat_ex',['class'=>'label label-danger']);?>
												</div>
												<div class="col-md-3">
													<?php echo $form->textField($catExItem,'descripcion_cat_ex',['class'=>'form-control']);?>
												</div>
												<div class="col-md-1">
													<span class="onoffswitch">
														<?php echo $form->checkBox($catExItem,'activo',['class'=>'onoffswitch-checkbox', 'id'=>'activo_'.$catExItem->id_cat_ex]);?>
														<?php echo $form->label($catExItem,'activo',['for'=>'activo_'.$catExItem->id_cat_ex ,'class'=>'onoffswitch-label','label'=>'<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span><span class="onoffswitch-switch"></span>']);?>
													</span>
												</div>
												<div class="col-md-3 text-align-right">
													<button class="btn btn-danger btn-cancel-category" type="reset">Cancelar</button>
													<button class="btn btn-primary btn-submit-category" type="submit">Guardar</button>
												</div>
											<?php $this->endWidget(); ?>
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




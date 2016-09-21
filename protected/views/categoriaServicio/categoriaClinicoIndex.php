<section id="widget-grid">
    <div class="row">
        <div class="col-md-12">
            <div class="jarviswidget" id="widget-index">
                <header>Categoria Servicio Clinico</header>
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
                                $form = $this->beginWidget('CActiveForm', [
                                    'action' => ['categoriaServicio/create', 'grupo' => $dataUrl['grupo']],
                                    'enableAjaxValidation' => true,
                                    'clientOptions' => [
                                        'validateOnSubmit' => true,
                                        'validateOnChange' => false
                                    ]
                                ]);
                                ?>
                                <div class="col-md-2">
                                    <?php echo $form->textField($catCliModel, 'cod_cat_cli', ['class' => 'form-control', 'placeholder' => 'CODIGO']); ?>
                                    <?php echo $form->error($catCliModel, 'cod_cat_cli', ['class' => 'label label-danger']); ?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->textField($catCliModel, 'nombre_cat_cli', ['class' => 'form-control', 'placeholder' => 'NOMBRE']); ?>
                                    <?php echo $form->error($catCliModel, 'nombre_cat_cli', ['class' => 'label label-danger']) ?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->textField($catCliModel, 'descripcion_cat_cli', ['class' => 'form-control', 'placeholder' => 'DESCRIPCION']); ?>
                                    <?php echo $form->error($catCliModel, 'descripcion_cat_cli', ['class' => 'label label-danger']) ?>
                                </div>
                                <div class="col-md-1">
										<span class="onoffswitch">
											<?php echo $form->checkBox($catCliModel, 'activo', ['class' => 'onoffswitch-checkbox']); ?>
                                            <?php echo $form->label($catCliModel, 'activo', ['class' => 'onoffswitch-label', 'label' => '<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span><span class="onoffswitch-switch"></span>']); ?>
										</span>
                                </div>
                                <div class="col-md-3">
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
                                <?php foreach ($catCliList as $catCliItem): ?>
                                    <li class="list-group-item">
                                        <div class="row category-detail">
                                            <div class="col-md-2">
                                                <?php echo $catCliItem->cod_cat_cli; ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?php echo $catCliItem->nombre_cat_cli; ?>
                                            </div>
                                            <div class="col-md-4">
                                                <?php echo $catCliItem->descripcion_cat_cli; ?>
                                            </div>
                                            <div class="col-md-2">
												<span class="onoffswitch">
													<input type="checkbox" name="nuevo"
                                                           class="onoffswitch-checkbox update-active-category"
                                                           id="check<?php echo $catCliItem->id_cat_cli; ?>" <?php echo ($catCliItem->activo) ? 'checked' : ''; ?>>
													<label class="onoffswitch-label"
                                                           for="check<?php echo $catCliItem->id_cat_cli; ?>">
                                                        <span class="onoffswitch-inner" data-swchon-text="SI"
                                                              data-swchoff-text="NO"></span>
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
                                            $form = $this->beginWidget('CActiveForm', [
                                                'action' => ['categoriaServicio/update', 'grupo' => $dataUrl['grupo'], 'id' => $catCliItem->id_cat_cli],
                                                'enableAjaxValidation' => true,
                                                'clientOptions' => [
                                                    'validateOnSubmit' => true,
                                                    'validateOnChange' => false
                                                ]
                                            ]);
                                            ?>
                                            <div class="col-md-2">
                                                <?php echo $form->textField($catCliItem, 'cod_cat_cli', ['class' => 'form-control']); ?>
                                                <?php echo $form->error($catCliItem, 'cod_cat_cli', ['class' => 'label label-danger']); ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?php echo $form->textField($catCliItem, 'nombre_cat_cli', ['class' => 'form-control']); ?>
                                                <?php echo $form->error($catCliItem, 'nombre_cat_cli', ['class' => 'label label-danger']); ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?php echo $form->textField($catCliItem, 'descripcion_cat_cli', ['class' => 'form-control']); ?>
                                            </div>
                                            <div class="col-md-1">
													<span class="onoffswitch">
														<?php echo $form->checkBox($catCliItem, 'activo', ['class' => 'onoffswitch-checkbox', 'id' => 'activo_' . $catCliItem->id_cat_cli]); ?>
                                                        <?php echo $form->label($catCliItem, 'activo', ['for' => 'activo_' . $catCliItem->id_cat_cli, 'class' => 'onoffswitch-label', 'label' => '<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span><span class="onoffswitch-switch"></span>']); ?>
													</span>
                                            </div>
                                            <div class="col-md-3 text-align-right">
                                                <button class="btn btn-danger btn-cancel-category" type="reset">
                                                    Cancelar
                                                </button>
                                                <button class="btn btn-primary btn-submit-category" type="submit">
                                                    Guardar
                                                </button>
                                            </div>
                                            <?php $this->endWidget(); ?>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/categoriaServicio/categoriaClinicoIndex.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/categoriaServicio/categoriaClinicoIndex.js', CClientScript::POS_END);
?>

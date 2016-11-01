<section id="widget-grid">
    <div class="row">
        <div class="col-md-12">
            <div class="jarviswidget" id="widget-index">
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
                                $form = $this->beginWidget('CActiveForm', [
                                    'action' => ['convenio/createConvenio'],
                                    'enableAjaxValidation' => true,
                                    'clientOptions' => [
                                        'validateOnSubmit' => true,
                                        'validateOnChange' => false
                                    ]
                                ]);
                                ?>
                                <div class="col-md-4">
                                    <?php echo $form->textField($modelConvenio, 'nombre_convenio', ['class' => 'form-control', 'placeholder' => 'NOMBRE CONVENIO QUE SE HIZO CON LA INSTITUCION']); ?>
                                    <?php echo $form->error($modelConvenio, 'nombre_convenio', ['class' => 'label label-danger']); ?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo $form->dropDownList($modelConvenio, 'id_entidad', $modelConvenio->getEntidad(), ['class' => 'form-control']); ?>
                                    <?php echo $form->error($modelConvenio, 'nombre_cat_ex', ['class' => 'label label-danger']) ?>
                                </div>
                                <div class="col-md-2">
										<span class="onoffswitch">
											<?php echo $form->checkBox($modelConvenio, 'activo', ['class' => 'onoffswitch-checkbox']); ?>
                                            <?php echo $form->label($modelConvenio, 'activo', ['class' => 'onoffswitch-label', 'label' => '<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span><span class="onoffswitch-switch"></span>']); ?>
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
                                    <div class="col-md-3">
                                        <strong>CONVENIO CON LA INSTITUCION</strong>
                                    </div>
                                    <div class="col-md-2">
                                        <strong>INSTITUCION</strong>
                                    </div>
                                    <div class="col-md-2">
                                        <strong>FECHA CREACION</strong>
                                    </div>
                                    <div class="col-md-2">
                                        <strong>FECHA EDICION</strong>
                                    </div>
                                    <div class="col-md-2">
                                        <strong>ACTIVO</strong>
                                    </div>
                                    <div class="col-md-1">

                                    </div>
                                </div>
                            </div>
                            <ul class="list-group no-margin">
                                <?php foreach ($listConvenio as $item): ?>
                                    <li class="list-group-item">
                                        <div class="row category-detail">
                                            <div class="col-md-3">
                                                <?php echo $item->nombre_convenio; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php echo $item->entidad->razon_social; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php echo $item->fecha_creacion; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php echo $item->fecha_edicion; ?>
                                            </div>
                                            <div class="col-md-1">
												<span class="onoffswitch">
													<input type="checkbox" name="nuevo"
                                                           class="onoffswitch-checkbox update-active-category"
                                                           id="check<?php echo $item->id_convenio; ?>" <?php echo ($item->activo) ? 'checked' : ''; ?>>
													<label class="onoffswitch-label"
                                                           for="check<?php echo $item->id_convenio; ?>">
                                                        <span class="onoffswitch-inner" data-swchon-text="SI"
                                                              data-swchoff-text="NO"></span>
                                                        <span class="onoffswitch-switch"></span>
                                                    </label>
												</span>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button"
                                                        class="btn btn-primary btn-xs btn-edit-category btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                    Editar
                                                </button>
                                                <?php echo CHtml::link("<i class=\"fa fa-list\"></i> Ver Detalle",
                                                    array('Convenio/indexServicioConvenio',
                                                        'id' => "$item->id_convenio",),
                                                    array('class' => 'btn btn-primary btn-xs')); ?>

                                            </div>
                                        </div>
                                        <div class="row hidden category-form">
                                            <?php
                                            $form = $this->beginWidget('CActiveForm', [
                                                'action' => ['convenio/UpdateConvenio', 'id' => $item->id_convenio],
                                                'enableAjaxValidation' => true,
                                                'clientOptions' => [
                                                    'validateOnSubmit' => true,
                                                    'validateOnChange' => false
                                                ]
                                            ]);
                                            ?>
                                            <div class="col-md-3">
                                                <?php echo $form->textField($item, 'nombre_convenio', ['class' => 'form-control']); ?>
                                                <?php echo $form->error($item, 'nombre_convenio', ['class' => 'label label-danger']); ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php echo $form->dropDownList($item, 'id_entidad', $item->getEntidad(), ['class' => 'form-control']); ?>
                                                <?php echo $form->error($item, 'id_entidad', ['class' => 'label label-danger']); ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php echo $item->fecha_creacion; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php echo $item->fecha_edicion; ?>
                                            </div>
                                            <div class="col-md-1">
													<span class="onoffswitch">
														<?php echo $form->checkBox($item, 'activo', ['class' => 'onoffswitch-checkbox', 'id' => 'activo_' . $item->id_convenio]); ?>
                                                        <?php echo $form->label($item, 'activo', ['for' => 'activo_' . $item->id_convenio, 'class' => 'onoffswitch-label', 'label' => '<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span><span class="onoffswitch-switch"></span>']); ?>
													</span>
                                            </div>
                                            <div class="col-md-2 text-align-right">
                                                <button class="btn btn-danger btn-cancel-category btn-xs" type="reset">
                                                    Cancelar
                                                </button>
                                                <button class="btn btn-primary btn-submit-category btn-xs"
                                                        type="submit">Guardar
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
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/convenio/indexConvenio.js', CClientScript::POS_END);
?>




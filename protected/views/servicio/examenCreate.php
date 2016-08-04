<?php
/* @var $this UsuarioController */

$this->pageTitle = "Crear <span> > Servicio </span>";
$this->breadcrumbs = array(
    'Create',
);
?>


    <section id="widget-grid">
        <div class="row">
            <article class="col-md-6">
                <div class="jarviswidget" id="widget1">
                    <header></header>
                    <div>
                        <div class="widget-body no-padding">
                            <form class="smart-form"
                                  action="<?php echo CHtml::normalizeUrl(array("servicio/create", "grupo" => $dataUrl["grupo"], "tipo" => $dataUrl["tipo"])); ?>"
                                  method="POST">
                                <header>
                                    Formulario de Registro de Usuario
                                </header>
                                <fieldset>
                                    <section>
                                        <?php echo CHtml::activeLabel($servicio, 'cod_serv'); ?>
                                        <label class="input"> <i class="icon-append fa fa-barcode "></i>
                                            <?php echo CHtml::activeTextField($servicio, 'cod_serv', array('size' => 60, 'maxlength' => 32, 'class' => '', 'placeholder' => 'Codigo Servicio')); ?>
                                            <b class="tooltip tooltip-bottom-right">Codigo Servicio</b>
                                        </label>
                                        <?php echo CHtml::error($servicio, 'cod_serv'); ?>
                                    </section>
                                    <section>
                                        <?php echo CHtml::activeLabel($servicio, 'nombre_serv'); ?>
                                        <label class="input"> <i class="icon-append fa fa-archive"></i>
                                            <?php echo CHtml::activeTextField($servicio, 'nombre_serv', array('size' => 60, 'maxlength' => 32, 'class' => '', 'placeholder' => 'Nombre Servicio')); ?>
                                            <b class="tooltip tooltip-bottom-right">Nombre Servicio.</b>
                                        </label>
                                        <?php echo CHtml::error($servicio, 'nombre_serv'); ?>
                                    </section>
                                    <section>
                                        <?php echo CHtml::activeLabel($servicio, 'unidad_medida'); ?>
                                        <label class="input"> <i class="icon-append fa fa-circle-thin "></i>
                                            <?php echo CHtml::activeTextField($servicio, 'unidad_medida', array('size' => 60, 'maxlength' => 32, 'class' => '', 'placeholder' => 'Unidad')); ?>
                                            <b class="tooltip tooltip-bottom-right">Unidad.</b>
                                        </label>
                                        <?php echo CHtml::error($servicio, 'unidad_medida'); ?>
                                    </section>
                                    <section>
                                        <?php echo CHtml::activeLabel($servicio, 'precio_serv'); ?>
                                        <label class="input"> <i class="icon-append fa fa-circle-thin"></i>
                                            <?php echo CHtml::activeTextField($servicio, 'precio_serv', array('size' => 60, 'maxlength' => 32, 'class' => '', 'placeholder' => 'Precio')); ?>
                                            <b class="tooltip tooltip-bottom-right">Precio.</b>
                                        </label>
                                        <?php echo CHtml::error($servicio, 'precio_serv'); ?>
                                    </section>
                                    <section>
                                        <?php echo CHtml::activeLabel($servicio, 'tipo_cobro'); ?>
                                        <label class="input">
                                            <?php echo CHtml::activeDropDownList($servicio, 'tipo_cobro', ServicioForm::getTypeServicioOptions(), array('class' => 'form-control', 'placeholder' => 'Tipo Cobro')); ?>
                                            <b class="tooltip tooltip-bottom-right">Tipo Cobro.</b>
                                        </label>
                                        <?php echo CHtml::error($servicio, 'tipo_cobro'); ?>
                                    </section>
                                    <section>
                                        <?php echo CHtml::activeLabel($servicio, 'condiciones_ex'); ?>
                                        <label class="input"> <i class="icon-append fa fa-circle-thin"></i>
                                            <?php echo CHtml::activeTextField($servicio, 'condiciones_ex', array('size' => 60, 'maxlength' => 32, 'class' => '', 'placeholder' => 'Condiciones')); ?>
                                            <b class="tooltip tooltip-bottom-right">Precio.</b>
                                        </label>
                                        <?php echo CHtml::error($servicio, 'condiciones'); ?>
                                    </section>
                                    <section>
                                        <label class="toggle">
                                            <?php echo CHtml::activeCheckBox($servicio, 'activo', array('class' => 'form-control', 'placeholder' => 'Tipo Cobro')); ?>
                                            <i data-swchon-text="ON"
                                               data-swchoff-text="OFF"></i><?php echo CHtml::activeLabel($servicio, 'activo'); ?>
                                            <b class="tooltip tooltip-bottom-right">Tipo Cobro.</b>
                                        </label>
                                        <?php echo CHtml::error($servicio, 'tipo_cobro'); ?>
                                    </section>
                                    <?php echo CHtml::activeHiddenField($servicio, 'id_cat_ex', array('id' => "id_categoria")); ?>
                                </fieldset>
                                <footer>
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                </footer>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
            <article class="col-md-6">
                <div class="jarviswidget" id="widget2">
                    <header></header>
                    <div>
                        <div class="widget-body no-padding">
                            <form class="smart-form">
                                <header> Seleccionar Categoria</header>
                                <fieldset>
                                    <section>
                                        <label>CATEGORIA</label>
                                        <select style="width:100%" id="select2">
                                            <?php foreach ($categoria as $item): ?>
                                                <option value="<?php echo $item->id_cat_ex; ?>"
                                                        data-descripcion="<?php echo $item->descripcion_cat_ex; ?>"> <?php echo $item->nombre_cat_ex; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </section>
                                    <section>
                                        <p id="descripcion">

                                        </p>
                                    </section>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>


<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/select2/select2.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/servicio/createServicio.js', CClientScript::POS_END);
?>
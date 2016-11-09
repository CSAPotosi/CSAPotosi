<?php
/* @var $this PersonaController */
$this->pageTitle = "Empleado <span> > Crear </span>";
$this->breadcrumbs = array(
    'Empleado',
);
?>
<section class="widget-grid">
    <div class="row">
        <div class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header>Formulario de Registro de Empleado</header>
                <div>
                    <div class="jarviswidget-editbox">
                    </div>
                    <div class="widget-body">
                        <div class="row">
                            <?php echo CHtml::beginForm(array(), 'post', array('id' => 'wizard-1')); ?>
                            <div id="bootstrap-wizard-1" class="col-sm-12">
                                <div class="form-bootstrapWizard">
                                    <ul class="bootstrapWizard form-wizard">
                                        <li class="active" data-target="#step1">
                                            <a href="#tab1" data-toggle="tab"> <span class="step">1</span> <span
                                                    class="title">Datos Personales</span> </a>
                                        </li>
                                        <li data-target="#step2">
                                            <a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span
                                                    class="title">Informacion Complementaria</span> </a>
                                        </li>
                                        <li data-target="#step3">
                                            <a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span
                                                    class="title">Datos de Empleado</span> </a>
                                        </li>
                                        <li data-target="#step4">
                                            <a href="#tab4" data-toggle="tab"> <span class="step">4</span> <span
                                                    class="title">Registro Completado</span> </a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                        <br><br><br>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-6">
                                                <div align="center">
                                                    <?php $this->widget('application.extensions.xphoto.Xphoto', array(
                                                        'model' => $modelPerson,
                                                        'attribute' => 'foto',
                                                        'photoUrl' => null,
                                                    )); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="form-group">
                                                    <?php echo CHtml::activelabelEx($modelPerson, 'Numero de Documento'); ?>
                                                    <?php echo CHtml::activeHiddenField($modelPerson, 'num_doc', array('class' => 'form-control', 'placeholder' => 'Numero De Documento')); ?>
                                                    <input type="text" name="num_doc" id="num_doc" class="form-control"
                                                           placeholder="Numero de Docuemnto"
                                                           value="<?php echo $modelPerson->num_doc ?>">
                                                    <?php echo CHtml::error($modelPerson, 'num_doc', ['class' => 'label label-danger']); ?>
                                                </div>
                                                <?php echo CHtml::activeHiddenField($modelPerson, 'tipo_persona', array('class' => 'form-control', 'placeholder' => 'Numero De Documento', 'value' => '1')); ?>
                                                <div class="form-group">
                                                    <?php echo CHtml::activelabelEx($modelPerson, 'Tipo de Documento'); ?>
                                                    <?php echo CHtml::activedropDownList($modelPerson, 'tipo_doc', $modelPerson->getTipoDocumento(), array('class' => 'form-control', 'placeholder' => 'dni')); ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php echo CHtml::activelabelEx($modelPerson, 'nombres'); ?>
                                                    <?php echo CHtml::activeHiddenField($modelPerson, 'nombres', array('class' => 'form-control', 'placeholder' => 'Nombres')); ?>
                                                    <input type="text" name="nombres" id="nombres" class="form-control"
                                                           placeholder="Nombres"
                                                           value="<?php echo $modelPerson->nombres ?>">
                                                    <?php echo CHtml::error($modelPerson, 'nombres', ['class' => 'label label-danger']); ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php echo CHtml::activelabelEx($modelPerson, 'primer_apellido'); ?>
                                                    <?php echo CHtml::activeHiddenField($modelPerson, 'primer_apellido', array('class' => 'form-control', 'placeholder' => 'Primer Apellido')); ?>
                                                    <input type="text" name="primer_apellido" id="primer_apellido"
                                                           class="form-control" placeholder="Primer Apellido"
                                                           value="<?php echo $modelPerson->primer_apellido ?>">
                                                    <?php echo CHtml::error($modelPerson, 'primer_apellido', ['class' => 'label label-danger']); ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php echo CHtml::activelabelEx($modelPerson, 'Segundo Apellido'); ?>
                                                    <?php echo CHtml::activetextField($modelPerson, 'segundo_apellido', array('class' => 'form-control', 'placeholder' => 'Segundo Apellido')); ?>
                                                    <?php echo CHtml::error($modelPerson, 'segundo_apellido', array('class' => 'label label-danger')); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php echo CHtml::activelabelEx($modelPerson, 'Genero'); ?>
                                                    <?php echo CHtml::activedropDownList($modelPerson, 'genero', $modelPerson->getGenero(), array('class' => 'form-control')); ?>
                                                    <?php echo CHtml::error($modelPerson, 'genero', array('class' => 'label label-danger')); ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php echo CHtml::activeHiddenField($modelPerson, 'fecha_nac'); ?>
                                                    <?php echo CHtml::activeLabel($modelPerson, 'Fecha Nacimiento'); ?>
                                                    <input type="datepicker" class="form-control datepicker"
                                                           data-dateformat="dd/mm/yy" name="fecha_nac" id="fecha_nac"
                                                           placeholder="dd/mm/aaaa" maxDate='02/11/2016'
                                                           value="<?php echo $modelPerson->fecha_nac ?>">
                                                    <?php echo CHtml::error($modelPerson, 'fecha_nac', ['class' => 'label label-danger']); ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php echo CHtml::activelabelEx($modelPerson, 'Estado Civil'); ?>
                                                    <?php echo CHtml::activedropDownList($modelPerson, 'estado_civil', $modelPerson->getEstadoCivil(), array('class' => 'form-control')); ?>
                                                    <?php echo CHtml::error($modelPerson, 'estado_civil', array('class' => 'label label-danger')); ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php echo CHtml::activelabelEx($modelPerson, 'Ocupacion'); ?>
                                                    <?php echo CHtml::activetextField($modelPerson, 'ocupacion', array('class' => 'form-control', 'placeholder' => 'Ocupacion')); ?>
                                                    <?php echo CHtml::error($modelPerson, 'ocupacion', array('class' => 'label label-danger')); ?>
                                                </div>

                                                <div class="form-group">
                                                    <label>Medico de Turno en la Clinica </label>&nbsp;&nbsp;&nbsp;<br>
                                                    SI <input type="radio" name="medico" value="true">&nbsp;&nbsp;&nbsp;
                                                    NO <input type="radio" name="medico" checked value="false">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <br><br><br>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-offset-3">
                                                <div class="form-group">
                                                    <?php echo CHtml::activelabelEx($modelPerson, 'Nacionalidad'); ?>
                                                    <?php echo CHtml::activedropDownList($modelPerson, 'nacionalidad', $modelPerson->getPais(), array('class' => 'form-control')); ?>
                                                    <?php echo CHtml::error($modelPerson, 'nacionalidad', array('class' => 'label label-danger')); ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php echo CHtml::activelabelEx($modelPerson, 'localidad'); ?>
                                                    <?php echo CHtml::activetextField($modelPerson, 'localidad', array('class' => 'form-control', 'placeholder' => 'Localidad')); ?>
                                                    <?php echo CHtml::error($modelPerson, 'localidad', array('class' => 'label label-danger')); ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php echo CHtml::activelabelEx($modelPerson, 'Domicilio'); ?>
                                                    <?php echo CHtml::activetextField($modelPerson, 'domicilio', array('class' => 'form-control', 'placeholder' => 'Direccion')); ?>
                                                    <?php echo CHtml::error($modelPerson, 'domicilio', array('class' => 'label label-danger')); ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php echo CHtml::activelabelEx($modelPerson, 'Telefono'); ?>
                                                    <?php echo CHtml::activetextField($modelPerson, 'telefono', array('class' => 'form-control', 'placeholder' => 'Telefono')); ?>
                                                    <?php echo CHtml::error($modelPerson, 'telefono', array('class' => 'label label-danger')); ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php echo CHtml::activelabelEx($modelPerson, 'Email'); ?>
                                                    <?php echo CHtml::activetextField($modelPerson, 'email', array('class' => 'form-control', 'placeholder' => 'Email')); ?>
                                                    <?php echo CHtml::error($modelPerson, 'email', array('class' => 'label label-danger')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        <br><br><br>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-offset-3"
                                            ">
                                                <div class="form-group">
                                                    <?php echo CHtml::activelabelEx($modelPerson, 'Fecha de Contratacion'); ?>
                                                    <?php echo CHtml::activeHiddenField($modelPerson, 'fecha_contratacion'); ?>
                                                    <input type="datepicker" class="form-control datepicker"
                                                           data-dateformat="dd/mm/yy" name="fecha_contratacion"
                                                           id="fecha_contratacion" placeholder="dd/mm/aaaa">
                                                    <?php echo CHtml::error($modelPerson, 'fecha_contratacion', ['class' => 'label label-danger']); ?>
                                                </div>
                                                <div class="form-group">
                                                    <?php echo CHtml::activelabelEx($modelPerson, 'Codigo Maquina'); ?>
                                                    <?php echo CHtml::activetextField($modelPerson, 'cod_maquina', array('class' => 'form-control', 'placeholder' => 'Codigo de Maquina')); ?>
                                                    <?php echo CHtml::error($modelPerson, 'cod_maquina', array('class' => 'label label-danger')); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab4">
                                        <br><br><br>
                                        <div class="row">
                                            <div class="box-footer">
                                                <div class="form-group">
                                                    <div class="col-md-6 col-lg-offset-3">
                                                        <div class="alert alert-success fade in">
                                                            <i class="fa-fw fa fa-check"></i>
                                                            <h1><strong>Completado</strong> Informacion Completada.</h1>
                                                        </div>
                                                        <div class="col-md-8 col-lg-offset-2">
                                                            <button class="btn btn-primary btn-lg" type="submit"><i
                                                                    class='fa fa-save'></i> Enviar la Informacion del
                                                                Empleado
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <ul class="pager wizard no-margin">
                                                    <!--<li class="previous first disabled">
                                                    <a href="javascript:void(0);" class="btn btn-lg btn-default"> First </a>
                                                    </li>-->
                                                    <li class="previous disabled">
                                                        <a href="javascript:void(0);"
                                                           class="btn btn-lg btn-default"> Anterior </a>
                                                    </li>
                                                    <!--<li class="next last">
                                                    <a href="javascript:void(0);" class="btn btn-lg btn-primary"> Last </a>
                                                    </li>-->
                                                    <li class="next">
                                                        <a href="javascript:void(0);"
                                                           class="btn btn-lg txt-color-darken"> Siguiente </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php echo CHtml::endForm(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/fuelux/wizard/wizard.min.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/jquery-validate/jquery.validate.min.js', CClientScript::POS_END); ?>
<!--end plugins-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/empleado/create.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/empleado/validacion.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/iCheck/icheck.js', CClientScript::POS_END); ?>

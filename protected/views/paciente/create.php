<?php
/* @var $this PersonaController */
$this->pageTitle = "PACIENTE <span></span>";
$this->breadcrumbs = array(
    'Paciente',
);
?>
<section class="widget-grid">
    <div class="row">
        <div class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="jarviswidget-editbox">
                    </div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>CREAR PACIENTE</legend>
                            <?php echo CHtml::errorSummary($modelPerson, '<h4 class="alert-heading"><i class="fa fa-warning"></i> DEBE CORREGIR LOS SIGUIENTES ERRORES </h4>', null, array('class' => 'alert alert-danger error-message')); ?>
                            <div class="row">
                                <?php echo CHtml::beginForm(array(), 'post', array('id' => 'wizard-1')); ?>
                                <div id="bootstrap-wizard-1" class="col-sm-12">
                                    <div class="form-bootstrapWizard">
                                        <ul class="bootstrapWizard form-wizard">
                                            <li class="active" data-target="#step1">
                                                <a href="#tab1" data-toggle="tab"> <span class="step">1</span> <span
                                                        class="title">DATOS PERSONALES</span> </a>
                                            </li>
                                            <li data-target="#step2">
                                                <a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span
                                                        class="title">iNFORMACION COMPLEMENTARIO</span> </a>
                                            </li>
                                            <li data-target="#step3">
                                                <a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span
                                                        class="title">INFORMACION DE CONTACTO</span> </a>
                                            </li>
                                            <li data-target="#step4">
                                                <a href="#tab4" data-toggle="tab"> <span class="step">4</span> <span
                                                        class="title">REGISTRO COMPLETADO</span> </a>
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
                                                            'width' => '270',
                                                            'height' => '315',
                                                        )); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-group">
                                                        <label>NUMERO DE DOCUMENTO</label>
                                                        <?php echo CHtml::activeHiddenField($modelPerson, 'num_doc', array('class' => 'form-control', 'placeholder' => 'Numero De Documento')); ?>
                                                        <input type="text" name="num_doc" id="num_doc"
                                                               class="form-control"
                                                               placeholder="Numero de Documento"
                                                               value="<?php echo $modelPerson->num_doc ?>">
                                                        <?php echo CHtml::error($modelPerson, 'num_doc', ['class' => 'label label-danger error-message']); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>TIPO DE DOCUMENTO</label>
                                                        <?php echo CHtml::activedropDownList($modelPerson, 'tipo_doc', $modelPerson->getTipoDocumento(), array('class' => 'form-control', 'placeholder' => 'dni')); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>NOMBRES</label>
                                                        <?php echo CHtml::activeHiddenField($modelPerson, 'nombres', array('class' => 'form-control', 'placeholder' => 'Nombres')); ?>
                                                        <input type="text" name="nombres" id="nombres"
                                                               class="form-control"
                                                               placeholder="Nombres"
                                                               value="<?php echo $modelPerson->nombres ?>">
                                                        <?php echo CHtml::error($modelPerson, 'nombres', ['class' => 'label label-danger']); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <<label>PRIMER APELLIDO</label>
                                                        <?php echo CHtml::activeHiddenField($modelPerson, 'primer_apellido', array('class' => 'form-control', 'placeholder' => 'Primer Apellido')); ?>
                                                        <input type="text" name="primer_apellido" id="primer_apellido"
                                                               class="form-control" placeholder="Primer Apellido"
                                                               value="<?php echo $modelPerson->primer_apellido ?>">
                                                        <?php echo CHtml::error($modelPerson, 'primer_apellido', ['class' => 'label label-danger']); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>SEGUNDO APELLIDO</label>
                                                        <?php echo CHtml::activetextField($modelPerson, 'segundo_apellido', array('class' => 'form-control', 'placeholder' => 'Segundo Apellido')); ?>
                                                        <?php echo CHtml::error($modelPerson, 'segundo_apellido', array('class' => 'label label-danger')); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>GRUPO SANGUINEO</label>
                                                        <?php echo CHtml::activedropDownList($modelPerson, 'grupo_sanguineo', $modelPerson->getGrupoSanguineo(), array('class' => 'form-control')); ?>
                                                        <?php echo CHtml::error($modelPerson, 'grupo_sanguineo', array('class' => 'label label-danger')); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>GENERO</label>
                                                        <?php echo CHtml::activedropDownList($modelPerson, 'genero', $modelPerson->getGenero(), array('class' => 'form-control')); ?>
                                                        <?php echo CHtml::error($modelPerson, 'genero', array('class' => 'label label-danger')); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php echo CHtml::activeHiddenField($modelPerson, 'fecha_nac'); ?>
                                                        <label>FECHA NACIEMIENTO</label>
                                                        <input type="datepicker" class="form-control datepicker"
                                                               data-dateformat="dd/mm/yy" name="fecha_nac"
                                                               id="fecha_nac"
                                                               placeholder="dd/mm/aaaa" maxDate='02/11/2016'
                                                               value="<?php echo $modelPerson->fecha_nac ?>">
                                                        <?php echo CHtml::error($modelPerson, 'fecha_nac', ['class' => 'label label-danger']); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>ESTADO CIVIL</label>
                                                        <?php echo CHtml::activedropDownList($modelPerson, 'estado_civil', $modelPerson->getEstadoCivil(), array('class' => 'form-control')); ?>
                                                        <?php echo CHtml::error($modelPerson, 'estado_civil', array('class' => 'label label-danger')); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>OCUPACION</label>
                                                        <?php echo CHtml::activetextField($modelPerson, 'ocupacion', array('class' => 'form-control', 'placeholder' => 'Ocupacion')); ?>
                                                        <?php echo CHtml::error($modelPerson, 'ocupacion', array('class' => 'label label-danger')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab2">
                                            <br><br><br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-offset-3">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>NACIONALIDAD</label>
                                                                        <?php echo CHtml::activedropDownList($modelPerson, 'nacionalidad', $modelPerson->getPais(), array('options' => array('BOL' => array('SELECTED' => true)), 'class' => 'form-control')); ?>
                                                                        <?php echo CHtml::error($modelPerson, 'nacionalidad', array('class' => 'label label-danger')); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>LOCALIDAD</label>
                                                                        <?php echo CHtml::activetextField($modelPerson, 'localidad', array('class' => 'form-control', 'placeholder' => 'Localidad o Departamento')); ?>
                                                                        <?php echo CHtml::error($modelPerson, 'localidad', array('class' => 'label label-danger')); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>DOMICILIO</label>
                                                                <?php echo CHtml::activetextField($modelPerson, 'domicilio', array('class' => 'form-control', 'placeholder' => 'Direccion')); ?>
                                                                <?php echo CHtml::error($modelPerson, 'domicilio', array('class' => 'label label-danger')); ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>TELEFONO</label>
                                                                <?php echo CHtml::activetextField($modelPerson, 'telefono', array('class' => 'form-control', 'placeholder' => 'Telefono')); ?>
                                                                <?php echo CHtml::error($modelPerson, 'telefono', array('class' => 'label label-danger')); ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>EMAIL</label>
                                                                <?php echo CHtml::activehiddenField($modelPerson, 'email', []); ?>
                                                                <input type="text" class="form-control"
                                                                       placeholder="ejemplo@email.com" id="email"
                                                                       name="email"
                                                                       value="<?php echo $modelPerson->email ?>">
                                                                <?php echo CHtml::error($modelPerson, 'email', array('class' => 'label label-danger')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab3">
                                            <br><br><br>
                                            <div class="row">
                                                <div class="col-md-6 col-lg-offset-3">
                                                    <?php
                                                    if ($modelPerson->responsable != '') {
                                                        $valor = explode("-", $modelPerson->responsable, 4);
                                                    } else {
                                                        $valor[0] = "";
                                                        $valor[1] = "";
                                                        $valor[2] = "";
                                                        $valor[3] = "";
                                                    }

                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>CONTACTO</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="Nombre completo de contacto"
                                                                       id="contacto" value="<?php echo $valor[0] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>PARENTESCO</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="Parentesco o relacion con el paciente"
                                                                       id="parentesco" value="<?php echo $valor[1] ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>TELEFONO</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="Telefono" id="telefono"
                                                                       value="<?php echo $valor[2] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>DIRECCION</label>
                                                                <input type="text" class="form-control"
                                                                       placeholder="Direccion" id="direccion"
                                                                       value="<?php echo $valor[3] ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php echo CHtml::activehiddenField($modelPerson, 'responsable', []); ?>
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
                                                                <h1><strong> INFORMACION COMPLETADA</strong>.
                                                                </h1>
                                                            </div>
                                                            <div class="col-md-4 col-lg-offset-4">
                                                                <button class="btn btn-primary" type="sutmit"
                                                                        id="btnEnviarPaciente"><i
                                                                        class='fa fa-save'></i>
                                                                    GUARDAR
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
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- start plugins-->
<!--plugin smartwizart-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/fuelux/wizard/wizard.min.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/jquery-validate/jquery.validate.min.js', CClientScript::POS_END); ?>
<!--end plugins-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/paciente/create.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/paciente/validacion.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js', CClientScript::POS_END); ?>

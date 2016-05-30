<?php
/* @var $this PersonaController */
$this->pageTitle = "Paciente <span> > Crear </span>";
$this->breadcrumbs = array(
    'Paciente',
);
?>
    <section class="widget-grid">
        <div class="row">
            <div class="col-md-12">
                <div class="jarviswidget" id="widget1">
                    <header>Formulario de Registro de Paciente</header>
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
                                                        class="title">Informacion paciente</span> </a>
                                            </li>
                                            <li data-target="#step2">
                                                <a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span
                                                        class="title">Informacion Complementaria</span> </a>
                                            </li>
                                            <li data-target="#step3">
                                                <a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span
                                                        class="title">Informacion Contacto</span> </a>
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
                                                        <?php echo CHtml::activetextField($modelPerson, 'num_doc', array('class' => 'form-control', 'placeholder' => 'Numero De Documento')); ?>
                                                    </div>
                                                    <?php echo CHtml::activeHiddenField($modelPerson, 'tipo_persona', array('class' => 'form-control', 'placeholder' => 'Numero De Documento', 'value' => '1')); ?>
                                                    <div class="form-group">
                                                        <?php echo CHtml::activelabelEx($modelPerson, 'Tipo de Documento'); ?>
                                                        <?php echo CHtml::activedropDownList($modelPerson, 'tipo_doc', $modelPerson->getTipoDocumento(), array('class' => 'form-control', 'placeholder' => 'dni')); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php echo CHtml::activelabelEx($modelPerson, 'nombres'); ?>
                                                        <?php echo CHtml::activetextField($modelPerson, 'nombres', array('class' => 'form-control', 'placeholder' => 'Nombres')); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php echo CHtml::activelabelEx($modelPerson, 'primer_apellido'); ?>
                                                        <?php echo CHtml::activetextField($modelPerson, 'primer_apellido', array('class' => 'form-control', 'placeholder' => 'Primer Apellido')); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php echo CHtml::activelabelEx($modelPerson, 'segundo_apellido'); ?>
                                                        <?php echo CHtml::activetextField($modelPerson, 'segundo_apellido', array('class' => 'form-control', 'placeholder' => 'segundo_apellido')); ?>
                                                        <?php echo CHtml::error($modelPerson, 'segundo_apellido', array('class' => 'label label-danger')); ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <?php echo CHtml::activelabelEx($modelPerson, 'Grupo Sanguineo'); ?>
                                                        <?php echo CHtml::activedropDownList($modelPerson, 'grupo_sanguineo', $modelPerson->getGrupoSanguineo(), array('class' => 'form-control')); ?>
                                                        <?php echo CHtml::error($modelPerson, 'grupo_sanguineo', array('class' => 'label label-danger')); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php echo CHtml::activelabelEx($modelPerson, 'Genero'); ?>
                                                        <?php echo CHtml::activedropDownList($modelPerson, 'genero', $modelPerson->getGenero(), array('class' => 'form-control')); ?>
                                                        <?php echo CHtml::error($modelPerson, 'genero', array('class' => 'label label-danger')); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php echo CHtml::activelabelEx($modelPerson, 'Fecha Nacimiento'); ?>
                                                        <?php echo CHtml::activedateField($modelPerson, 'fecha_nac', array('class' => 'form-control', 'prompt' => 'seleccione')) ?>
                                                        <?php echo CHtml::error($modelPerson, 'fecha_nac', array('class' => 'label label-danger')); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php echo CHtml::activelabelEx($modelPerson, 'Estado Civil'); ?>
                                                        <?php echo CHtml::activedropDownList($modelPerson, 'estado_civil', $modelPerson->getEstadoCivil(), array('class' => 'form-control')); ?>
                                                        <?php echo CHtml::error($modelPerson, 'estado_civil', array('class' => 'label label-danger')); ?>
                                                    </div>
                                                    <div class="form-group">
                                                        <?php echo CHtml::activelabelEx($modelPerson, 'Ocupacion'); ?>
                                                        <?php echo CHtml::activetextField($modelPerson, 'ocupacion', array('class' => 'form-control', 'placeholder' => 'Provincia/Departamento')); ?>
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
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <?php echo CHtml::activelabelEx($modelPerson, 'Nacionalidad'); ?>
                                                                <?php echo CHtml::activedropDownList($modelPerson, 'nacionalidad', $modelPerson->getPais(), array('class' => 'form-control')); ?>
                                                                <?php echo CHtml::error($modelPerson, 'nacionalidad', array('class' => 'label label-danger')); ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <?php echo CHtml::activelabelEx($modelPerson, 'localidad'); ?>
                                                                <?php echo CHtml::activetextField($modelPerson, 'localidad', array('class' => 'form-control', 'placeholder' => 'localidad')); ?>
                                                                <?php echo CHtml::error($modelPerson, 'localidad', array('class' => 'label label-danger')); ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <?php echo CHtml::activelabelEx($modelPerson, 'Domicilio'); ?>
                                                                <?php echo CHtml::activetextField($modelPerson, 'domicilio', array('class' => 'form-control', 'placeholder' => 'direccion')); ?>
                                                                <?php echo CHtml::error($modelPerson, 'domicilio', array('class' => 'label label-danger')); ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <?php echo CHtml::activelabelEx($modelPerson, 'Telefono'); ?>
                                                                <?php echo CHtml::activetextField($modelPerson, 'telefono', array('class' => 'form-control', 'placeholder' => 'telefono')); ?>
                                                                <?php echo CHtml::error($modelPerson, 'telefono', array('class' => 'label label-danger')); ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <?php echo CHtml::activelabelEx($modelPerson, 'Email'); ?>
                                                                <?php echo CHtml::activetextField($modelPerson, 'email', array('class' => 'form-control', 'placeholder' => 'email')); ?>
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
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <?php echo CHtml::activelabelEx($modelPerson, 'Responsable'); ?>
                                                        <?php echo CHtml::activetextField($modelPerson, 'responsable', array('class' => 'form-control', 'placeholder' => 'Responsable o Contacto de Paciente')); ?>
                                                        <?php echo CHtml::error($modelPerson, 'responsable', array('class' => 'label label-danger')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab4">
                                            <br><br><br>
                                            <div class="row">
                                                <h1>Pasos Concluidos Correctamente</h1>
                                                <div class="box-footer">
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <?php echo CHtml::submitButton('Registrar Paciente', array('class' => 'btn btn-primary btn-lg')); ?>
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
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/persona/_formPerson.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js', CClientScript::POS_END); ?>
    <!--end plugins-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/fuelux/wizard/wizard.min.js', CClientScript::POS_END); ?><?php



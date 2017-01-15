<?php
/* $this ServicioController */
$this->pageTitle = "Paciente <span></span>";
$this->breadcrumbs = array(
    'Actualizar Paciente',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Actualizar Paciente</legend>
                            <br>
                            <?php echo CHtml::beginForm(array(), 'post', array()); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div align="center">
                                        <?php $this->widget('application.extensions.xphoto.Xphoto', array(
                                            'model' => $modelPerson,
                                            'attribute' => 'foto',
                                            'width' => '270',
                                            'height' => '315',
                                            'photoUrl' => Yii::app()->baseUrl . '/images/' . $persona->id_persona . '/photo.png',
                                        )); ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activelabelEx($modelPerson, 'Numero de Documento'); ?>
                                                <?php echo CHtml::activeTextField($modelPerson, 'num_doc', array('class' => 'form-control', 'placeholder' => 'Numero De Documento', 'value' => $persona->num_doc)); ?>
                                                <?php echo CHtml::error($modelPerson, 'num_doc', ['class' => 'label label-danger']); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activelabelEx($modelPerson, 'Tipo de Documento'); ?>
                                                <select name="PersonaForm[tipo_doc]" class="form-control">
                                                    <option
                                                        value="0" <?php echo ($persona->tipo_doc == 0) ? 'selected' : '' ?>>
                                                        Seleccione
                                                    </option>
                                                    <option
                                                        value="1" <?php echo ($persona->tipo_doc == 1) ? 'selected' : '' ?>>
                                                        CARNET DE IDENTIDAD
                                                    </option>
                                                    <option
                                                        value="2" <?php echo ($persona->tipo_doc == 2) ? 'selected' : '' ?>>
                                                        LIBRETA O DNI
                                                    </option>
                                                    <option
                                                        value="3" <?php echo ($persona->tipo_doc == 3) ? 'selected' : '' ?>>
                                                        PASAPORTE
                                                    </option>
                                                    <option
                                                        value="4" <?php echo ($persona->tipo_doc == 4) ? 'selected' : '' ?>>
                                                        PART. NACIMIENTO-IDENTIDAD
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo CHtml::activelabelEx($modelPerson, 'nombres'); ?>
                                        <?php echo CHtml::activeTextField($modelPerson, 'nombres', array('class' => 'form-control', 'placeholder' => 'Nombres', 'value' => $persona->nombres)); ?>
                                        <?php echo CHtml::error($modelPerson, 'nombres', ['class' => 'label label-danger']); ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activelabelEx($modelPerson, 'primer_apellido'); ?>
                                                <?php echo CHtml::activeTextField($modelPerson, 'primer_apellido', array('class' => 'form-control', 'placeholder' => 'Primer Apellido', 'value' => $persona->primer_apellido)); ?>
                                                <?php echo CHtml::error($modelPerson, 'primer_apellido', ['class' => 'label label-danger']); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activelabelEx($modelPerson, 'Segundo Apellido'); ?>
                                                <?php echo CHtml::activetextField($modelPerson, 'segundo_apellido', array('class' => 'form-control', 'placeholder' => 'Segundo Apellido', 'value' => $persona->segundo_apellido)); ?>
                                                <?php echo CHtml::error($modelPerson, 'segundo_apellido', array('class' => 'label label-danger')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activelabelEx($modelPerson, 'Genero'); ?>
                                                <select name="PersonaForm[genero]" class="form-control">
                                                    <option
                                                        value="1" <?php echo ($persona->genero) ? 'selected' : '' ?>>
                                                        MASCULINO
                                                    </option>
                                                    <option
                                                        value="2" <?php echo (!$persona->genero) ? 'selected' : '' ?>>
                                                        FEMENINO
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activelabelEx($modelPerson, 'Grupo Sanguineo'); ?>
                                                <select name="PersonaForm[grupo_sanguineo]" class="form-control">
                                                    <option
                                                        value="0" <?php echo ($persona->paciente->grupo_sanguineo == 0) ? 'selected' : '' ?>>
                                                        ELIJA TIPO DE SANGRE
                                                    </option>
                                                    <option
                                                        value="1" <?php echo ($persona->paciente->grupo_sanguineo == 1) ? 'selected' : '' ?>>
                                                        O+
                                                    </option>
                                                    <option
                                                        value="2" <?php echo ($persona->paciente->grupo_sanguineo == 2) ? 'selected' : '' ?>>
                                                        A+
                                                    </option>
                                                    <option
                                                        value="3" <?php echo ($persona->paciente->grupo_sanguineo == 3) ? 'selected' : '' ?>>
                                                        A-
                                                    </option>
                                                    <option
                                                        value="4" <?php echo ($persona->paciente->grupo_sanguineo == 4) ? 'selected' : '' ?>>
                                                        B+
                                                    </option>
                                                    <option
                                                        value="5" <?php echo ($persona->paciente->grupo_sanguineo == 5) ? 'selected' : '' ?>>
                                                        B-
                                                    </option>
                                                    <option
                                                        value="6" <?php echo ($persona->paciente->grupo_sanguineo == 6) ? 'selected' : '' ?>>
                                                        AB+
                                                    </option>
                                                    <option
                                                        value="7" <?php echo ($persona->paciente->grupo_sanguineo == 7) ? 'selected' : '' ?>>
                                                        AB-
                                                    </option>
                                                    <option
                                                        value="8" <?php echo ($persona->paciente->grupo_sanguineo == 8) ? 'selected' : '' ?>>
                                                        O-
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo CHtml::activeLabel($modelPerson, 'Fecha nacimiento'); ?>
                                        <?php echo CHtml::activeTextField($modelPerson, 'fecha_nac', array('class' => 'form-control datepicker', 'data-dateformat' => 'dd/mm/yy', 'placeholder' => 'dd/mm/aaaa', 'value' => date('d/m/Y', strtotime($persona->fecha_nac)))); ?>
                                        <?php echo CHtml::error($modelPerson, 'fecha_nac', ['class' => 'label label-danger']); ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activelabelEx($modelPerson, 'Ocupacion'); ?>
                                                <?php echo CHtml::activetextField($modelPerson, 'ocupacion', array('class' => 'form-control', 'placeholder' => 'Ocupacion', 'value' => $persona->ocupacion)); ?>
                                                <?php echo CHtml::error($modelPerson, 'ocupacion', array('class' => 'label label-danger')); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activelabelEx($modelPerson, 'Estado Civil'); ?>
                                                <select name="PersonaForm[estado_civil]" class="form-control">
                                                    <option
                                                        value="0" <?php echo ($persona->estado_civil == 0) ? 'selected' : '' ?>>
                                                        SELCCIONE
                                                    </option>
                                                    <option
                                                        value="1" <?php echo ($persona->estado_civil == 1) ? 'selected' : '' ?>>
                                                        SOLTERO(A)
                                                    </option>
                                                    <option
                                                        value="2" <?php echo ($persona->estado_civil == 2) ? 'selected' : '' ?>>
                                                        CASADO(A)
                                                    </option>
                                                    <option
                                                        value="3" <?php echo ($persona->estado_civil == 3) ? 'selected' : '' ?>>
                                                        DIVORCIADO(A)
                                                    </option>
                                                    <option
                                                        value="4" <?php echo ($persona->estado_civil == 4) ? 'selected' : '' ?>>
                                                        VIUDO(A)
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activelabelEx($modelPerson, 'Nacionalidad'); ?>
                                                <?php $pais = Pais::model()->findAll(); ?>
                                                <select name="PersonaForm[nacionalidad]" class="form-control">
                                                    <?php foreach ($pais as $item) { ?>
                                                        <option
                                                            value="<?php echo $item->cod_pais ?>" <?php echo ($persona->nacionalidad == $item->cod_pais) ? 'selected' : '' ?>><?php echo $item->nombre_pais ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activelabelEx($modelPerson, 'Departamento Localidad'); ?>
                                                <?php echo CHtml::activetextField($modelPerson, 'localidad', array('class' => 'form-control', 'placeholder' => 'Localidad o Departamento', 'value' => $persona->localidad)); ?>
                                                <?php echo CHtml::error($modelPerson, 'localidad', array('class' => 'label label-danger')); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo CHtml::activelabelEx($modelPerson, 'Domicilio'); ?>
                                        <?php echo CHtml::activetextField($modelPerson, 'domicilio', array('class' => 'form-control', 'placeholder' => 'Direccion', 'value' => $persona->domicilio)); ?>
                                        <?php echo CHtml::error($modelPerson, 'domicilio', array('class' => 'label label-danger')); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo CHtml::activelabelEx($modelPerson, 'Telefono'); ?>
                                        <?php echo CHtml::activetextField($modelPerson, 'telefono', array('class' => 'form-control', 'placeholder' => 'Telefono', 'value' => $persona->telefono)); ?>
                                        <?php echo CHtml::error($modelPerson, 'telefono', array('class' => 'label label-danger')); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo CHtml::activelabelEx($modelPerson, 'Email'); ?>
                                        <?php echo CHtml::activeTextField($modelPerson, 'email', ['class' => 'form-control', 'placeholder' => 'Email', 'value' => $persona->email]); ?>
                                        <?php echo CHtml::error($modelPerson, 'email', array('class' => 'label label-danger')); ?>
                                    </div>
                                    <br>
                                    <h1>Informacion de Contacto</h1>
                                    <?php $valor = explode("-", $persona->paciente->responsable, 4); ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contacto</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Nombre completo de contacto"
                                                       id="contacto" value="<?php echo $valor[0] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Parentesco</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Parentesco o relacion con el paciente"
                                                       id="parentesco" value="<?php echo $valor[1] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Telefono</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Telefono" id="telefono"
                                                       value="<?php echo $valor[2] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Direccion</label>
                                                <input type="text" class="form-control"
                                                       placeholder="Direccion" id="direccion"
                                                       value="<?php echo $valor[3] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo CHtml::activeHiddenField($modelPerson, 'responsable'); ?>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit"
                                    id="btnEnviarUpdate"><i class='fa fa-save'></i>
                                Actualizar informacion de Paciente
                            </button>
                        </div>
                        <?php echo CHtml::endForm(); ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!--Start Scripts-->

<!--End plugins-->
<!-- start plugins-->
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/paciente/update.js', CClientScript::POS_END);
?>
<!--end plugins-->


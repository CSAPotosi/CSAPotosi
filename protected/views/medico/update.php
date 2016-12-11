<?php
/* $this ServicioController */
$this->pageTitle = "Empleado <span> > Actualizar Empleado</span>";
$this->breadcrumbs = array(
    'Actualizar Empleado',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Actualizar Empleado</legend>
                            <br>
                            <?php echo CHtml::beginForm(array(), 'post', array()); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div align="center">
                                        <?php $this->widget('application.extensions.xphoto.Xphoto', array(
                                            'model' => $modelPerson,
                                            'attribute' => 'foto',
                                            'width' => '270',
                                            'height' => '320',
                                            'photoUrl' => Yii::app()->baseUrl . '/images/' . $persona->id_persona . '/photo.png',
                                        )); ?>
                                    </div>
                                    <br><br>
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
                                    <div class="form-group">
                                        <?php echo CHtml::activelabelEx($modelPerson, 'nombres'); ?>
                                        <?php echo CHtml::activeTextField($modelPerson, 'nombres', array('class' => 'form-control', 'placeholder' => 'Nombres', 'value' => $persona->nombres)); ?>
                                        <?php echo CHtml::error($modelPerson, 'nombres', ['class' => 'label label-danger']); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                                                        value="1" <?php echo ($persona->genero == true) ? 'selected' : '' ?>>
                                                        MASCULINO
                                                    </option>
                                                    <option
                                                        value="0" <?php echo ($persona->genero == false) ? 'selected' : '' ?>>
                                                        FEMENINO
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activeLabel($modelPerson, 'Fecha nacimiento'); ?>
                                                <?php echo CHtml::activeTextField($modelPerson, 'fecha_nac', array('class' => 'form-control datepicker', 'data-dateformat' => 'dd/mm/yy', 'placeholder' => 'dd/mm/aaaa', 'value' => date('d/m/Y', strtotime($persona->fecha_nac)))); ?>
                                                <?php echo CHtml::error($modelPerson, 'fecha_nac', ['class' => 'label label-danger']); ?>
                                            </div>
                                        </div>
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
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activelabelEx($modelPerson, 'Domicilio'); ?>
                                                <?php echo CHtml::activetextField($modelPerson, 'domicilio', array('class' => 'form-control', 'placeholder' => 'Direccion', 'value' => $persona->domicilio)); ?>
                                                <?php echo CHtml::error($modelPerson, 'domicilio', array('class' => 'label label-danger')); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activelabelEx($modelPerson, 'Telefono'); ?>
                                                <?php echo CHtml::activetextField($modelPerson, 'telefono', array('class' => 'form-control', 'placeholder' => 'Telefono', 'value' => $persona->telefono)); ?>
                                                <?php echo CHtml::error($modelPerson, 'telefono', array('class' => 'label label-danger')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php echo CHtml::activelabelEx($modelPerson, 'Email'); ?>
                                        <?php echo CHtml::activeTextField($modelPerson, 'email', ['class' => 'form-control', 'placeholder' => 'Email', 'value' => $persona->email]); ?>
                                        <?php echo CHtml::error($modelPerson, 'email', array('class' => 'label label-danger')); ?>
                                    </div>
                                    <h1 align="center">Informacion de Medico</h1>
                                    <div class="form-group">
                                        <?php echo CHtml::activeLabel($modelPerson, 'matricula'); ?>
                                        <?php echo CHtml::activeTextField($modelPerson, 'matricula', ['class' => 'form-control', 'placeholder' => 'Matricula', 'value' => $persona->medico->matricula]); ?>
                                        <?php echo CHtml::error($modelPerson, 'matricula', ['class' => 'label label-danger']); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h1 align="center">Especialidades Asignadas a Medico</h1>
                                    <?php foreach ($listEspeMedi as $item) { ?>
                                        <p class="text-muted">
                                                <span
                                                    class="txt-color-darken"><i
                                                        class="fa fa-plus-square"></i> <?php echo " " . $item->idEspecialidad->nombre_especialidad ?></span>&nbsp;&nbsp;&nbsp;(Especialidad)<br>
                                        </p>
                                    <?php } ?>
                                    <h1 align="center">Especialidades por Asignar</h1>

                                    <table class="table table-responsive table-bordered"
                                           id="contenedorAsignadas">
                                        <thead>
                                        <tr>
                                            <th>Nombre Especialidad</th>
                                            <th>Descripcion</th>
                                            <th>Accion</th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <h1 align="center">Especialidades Disponibles</h1>
                                    <div id="contenedorListaEspecialidad">
                                        <?php $this->renderPartial('_specialtyList', array('listSpecialty' => $listSpecialty, 'modelMedicoEspe' => $modelMedicoEspe)) ?>
                                    </div>
                                    <button type="button" class="btn btn-primary"
                                            data-target="#modalEspecialidad"
                                            data-toggle="modal">
                                        <i class="fa fa-plus"></i>Agregar Especialidad
                                    </button>


                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit"
                                    id="btnEnviarUpdate"><i class='fa fa-save'></i>
                                Actualizar informacion de Empleado
                            </button>
                        </div>
                        <?php echo CHtml::endForm(); ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<div class="modal fade in" id="modalEspecialidad" tabindex="-1" role="dialog" aria-hidden="true" style="display:none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">Registrar Especialidad Medica</h4>
            </div>
            <div class="modal-body" id="contenedorFormularioEspecialidad">
                <?php $this->renderPartial('_formSpecialty', array('modelEspecialidad' => $modelEspecialidad)) ?>
            </div>
            <div class="modal-footer clearfix">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary pull-left" id="btnGuardarEspecialidad"
                        data-url="<?php echo CHtml::normalizeUrl(['medico/CreateSpecialyAjax']) ?>">Guardar
                </button>
            </div>
        </div>
    </div>
</div>
<!--Start Scripts-->

<!--End plugins-->
<!-- start plugins-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/iCheck/icheck.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/medico/onlyMedico.js', CClientScript::POS_END); ?>


<!--end plugins-->


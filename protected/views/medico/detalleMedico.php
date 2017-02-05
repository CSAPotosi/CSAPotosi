<?php
/* $this ServicioController */
$this->pageTitle = "Empleado <span> > Detalle Empleado</span>";
$this->breadcrumbs = array(
    'Paciente',
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
                            <legend>Detalle de Empleado</legend>
                            <br>
                            <div class="row">
                                <div class="col-sm-2 profile-pic">
                                    <img src="images/<?php echo $medico->id_medico ?>/photo.png" alt="demo user">
                                    <div class="padding-10">
                                        <h4 class="font-md"><strong><?php echo $medico->persona->num_doc ?></strong>
                                            <br>
                                            <small><?php switch ($medico->persona->tipo_doc) {
                                                    case 0:
                                                        echo '---';
                                                        break;
                                                    case 1:
                                                        echo 'CARNET DE IDENTIDAD';
                                                        break;
                                                    case 2:
                                                        'LIBRETA O DNI';
                                                        break;
                                                    case 3:
                                                        echo 'PASAPORTE';
                                                        break;
                                                    case 4:
                                                        'PART. NACIMIENTO-IDENTIDAD';
                                                        break;
                                                } ?>
                                            </small>
                                        </h4>
                                        <br>
                                        <h4 class="font-md"><strong><?php switch ($medico->persona->genero) {
                                                    case true:
                                                        echo 'MASCULINO';
                                                        break;
                                                    case false:
                                                        echo 'FEMENINO';
                                                        break;
                                                } ?></strong>
                                            <br>
                                            <small>Genero</small>
                                        </h4>
                                        <h4 class="font-md"><strong><?php switch ($medico->estado_med) {
                                                    case true:
                                                        'activo';
                                                        break;
                                                    case false:
                                                        'Inactivo';
                                                        break;
                                                } ?></strong>
                                            <br>
                                            <small>Estado</small>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h1><?php echo $medico->persona->nombres ?> <span
                                            class="semi-bold"><?php echo $medico->persona->primer_apellido . ' ' . $medico->persona->segundo_apellido ?></span>
                                        <br>
                                        <small></small>
                                    </h1>

                                    <ul class="list-unstyled">
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo date('d/m/Y', strtotime($medico->persona->fecha_nac)) ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Fecha Nacimiento)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-phone"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $medico->persona->telefono ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Telefono o Celular)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-map-marker"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $medico->persona->localidad . ' - ' . $medico->persona->domicilio ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Localidad - Domicilio)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-flag"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $medico->persona->nacionalidad1->nombre_pais ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Pais Nacimiento)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-book"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php switch ($medico->persona->estado_civil) {
                                                        case 0:
                                                            echo '---';
                                                            break;
                                                        case 1:
                                                            echo 'SOLTERO(A)';
                                                            break;
                                                        case 2:
                                                            echo 'CASADO(A)';
                                                            break;
                                                        case 3:
                                                            echo 'DIVORCIADO(A)';
                                                            break;
                                                        case 4:
                                                            echo 'VIUDO(A)';
                                                            break;
                                                    } ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Estado Civil)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-gavel"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $medico->persona->ocupacion ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Ocupacion o Trabajo)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-envelope"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $medico->persona->email ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Correo Electronico)</small>
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-3">
                                    <?php if ($medico->persona->empleado) { ?>
                                        <h1>
                                            <small>Informacion de Empleado</small>
                                        </h1>
                                        <ul class="list-unstyled">
                                            <li>
                                                <p class="text-muted">
                                                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span
                                                        class="txt-color-darken"><?php echo $medico->persona->empleado->fecha_contratacion ?></span>&nbsp;&nbsp;&nbsp;
                                                    <small>(Fecha de Contratacion)</small>
                                                </p>
                                            </li>
                                            <li>
                                                <p class="text-muted">
                                                    <i class="fa fa-calculator"></i>&nbsp;&nbsp;<span
                                                        class="txt-color-darken"><?php echo $medico->persona->empleado->cod_maquina ?></span>&nbsp;&nbsp;&nbsp;
                                                    <small>(Codigo Maquina)</small>
                                                </p>
                                            </li>
                                        </ul>
                                    <?php } ?>
                                    <h1>
                                        <small>Informacion del Medico</small>
                                    </h1>
                                    <ul class="list-unstyled">
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-file-code-o"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $medico->matricula ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Matricula)</small>
                                            </p>
                                        </li>

                                    </ul>
                                    <h1>
                                        <small>Especialidades</small>
                                    </h1>
                                    <ul class="list-unstyled">
                                        <?php $especialidad = MedicoEspecialidad::model()->findAll([
                                            'condition' => "id_medico=$medico->id_medico",
                                        ]) ?>
                                        <?php foreach ($especialidad as $item) { ?>
                                            <li>
                                                <p class="text-muted">
                                                <span
                                                    class="txt-color-darken"><?php echo $item->idEspecialidad->nombre_especialidad ?></span>&nbsp;&nbsp;&nbsp;
                                                </p>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <h1>
                                        <small></small>
                                    </h1>
                                    <ul class="list-unstyled">

                                    </ul>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <?php echo CHtml::link('<i class="fa fa-edit"></i> Editar Medico', array('medico/update', 'id' => $medico->id_medico), array('class' => 'btn btn-primary')); ?>
                        </div>
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

?>
<!--end plugins-->


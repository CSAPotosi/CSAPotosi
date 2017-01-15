<?php
/* $this ServicioController */
$this->pageTitle = "Paciente <span></span>";
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
                            <legend>Detalle de Paciente</legend>
                            <br>
                            <div class="row">
                                <div class="col-sm-2 profile-pic">
                                    <img src="images/<?php echo $paciente->id_paciente ?>/photo.png" alt="demo user">
                                    <div class="padding-10">
                                        <h4 class="font-md"><strong><?php echo $paciente->persona->num_doc ?></strong>
                                            <br>
                                            <small><?php switch ($paciente->persona->tipo_doc) {
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
                                        <h4 class="font-md"><strong><?php switch ($paciente->persona->genero) {
                                                    case 0:
                                                        echo '---';
                                                        break;
                                                    case 1:
                                                        echo 'MASCULINO';
                                                        break;
                                                    case 2:
                                                        echo 'FEMENINO';
                                                        break;
                                                } ?></strong>
                                            <br>
                                            <small>Genero</small>
                                        </h4>
                                        <h4 class="font-md"><strong><?php switch ($paciente->estado_paciente) {
                                                    case 0:
                                                        echo 'Murio' . ' ' . $paciente->fecha_deceso;
                                                        break;
                                                    case 1:
                                                        'Activo';
                                                        break;
                                                    case 2:
                                                        'Internado';
                                                        break;
                                                } ?></strong>
                                            <br>
                                            <small>Estado</small>
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h1><?php echo $paciente->persona->nombres ?> <span
                                            class="semi-bold"><?php echo $paciente->persona->primer_apellido . ' ' . $paciente->persona->segundo_apellido ?></span>
                                        <br>
                                        <small></small>
                                    </h1>

                                    <ul class="list-unstyled">
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo date('d/m/Y', strtotime($paciente->persona->fecha_nac)) ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Fecha Nacimiento)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-phone"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $paciente->persona->telefono ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Telefono o Celular)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-map-marker"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $paciente->persona->localidad . ' - ' . $paciente->persona->domicilio ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Localidad - Domicilio)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-flag"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $paciente->persona->nacionalidad1->nombre_pais ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Pais Nacimiento)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-book"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php switch ($paciente->persona->estado_civil) {
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
                                                    class="txt-color-darken"><?php echo $paciente->persona->ocupacion ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Ocupacion o Trabajo)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-envelope"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $paciente->persona->email ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Correo Electronico)</small>
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-3">
                                    <h1>
                                        <small>Informacion de Paciente</small>
                                    </h1>
                                    <ul class="list-unstyled">
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-file-code-o"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><strong><?php echo $paciente->codigo_paciente ?></strong></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Codigo Paciente)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-flask"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php switch ($paciente->grupo_sanguineo) {
                                                        case 0:
                                                            echo '---';
                                                            break;
                                                        case 1:
                                                            echo 'O+';
                                                            break;
                                                        case 2:
                                                            echo 'A+';
                                                            break;
                                                        case 3:
                                                            echo 'A-';
                                                            break;
                                                        case 4:
                                                            echo 'B+';
                                                            break;
                                                        case 5:
                                                            echo 'B-';
                                                            break;
                                                        case 6:
                                                            echo 'AB+';
                                                            break;
                                                        case 7:
                                                            echo 'AB-';
                                                            break;
                                                        case 8:
                                                            echo 'O-';
                                                            break;
                                                    } ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Grupo Sanguineo)</small>
                                            </p>
                                        </li>
                                    </ul>
                                    <h1>
                                        <small>Informacion de Contacto</small>
                                    </h1>
                                    <?php $valor = explode("-", $paciente->responsable, 4); ?>
                                    <ul class="list-unstyled">
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-user"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $valor[0] ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Nombre Completo)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-exchange"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $valor[1] ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Parentesco)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-phone"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $valor[2] ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Telefono de Contacto)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-map-marker"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $valor[3] ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Direccion de Contacto)</small>
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <h1>
                                        <small>Informacion de Seguros Clinicos</small>
                                    </h1>
                                    <ul class="list-unstyled">

                                    </ul>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <?php echo CHtml::link('<i class="fa fa-book"></i> Seguro de paciente', array('paciente/seguroPaciente', 'id' => $paciente->id_paciente), array('class' => 'btn btn-primary')); ?>
                            <?php echo CHtml::link('<i class="fa fa-edit"></i> Editar Paciente', array('paciente/update', 'id' => $paciente->id_paciente), array('class' => 'btn btn-primary')); ?>
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


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
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Detalle de Empleado</legend>
                            <br>
                            <div class="row">
                                <div class="col-sm-2 profile-pic">
                                    <img src="images/<?php echo $empleado->id_empleado ?>/photo.png" alt="demo user">
                                    <div class="padding-10">
                                        <h4 class="font-md">
                                            <strong><?php echo $empleado->empleadoPersona->num_doc ?></strong>
                                            <br>
                                            <small><?php switch ($empleado->empleadoPersona->tipo_doc) {
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
                                        <h4 class="font-md"><strong><?php switch ($empleado->empleadoPersona->genero) {
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
                                        <h4 class="font-md"><strong><?php switch ($empleado->estado_emp) {
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
                                    <h1><?php echo $empleado->empleadoPersona->nombres ?> <span
                                            class="semi-bold"><?php echo $empleado->empleadoPersona->primer_apellido . ' ' . $empleado->empleadoPersona->segundo_apellido ?></span>
                                        <br>
                                        <small></small>
                                    </h1>

                                    <ul class="list-unstyled">
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo date('d/m/Y', strtotime($empleado->empleadoPersona->fecha_nac)) ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Fecha Nacimiento)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-phone"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $empleado->empleadoPersona->telefono ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Telefono o Celular)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-map-marker"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $empleado->empleadoPersona->localidad . ' - ' . $empleado->empleadoPersona->domicilio ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Localidad - Domicilio)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-flag"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $empleado->empleadoPersona->nacionalidad1->nombre_pais ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Pais Nacimiento)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-book"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php switch ($empleado->empleadoPersona->estado_civil) {
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
                                                    class="txt-color-darken"><?php echo $empleado->empleadoPersona->ocupacion ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Ocupacion o Trabajo)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-envelope"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $empleado->empleadoPersona->email ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Correo Electronico)</small>
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-3">
                                    <h1>
                                        <small>Informacion de Empleado</small>
                                    </h1>
                                    <ul class="list-unstyled">
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-calendar"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $empleado->fecha_contratacion ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Fecha de Contratacion)</small>
                                            </p>
                                        </li>
                                        <li>
                                            <p class="text-muted">
                                                <i class="fa fa-calculator"></i>&nbsp;&nbsp;<span
                                                    class="txt-color-darken"><?php echo $empleado->cod_maquina ?></span>&nbsp;&nbsp;&nbsp;
                                                <small>(Codigo Maquina)</small>
                                            </p>
                                        </li>
                                    </ul>
                                    <?php if ($empleado->empleadoPersona->medico) { ?>
                                        <h1>
                                            <small>Informacion del Medico</small>
                                        </h1>
                                        <ul class="list-unstyled">
                                            <li>
                                                <p class="text-muted">
                                                    <i class="fa fa-code"></i>&nbsp;&nbsp;<span
                                                        class="txt-color-darken"><?php echo $empleado->empleadoPersona->medico->matricula ?></span>&nbsp;&nbsp;&nbsp;
                                                    <small>(Codigo Matricula)</small>
                                                </p>
                                            </li>
                                            <li>
                                                <p class="text-muted">
                                                    <i class="fa fa-code"></i>&nbsp;&nbsp;<span
                                                        class="txt-color-darken"><?php echo $empleado->empleadoPersona->medico->estado ?></span>&nbsp;&nbsp;&nbsp;
                                                    <small>(Codigo Matricula)</small>
                                                </p>
                                            </li>
                                        </ul>
                                    <?php } ?>
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
                            <?php echo CHtml::link('<i class="fa fa-edit"></i> Editar Empleado', array('empleado/update', 'id' => $empleado->id_empleado), array('class' => 'btn btn-primary')); ?>
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


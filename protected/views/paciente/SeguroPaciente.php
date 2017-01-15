<?php
/* $this ServicioController */
$this->pageTitle = "Paciente <span></span>";
$this->breadcrumbs = array(
    'Paciente',
);
$this->renderPartial('/layouts/_cardProfile', ['historialModel' => $paciente->historialMedico]); ?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Informacion de Seguro de Paciente</legend>
                            <br>
                            <div class="row">
                                <div class="col-md-10 col-lg-offset-1">
                                    <?php if ($listAsegurado != []) { ?>
                                        <table class="table table-responsive table-bordered">
                                            <tr>
                                                <th>Nombre del Convenio</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Actulizacion</th>
                                                <th>Tipo Asegurado</th>
                                                <th>Paciente Titular</th>
                                            </tr>
                                            <?php foreach ($listAsegurado as $item) { ?>
                                                <tr>
                                                    <td><?php echo $item->pacienteConvenio->nombre_convenio ?></td>
                                                    <td><?php echo $item->fecha_inicio ?></td>
                                                    <td><?php echo $item->fecha_edicion ?></td>
                                                    <td><?php echo $item->tipo_asegurado ?></td>
                                                    <td><?php echo $item->pacienteTitular->persona->getNombreCompleto() ?></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    <?php } else {
                                        ?>
                                        <div class="alert alert-info fade in">
                                            <i class="fa-fw fa fa-info"></i>
                                            <strong> Info.</strong> El Paciente no cuenta con un Seguro.
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <?php echo CHtml::link('<i class="fa fa-medkit"></i> Asegurar a Paciente', array('paciente/seguroCreate', 'id' => $paciente->id_paciente), array('class' => 'btn btn-primary')); ?>
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


<?php
    $infoPersona = $historialModel->paciente->persona;
?>
<style>
    .card-profile{
        border: solid 1px #3c8dbc!important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="well well-light well-sm card-profile">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-1">
                            <img src="images/<?php echo $infoPersona->id_persona ?>/photo.png" alt=""
                                 class="img-responsive img-thumbnail">
                        </div>
                        <div class="col-md-6">
                            <h1><?php echo $infoPersona->nombres;?> <span class="semi-bold"><?php echo $infoPersona->primer_apellido.' '.$infoPersona->segundo_apellido;?></span>
                                <br>
                                <small> CSA-<?php echo $infoPersona->paciente->codigo_paciente;?></small>
                            </h1>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-unstyled">
                                <li>
                                    <p class="text-muted">
                                        <i class="fa fa-credit-card"></i> <span class="txt-color-darken"><?php echo $infoPersona->num_doc;?></span>
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted">
                                        <i class="fa fa-phone"></i> <span class="txt-color-darken"><?php echo $infoPersona->telefono;?></span>
                                    </p>
                                </li>
                                <li>
                                    <p class="text-muted">
                                        <i class="fa fa-birthday-cake"></i> <span class="txt-color-darken"><?php echo HelpTools::getDate($infoPersona->fecha_nac)->format('d/m/Y');?></span> <span class="txt-color-teal">(<?=  HelpTools::getDate($infoPersona->fecha_nac)->diff(new DateTime())->format('%y') ?>)</span>
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-1">
                            <div class="btn-group-vertical pull-right">
                                <a href="<?= CHtml::normalizeUrl(['Paciente/DetallePaciente','id'=>$infoPersona->paciente->id_paciente])?>" class="btn btn-primary btn-xs">Detalle</a>
                                <a href="<?= CHtml::normalizeUrl(['historialMedico/index','id_paciente'=>$infoPersona->paciente->id_paciente])?>" class="btn btn-primary btn-xs">Historial medico</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
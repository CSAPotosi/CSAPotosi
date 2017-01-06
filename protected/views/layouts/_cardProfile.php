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
                                        <i class="fa fa-birthday-cake"></i> <span class="txt-color-darken"><?php echo $infoPersona->fecha_nac;?></span> <span class="txt-color-teal">(12)</span>
                                    </p>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-1">
                            <div class="btn-group-vertical pull-right">
                                <button class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> Mas info.</button>
                                <button class="btn btn-primary btn-xs"><i class="fa fa-files-o"></i> Historial</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="text">
        <?php if($pacienteList):?>
            <?php foreach ($pacienteList as $paciente):?>
                <div class="col-sm-2 col-md-2 col-lg-2">
                    <div class="well text-center connect">
                        <img src="images/<?php echo $paciente->id_paciente ?>/photo.png" alt="img" class="margin-bottom-5 margin-top-5" width="50%" height="50%">
                        <br>
                        <span class="font-xs">
                            <p style="color:#000"><?php echo $paciente->persona->nombreCompleto;?></p>
                            <b style="color:#000"><?php echo $paciente->persona->num_doc;?></b>
                        </span>
                        <button class="btn btn-xs btn-primary margin-top-5 margin-bottom-5 select-person"
                                data-id="<?php echo $paciente->id_paciente;?>"
                                data-name="<?php echo $paciente->persona->nombreCompleto;?>"
                                data-doc="<?php echo $paciente->persona->num_doc;?>"
                                type="button">
                            <span class="font-xs">Seleccionar</span>
                        </button>
                    </div>
                </div>
            <?php endforeach;?>
        <?php endif;?>
    </div>
</div>
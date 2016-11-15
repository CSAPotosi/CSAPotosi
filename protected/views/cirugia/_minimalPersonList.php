<fieldset>
    <?php if($medicoList):?>
    <legend>Medicos</legend>
    <div class="row">
        <div class="text">
                <?php foreach ($medicoList as $medico):?>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <div class="well text-center connect">
                            <img src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" alt="img" class="margin-bottom-5 margin-top-5" width="50%" height="50%">
                            <br>
                        <span class="font-xs">
                            <p style="color:#000"><?php echo $medico->persona->nombres;?></p>
                            <b style="color:#000"><?php echo $medico->persona->num_doc;?></b>
                        </span>
                            <button class="btn btn-xs btn-primary margin-top-5 margin-bottom-5 select-person"
                                    data-id="<?php echo $medico->id_medico;?>"
                                    data-name="<?php echo $medico->persona->nombres;?>"
                                    data-doc="<?php echo $medico->persona->num_doc;?>"
                                    type="button">
                                <span class="font-xs">Seleccionar</span>
                            </button>
                        </div>
                    </div>
                <?php endforeach;?>

        </div>
    </div>
    <?php endif;?>

    <?php if($enfList):?>
    <legend>Enfermer@</legend>
    <div class="row">
        <div class="text">
                <?php foreach ($enfList as $enf):?>
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <div class="well text-center connect">
                            <img src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" alt="img" class="margin-bottom-5 margin-top-5" width="50%" height="50%">
                            <br>
                        <span class="font-xs">
                            <p style="color:#000"><?php echo $enf->persona->nombres;?></p>
                            <b style="color:#000"><?php echo $enf->persona->num_doc;?></b>
                        </span>
                            <button class="btn btn-xs btn-primary margin-top-5 margin-bottom-5 select-person"
                                    data-id="<?php echo $enf->id_empleado;?>"
                                    data-name="<?php echo $enf->persona->nombres;?>"
                                    data-doc="<?php echo $enf->persona->num_doc;?>"
                                    type="button">
                                <span class="font-xs">Seleccionar</span>
                            </button>
                        </div>
                    </div>
                <?php endforeach;?>
        </div>
    </div>
    <?php endif;?>
</fieldset>

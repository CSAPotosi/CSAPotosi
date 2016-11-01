<?php if ($cargo == array()) { ?>
    <div class="alert alert-block alert-warning">
        <h1 class="alert-heading">Advertencia!!!</h1>
        <strong><h1 align="center">No exite Empleado!!!</h1></strong>
        <input type="hidden" name="Registro[id_asignacion]" id="id_asignacion" value="">
    </div>
<?php } else {
    ?>
    <div class="alert alert-info alert-block">
        <h1 class="alert-heading">Informacion!</h1>
        <h1>
            <center><label><?php echo $cargo[0] ?></label><br>
                <label><?php echo $cargo[1] ?></label></center>
        </h1>
        <input type="hidden" name="Registro[id_asignacion]" id="id_asignacion" value="<?php echo $cargo[2] ?>">
    </div>
    <?php
} ?>

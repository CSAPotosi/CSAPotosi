<?php if($evoList):?>
<fieldset>
    <legend>Lista de evolucion</legend>
    <table class="table table-bordered table-hover table-striped table-condensed">
        <thead>
        <tr>
            <th>USUARIO</th>
            <th width="15%">FECHA Y HORA</th>
            <th width="45%">EXPLORACION</th>
            <th width="40%">ESTADO DEL PACIENTE</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($evoList as $eItem):?>
            <tr>
                <td><?= $eItem->usuario->nombre_usuario?></td>
                <td><?php echo date('d/m/Y H:i', strtotime($eItem->fecha_evo));?></td>
                <td><?php echo $eItem->exploracion_evo;?></td>
                <td><?php echo $eItem->estado_paciente;?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</fieldset>
<?php endif;?>
<?php
    $index = 1;
    $listPautas = [];
?>
<legend>Receta</legend>
<?php if($rList):?>
    <table class="table table-responsive table-bordered table-condensed table-hover table-stripped">
        <thead>
        <tr>
            <th colspan="5" style="text-align: center">MEDICAMENTOS</th>
        </tr>
        <tr>
            <th width="5%">#</th>
            <th width="45%">Nombre</th>
            <th width="25%">Presentacion</th>
            <th width="15%">Concentracion</th>
            <th width="10%">Cant.</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rList as $rItem):?>
            <tr>
                <th><?php echo $index?></th>
                <td>
                    <?php echo $rItem->medicamento->nombre_med;
                    ?>
                </td>
                <td><?php echo $rItem->medicamento->forma_farm;?></td>
                <td><?php echo $rItem->medicamento->concentracion;?></td>
                <td><?php echo $rItem->cant_solicitada;?></td>
            </tr>
            <?php
                $listPautas[] = "<tr><th>{$index}</th><td>{$rItem->via}</td><td>{$rItem->pauta}</td></tr>";
                $index++;
            ?>
        <?php endforeach;?>
        </tbody>
    </table>
    <table class="table table-responsive table-bordered table-condensed table-hover table-stripped">
        <thead>
        <tr>
            <th colspan="3" style="text-align: center">PAUTAS</th>
        </tr>
        <tr>
            <th width="5%">#</th>
            <th width="25%">Via</th>
            <th width="70%">Pauta</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($listPautas as $itemPauta)
            echo $itemPauta;
        ?>
        </tbody>
    </table>
<?php else:?>
    <div class="alert alert-info">
        <strong>ATENCION. </strong>
        No se ha registrado medicamentos en este tratamiento.
    </div>
<?php endif;?>
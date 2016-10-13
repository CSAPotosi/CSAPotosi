<?php
    $current_id = ($currentIModel)?$currentIModel->id_inter:0;
?>
<!--todo-pacf: Agregar mas info a la lista-->
<?php if($iList):?>
<table class="table table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th>FECHA Y HORA INGRESO</th>
            <th>FECHA Y HORA SALIDA</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($iList as $iItem):?>
        <tr class="<?php echo ($iItem->id_inter == $current_id)?'info':'';?>">
            <td><?php echo date('d/m/Y H:i',strtotime($iItem->fecha_ingreso));?></td>
            <td><?php
                if($iItem->fecha_alta)
                    echo date('d/m/Y H:i',strtotime($iItem->fecha_alta));
                ?>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php else:?>
    <h4 class="alert alert-info">No se han encontrado resultados</h4>
<?php endif;?>


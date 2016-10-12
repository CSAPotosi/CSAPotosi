<?php if($salas): ?>
<table class="table table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th width="20%">CODIGO</th>
            <th width="20%">TIPO</th>
            <th width="30%">FECHA Y HORA ENTRADA</th>
            <th width="30%">FECHA Y HORA SALIDA</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($salas as $salaInter):?>
        <tr class="<?php echo ($salaInter->fecha_salida)?'':'info';?>">
            <td><?php echo CHtml::encode($salaInter->sala->cod_sala);?></td>
            <td><?php echo CHtml::encode($salaInter->sala->tSala->servicio->nombre_serv);?></td>
            <td><?php echo date('d/m/Y H:i',strtotime($salaInter->fecha_entrada));?></td>
            <?php if($salaInter->fecha_salida):?>
            <td><?php echo date('d/m/Y H:i',strtotime($salaInter->fecha_salida));?></td>
            <?php else:?>
            <td></td>
            <?php endif;?>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php else: ?>
    <h4 class="alert alert-info">No se han encontrado resultados</h4>
<?php endif;?>
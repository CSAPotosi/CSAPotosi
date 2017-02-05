<?php if($notasList):?>
<table class="table table-bordered table-hover table-condensed">
    <thead>
    <tr>
        <th width="15%">FECHA Y HORA</th>
        <th width="10%">ESTADO DE SALUD</th>
        <th width="20%">DIETA (INDICADA)</th>
        <th width="20%">DIETA (ACEPTADA)</th>
        <th width="15%">EVACUACIONES</th>
        <th width="10%">URESIS</th>
        <th width="10%">VOMITO</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($notasList as $nota):?>
        <tr>
            <td><?php echo date('d/m/Y H:i',strtotime($nota->fecha_n_enf));?></td>
            <td><?php echo $nota->estado_salud;?></td>
            <td><?php echo $nota->dieta_indicada;?></td>
            <td><?php echo $nota->dieta_aceptada;?></td>
            <td><?php echo $nota->evacuaciones;?></td>
            <td><?php echo $nota->uresis;?></td>
            <td><?php echo $nota->vomito;?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php else:?>
    <div class="alert alert-info">
        <strong>Atencion!!!. </strong>
        Aun no se han registrado notas.
    </div>
<?php endif;?>
<?php if($notasList):?>
<table class="table table-bordered table-hover table-condensed">
    <thead>
    <tr>
        <th width="15%">Fecha y hora</th>
        <th width="10%">Estado salud</th>
        <th width="20%">Dieta (indicada)</th>
        <th width="20%">Dieta (aceptada)</th>
        <th width="15%">Evacuaciones</th>
        <th width="10%">Uresis</th>
        <th width="10%">Vomito</th>
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
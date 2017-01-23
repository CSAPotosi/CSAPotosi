
<legend>Detalle de diagnostico</legend>
<table class="table table-responsive table-hover table-bordered table-condensed">
    <tbody>
        <tr>
            <th width="15%" style="text-align: right">FECHA Y HORA</th>
            <td><?php echo date('d/m/Y H:i',strtotime($dModel->fecha_diag));?></td>
        </tr>
        <tr>
            <th width="15%" style="text-align: right">ANAMNESIS</th>
            <td><?php echo $dModel->anamnesis;?></td>
        </tr>
        <tr>
            <th width="15%" style="text-align: right">EXPLORACION</th>
            <td><?php echo $dModel->exploracion;?></td>
        </tr>
        <tr>
            <th width="15%" style="text-align: right">CONCLUSION</th>
            <td><?php echo $dModel->conclusion;?></td>
        </tr>
        <tr>
            <th width="15%" style="text-align: right">OBSERVACIONES</th>
            <td><?php echo $dModel->observaciones;?></td>
        </tr>
    </tbody>
</table>

<?php if($dModel->itemCies):?>
<legend>Clasificacion Internacional de Enfermedades (CIE10)</legend>
<table class="table table-bordered table-hover table-responsive table-condensed">
    <thead>
        <tr>
            <th width="15%">CODIGO</th>
            <th width="85%">TITULO</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>CIE</td>
            <td>ELEMENTO</td>
        </tr>
        <tr>
            <td>CIE</td>
            <td>ELEMENTO</td>
        </tr>
    </tbody>
</table>
<?php endif;?>
<style>
    .table-receta tbody tr th{
        text-align: right;
    }
</style>
<fieldset>
    <legend>Tratamiento</legend>
    <table class="table table-responsive table-bordered table-hover table-condensed table-receta">
        <tbody>
        <tr>
            <th width="20%">FECHA Y HORA</th>
            <td><?php echo date('d/m/Y H:i',strtotime($tModel->fecha_trat));?></td>
        </tr>
        <tr>
            <th>INSTRUCCIONES</th>
            <td><?php echo $tModel->instrucciones;?></td>
        </tr>
        <tr>
            <th>OBSERVACIONES</th>
            <td><?php echo $tModel->observaciones;?></td>
        </tr>
        </tbody>
    </table>
    <?php $this->renderPartial('_detailReceta',['rList'=>$tModel->recetas]);?>
</fieldset>

<style>
    #params-table tbody tr{
        cursor: pointer;
    }
    .selected-param{
        background: #357ca5;
        color: #FFF;
    }
</style>

<table class="table table-bordered table-stripped" style="color: #000;" id="params-table">
    <thead>
    <tr>
        <th width="70%">
            Nombre
        </th>
        <th width="30%">
            Ext.
        </th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($paramsList as $param):?>
        <tr  data-id="<?php echo $param->id_par;?>" data-nombre="<?php echo $param->nombre_par;?>"  data-ext="<?php echo $param->ext_par;?>" >
            <td><?php echo $param->nombre_par;?></td>
            <td><?php echo $param->ext_par;?></td>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>
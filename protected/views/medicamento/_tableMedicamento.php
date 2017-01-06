<?php if(count($mediList)>0):?>
    <table class="table table-hovered table-bordered table-striped table-condensed" id="medic-table">
        <thead>
        <?php if(!$selectable):?>
        <tr class="hasinput">
            <th><input type="text" class="form-control" placeholder="CODIGO"></th>
            <th><input type="text" class="form-control" placeholder="MEDICAMENTO"></th>
            <th><input type="text" class="form-control" placeholder="FORMA FARM."></th>
            <th><input type="text" class="form-control" placeholder="CONCENTRACION"></th>
            <th><input type="text" class="form-control" placeholder="A.T.Q."></th>
            <th></th>
        </tr>
        <?php endif;?>
        <tr>
            <th width="10%">Codigo</th>
            <th width="50%%">Medicamento</th>
            <th width="15%">Forma farmaceutica</th>
            <th width="15%">Concentracion</th>
            <th width="5%">Clasificacion A.T.Q.</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($mediList as $medi):?>
            <tr>
                <td><?php echo $medi->codigo; ?></td>
                <td>
                    <span class="text-normal">
                    <?php echo $medi->nombre_med;?>
                    </span>
                    <?php echo ($medi->restringido)?'<i class="font-xs text-danger"> (restringido)</i>':''; ?>
                </td>
                <td><?php echo $medi->forma_farm;?></td>
                <td><?php echo $medi->concentracion;?></td>
                <td><?php echo $medi->ATQ;?></td>
                <td>
                    <?php if($selectable):?>
                        <button type="button" class="btn btn-xs btn-primary btn-item-select">
                            <i class="fa fa-hand-o-right"></i>
                            Seleccionar
                        </button>
                    <?php endif;?>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
<?php else:?>
    <div class="alert alert-info">
        <strong>No se han encontrado items.</strong>
    </div>
<?php endif;?>

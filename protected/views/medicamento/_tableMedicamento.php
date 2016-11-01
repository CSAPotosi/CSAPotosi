<?php if(count($mediList)>0):?>
    <table class="table table-hovered table-bordered">
        <thead>
        <tr>
            <th width="5%">Codigo</th>
            <th width="55%%">Medicamento</th>
            <th width="15%">Forma farmaceutica</th>
            <th width="15%">Concentracion</th>
            <th width="5%">Clasificacion A.T.Q.</th>
            <th width="5%"></th>
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
                    <?php else:?>
                        hola mundo
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

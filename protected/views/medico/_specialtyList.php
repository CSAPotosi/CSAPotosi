<?php if ($listSpecialty != null) { ?>
        <div class="table-responsive">
            <table class="table table-responsive table-bordered" id="desasignar">
                <thead>
                <tr>
                    <th>Nombre de Especialidad</th>
                    <th>Descripcion</th>
                    <th>Asignar</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($listSpecialty as $item): ?>
                    <tr id="<?php echo $item->id_especialidad ?>">
                        <td><?php echo $item->nombre_especialidad; ?></td>
                        <td><?php echo $item->descripcion; ?></td>
                        <td class="valor">
                            <input type="checkbox" class="especialidad" value="<?php echo $item->id_especialidad ?>">
                            <div name="valor1">
                                <?php echo CHtml::activeHiddenField($modelMedicoEspe, "[" . $item->id_especialidad . "]id_especialidad", array('value' => $item->id_especialidad, 'disabled' => 'disabled')) ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                endforeach; ?>
                </tbody>
            </table>
        </div>
<?php } else { ?>
    <div class="alert alert-info fade in">
        <button class="close" data-dismiss="alert">
            ×
        </button>
        <i class="fa-fw fa fa-info"></i>
        <strong>Informacion!</strong> No existen especialidades
    </div>
<?php } ?>
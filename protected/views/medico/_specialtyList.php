<?php if ($listSpecialty != null) { ?>
    <div id="Layer1" style="height:320px; overflow: scroll;">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <caption class="text-align-center"><h5>Lista de Cargos por unidad</h5></caption>
                <tr>
                    <th>Nombre de Especialidad</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                    <th>Asignar</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($listSpecialty as $item): ?>
                    <tr>
                        <td><?php echo $item->nombre_especialidad; ?></td>
                        <td><?php echo $item->descripcion; ?></td>
                        <td class="text-align-right"><?php echo CHtml::link('Editar', array(), array('class' => 'btn btn-info')); ?></td>
                        <td></td>
                    </tr>
                    <?php
                endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="4"
                        class="text-align-right">
                        <button type="button" class="btn btn-primary" data-target="#modalEspecialidad"
                                data-toggle="modal"><b>Agregar Especialidad</b></button>
                    </td>
                </tr>

                </tfoot>
            </table>
        </div>
    </div>
<?php } else { ?>

    <center><h5>Lista de Especialidades Registradas</h5></center><br>
    <div class="alert alert-info fade in">
        <button class="close" data-dismiss="alert">
            ×
        </button>
        <i class="fa-fw fa fa-info"></i>
        <strong>Informacion!</strong> No existen especialidades
    </div>
    <button type="button" class="btn btn-primary" data-target="#modalEspecialidad" data-toggle="modal"><b>Agregar
            Especialidad</b></button>
<?php } ?>
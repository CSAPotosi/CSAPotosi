<?php if ($listaEmpleadosAsistencia != null) { ?>
    <div class="row">
        <div class="col-md-12">
            <h2><span
                    class="label label-default">Fecha Inicio <?php echo date('d-m-Y', strtotime($listaEmpleadosAsistencia[0][6])) ?>
                    |  Fecha Fin <?php echo date('d-m-Y', strtotime($listaEmpleadosAsistencia[0][7])) ?></span></h2>
        </div>
    </div>
    <table class="table table-bordered table-responsive table-hover" align="center">
        <tr>
            <th>Unidad</th>
            <th>Cargo de Enpleado</th>
            <th>Nombre Empleado</th>
            <th>Dias Trabajados. En dias</th>
            <th>Horas Trabajadas. En (H:m:s)</th>
            <th>Minutos de retraso. En minutos</th>
            <th>Accion</th>
        </tr>
        <?php foreach ($listaEmpleadosAsistencia as $item) { ?>
            <tr>
                <?php for ($i = 0; $i < count($item) - 3; $i++) { ?>
                    <td><?php echo $item[$i] ?></td>
                <?php } ?>
                <td><?php echo CHtml::link("<i class=\"fa fa-list\"></i> Ver Detalle",
                        array('Registro/detalleAsistencia',
                            'fecha_ini' => "$item[6]", 'fecha_fin' => "$item[7]", 'empleado' => "$item[8]"),
                        array('target' => '_blank', 'class' => 'btn btn-primary btn-xs')); ?></td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <div class="alert adjusted alert-info fade in">
        <i class="fa-fw fa-lg fa fa-exclamation"></i>
        <strong>SELECCIONE ALGUN EMPLEADO(S) Y PRESIONE BUSCAR!!!
    </div>
<?php } ?>

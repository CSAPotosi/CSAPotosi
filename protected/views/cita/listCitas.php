<table class="table table-responsive table-bordered table-hover"
       id="table-paciente">
    <thead>
    <tr>
        <th>Paciente</th>
        <th>Especialidad</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Estado Cita</th>
        <th>Accion</th>
    </tr>
    </thead>
    <tbody>
    <?php

    ?>
    <?php foreach ($listCitas as $item) { ?>
        <tr>
            <td><?php echo $item->paciente->persona->getNombreCompleto() ?></td>
            <td><?php echo $item->medicoConsultaServicio->idEspecialidad->nombre_especialidad ?></td>
            <td><?php echo $item->fecha ?></td>
            <td><?php echo $item->hora_cita ?></td>
            <td><?php switch ($item->estado_cita) {
                    case 0:
                        echo "Reservado";
                        break;
                    case 1:
                        echo "Confirmado";
                        break;
                    case 2:
                        echo "Reconsulta";
                        break;
                } ?></td>
            <td><?php echo CHtml::link('<i class="fa fa-eye"></i>',
                    array('Cita/Update', 'id' => $item->id_cita),
                    array('class' => 'btn btn-primary btn-xs', 'title' => 'Detalle')); ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
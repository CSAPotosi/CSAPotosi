<?php
/* $this ServicioController */
$this->pageTitle = "Asignacion <span> > Asignacionn Empleado</span>";
$this->breadcrumbs = array(
    'Asignacion Empleado',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body no-padding">
                        <legend class="padding-10">LISTA DE CONEVENIOS</legend>
                        <table class="table table-hovered table-bordered" id="groups-table">
                            <thead>
                            <tr>
                                <th class="hasinput">
                                    <input type="text" class="form-control" placeholder="FECHA INICIO">
                                </th>
                                <th class="hasinput">
                                    <input type="text" class="form-control" placeholder="FECHA FIN">
                                </th>
                                <th class="hasinput">
                                    <input type="text" class="form-control" placeholder="EMPLEADO">
                                </th>
                                <th class="hasinput">
                                    <input type="text" class="form-control" placeholder="CARGO ASIGNADO">
                                </th>
                                <th class="hasinput">
                                    <select class="form-control">
                                        <option value="">TODOS</option>
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                </th>
                                <th></th>
                            </tr>
                            <tr>
                                <th width="15%" style="text-align: center">FECHA INICIO</th>
                                <th width="15%" style="text-align: center">FECHA FIN</th>
                                <th width="30%" style="text-align: center">EMPLEADO</th>
                                <th width="20%" style="text-align: center">CARGO ASIGNADO</th>
                                <th width="10%" style="text-align: center">ESTADO</th>
                                <th width="10%" style="text-align: center">ACCION</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($listAsignacion as $item): ?>
                                <tr class="val"
                                    data-nombre="<?php echo $item->empleado->empleadoPersona->getNombreCompleto() ?>">
                                    <td><?php echo $item->fecha_inicio ?></td>
                                    <td><?php echo ($item->fecha_fin == "") ? 'ACTIVO' : $item->fecha_fin ?></td>
                                    <td><?php echo $item->empleado->empleadoPersona->getNombreCompleto(); ?></td>
                                    <td><?php echo $item->cargo->nombre_cargo ?></td>
                                    <td style="text-align: center">
                                        <?php
                                        if ($item->fecha_fin)
                                            echo '<span class="label label-danger">INACTIVO</span>';
                                        else
                                            echo '<span class="label label-primary">ACTIVO</span>';
                                        ?>
                                    </td>
                                    <td class="text-align-center"><?php echo CHtml::link('<i class="fa fa-edit"></i> Editar', array('asignacionEmpleado/update', 'id' => $item->id_asignacion), array('class' => 'btn btn-primary btn-xs')); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!-- start plugins-->
<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/datatables/jquery.dataTables.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/datatables/dataTables.colVis.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/datatables/dataTables.tableTools.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/datatables/dataTables.bootstrap.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/datatable-responsive/datatables.responsive.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/paciente/seguroPaciente.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/asignacionEmpleado/index.js', CClientScript::POS_END);
?>

<!--end plugins-->


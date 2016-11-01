<?php echo CHtml::beginForm(array(), 'post', array()); ?>
<label>Nombre Del Empleado</label>
<div class="form-group">
    <div class="row">
        <div class="col-md-10">
            <input type="text" class="form-control" id="AsignacionEmpleadoNombre" disabled>
            <input type="hidden" name="AsignacionEmpleado[id_empleado]" id="AsignacionEmpleadoId" value="">
            <?php echo CHtml::error($modelAsignacionEmpleado, 'id_empleado', array('class' => 'label label-danger')); ?>

        </div>
        <div class="col-md-2">
            <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEmpleado"
                   value="Empleado">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <?php echo CHtml::activelabelEx($modelAsignacionEmpleado, 'Fecha Inicio'); ?>
            <?php echo CHtml::activedateField($modelAsignacionEmpleado, 'fecha_inicio', array('class' => 'form-control', 'placeholder' => 'Nombre de la Unidad')); ?>
            <?php echo CHtml::error($modelAsignacionEmpleado, 'fecha_inicio', array('class' => 'label label-danger')); ?>
        </div>
        <div class="col-md-6">
            <?php echo CHtml::activelabelEx($modelAsignacionEmpleado, 'Fecha Fin'); ?>
            <?php echo CHtml::activedateField($modelAsignacionEmpleado, 'fecha_fin', array('class' => 'form-control', 'placeholder' => 'Nombre de la Unidad', 'disabled' => 'disabled')); ?>
            <?php echo CHtml::error($modelAsignacionEmpleado, 'fecha_fin', array('class' => 'label label-danger')); ?>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <?php echo CHtml::activelabelEx($modelAsignacionEmpleado, 'Cargo'); ?>
            <?php echo CHtml::activedropDownList($modelAsignacionEmpleado, 'id_cargo', $modelAsignacionEmpleado->getCargo(), array('class' => 'form-control', 'placeholder' => 'Nombre de la Unidad')); ?>
            <?php echo CHtml::error($modelAsignacionEmpleado, 'id_cargo', array('class' => 'label label-danger')); ?>
        </div>
        <div class="col-md-6">

        </div>
    </div>
</div>
<tfoot><br>
<?php echo CHtml::submitButton($modelAsignacionEmpleado->isNewRecord ? 'Guardar Asignacion' : 'Actualizar Asignacion', array('class' => 'btn btn-info pull-rigth')); ?>
</tfoot>
<?php echo CHtml::endForm(); ?>

<div class="modal fade" id="modalEmpleado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    ×
                </button>
                <h4 class="modal-title" id="myModalLabel">Lista de Empleados</h4>
            </div>
            <div class="modal-body">
                <div class="widget-body">
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered">
                            <thead>
                            <tr>
                                <th>Nombre del Empleado</th>
                                <th>Ocupacion</th>
                                <th>Fecha de Contratacion</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($modelAsignacionEmpleado->getEmpleado() as $item): ?>
                                <tr>
                                    <td><?php echo $item->empleadoPersona->getNombreCompleto(); ?></td>
                                    <td><?php echo $item->empleadoPersona->ocupacion ?></td>
                                    <td><?php echo $item->fecha_contratacion ?></td>
                                    <td><?php echo ($item->estado_emp == 1) ? "Activo" : "Inactivo" ?></td>
                                    <td align="center">
                                        <button class="btn-primary select" data-id="<?php echo $item->id_empleado ?>"
                                                data-nombre="<?php echo $item->empleadoPersona->getNombreCompleto(); ?>"
                                                data-dismiss="modal" id="<?php echo $item->id_empleado ?>"><span
                                                class="glyphicon glyphicon-ok"></span></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!--start script
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/asignacionEmpleado/_form.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/select2/select2.min.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/iCheck/icheck.js', CClientScript::POS_END); ?>
end script-->

<?php if (count($empleadoList) > 0): ?>
    <?php foreach ($empleadoList as $itemEmpleado): ?>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body status">
                    <div class="who clearfix">
                        <?php if ($itemEmpleado->estado_emp == 1): ?>
                            <label for="" class="label label-danger pull-right">Activo</label>
                        <?php endif; ?>
                        <img src="images/<?php echo $itemEmpleado->id_empleado ?>/photo.png" class="online"
                             alt="">
					<span class="name">
						
					</span>
					<span class="name">
						<b><?php echo $itemEmpleado->empleadoPersona->getNombreCompleto(); ?></b>
					</span>
					<span class="from">
						<b><?php echo $itemEmpleado->empleadoPersona->num_doc; ?></b>
					</span>
                    </div>
                    <ul class="links padding-5">
                        <li><?php echo CHtml::link('Detalle', array('Empleado/DetalleEmpleado', 'id' => $itemEmpleado->empleadoPersona->id_persona), array('class' => 'btn btn-danger btn-xs')); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
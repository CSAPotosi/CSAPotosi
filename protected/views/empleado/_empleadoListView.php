<?php if (count($empleadoList) > 0): ?>
    <?php foreach ($empleadoList as $itemEmpleado): ?>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body status">
                    <div class="who clearfix">
                        <?php if ($itemEmpleado->estado_emp == 1): ?>
                            <label for="" class="label label-danger pull-right">Activo</label>
                        <?php endif; ?>
                        <img src="https://s3.amazonaws.com/wll-community-production/images/no-avatar.png" class="online"
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
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
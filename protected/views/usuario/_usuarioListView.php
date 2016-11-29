
<?php if (count($usuarioList) > 0): ?>
    <?php foreach ($usuarioList as $item): ?>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body status">
                    <div class="who clearfix">
                        <?php if ($item->estado_usuario == 1): ?>
                            <label for="" class="label label-info pull-right">Activo</label>
                        <?php else: ?>
                            <label for="" class="label label-danger pull-right">Inactivo</label>
                        <?php endif; ?>
                        <img src="https://s3.amazonaws.com/wll-community-production/images/no-avatar.png" class="online"
                             alt="">
					<span class="name">
						<b><?php echo $item->nombre_usuario; ?></b>
					</span>
					<span class="name">
						<b><?php echo $item->persona->primer_apellido . ' ' . $item->persona->segundo_apellido . ' ' . $item->persona->nombres; ?></b>
					</span>
					<span class="from">
						<b><?php echo $item->persona->num_doc; ?></b>
					</span>
                    </div>
                    <div class="btn btn-group btn-group-justified">
                        <?php echo CHtml::link('Informacion', array('usuario/view', 'id' => $item->id_usuario), array('class' => 'btn btn-primary btn-xs')); ?>
                        <?php echo CHtml::link('Editar', array('usuario/update', 'id' => $item->id_usuario), array('class' => 'btn btn-info btn-xs')); ?>
                        <?php echo CHtml::link(($item->estado_usuario) ? 'Inhabilitar' : 'Habilitar', null, array('class' => 'btn btn-danger btn-xs')); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php if (count($usuarioList) > 0): ?>
    <?php foreach ($usuarioList as $item): ?>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body status">
                    <div class="who clearfix">
                        <?php if ($item->estado_usuario == 1): ?>
                            <label for="" class="label label-danger pull-right">Activo</label>
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
                    <ul class="links padding-5">
                        <li><a href="#" class="btn btn-danger btn-xs">Ver historia</a></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

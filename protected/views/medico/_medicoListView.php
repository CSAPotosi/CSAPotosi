<?php if (count($medicoList) > 0): ?>
    <?php foreach ($medicoList as $itemMedico): ?>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body status">
                    <div class="who clearfix">
                        <?php if ($itemMedico->estado_med == 1): ?>
                            <label for="" class="label label-danger pull-right">activo</label>
                        <?php endif; ?>
                        <img src="https://s3.amazonaws.com/wll-community-production/images/no-avatar.png" class="online"
                             alt="">
					<span class="name">

					</span>
					<span class="name">
						<b><?php echo $itemMedico->persona->primer_apellido . ' ' . $itemMedico->persona->segundo_apellido . ' ' . $itemMedico->persona->nombres; ?></b>
					</span>
					<span class="from">
						<b><?php echo $itemMedico->persona->num_doc; ?></b>
					</span>
                    </div>
                    <ul class="links padding-5">

                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

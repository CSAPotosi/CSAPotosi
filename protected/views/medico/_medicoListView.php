<?php if (count($medicoList) > 0): ?>
    <?php foreach ($medicoList as $itemMedico): ?>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body status">
                    <div class="who clearfix">
                        <?php if ($itemMedico->estado_med == 1): ?>
                            <label for="" class="label label-danger pull-right">activo</label>
                        <?php endif; ?>
                        <img src="images/<?php echo $itemMedico->id_medico ?>/photo.png" class="online"
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
                        <li><?php echo CHtml::link('Detalle', array('Medico/DetalleMedico', 'id' => $itemMedico->id_medico), array('class' => 'btn btn-danger btn-xs')); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

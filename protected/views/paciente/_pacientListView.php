<?php if(count($pacienteList)>0):?>
<?php foreach ($pacienteList as $itemPaciente):?>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body status">
				<div class="who clearfix">
					<?php if($itemPaciente->estado_paciente==2):?>
					<label for="" class="label label-danger pull-right">Internado</label>
					<?php endif; ?>
					<img src="https://s3.amazonaws.com/wll-community-production/images/no-avatar.png" class="online" alt="">
					<span class="name">
						<b>CSA-<?php echo $itemPaciente->codigo_paciente;?></b>
					</span>
					<span class="name">
						<b><?php echo $itemPaciente->persona->primer_apellido.' '.$itemPaciente->persona->segundo_apellido.' '.$itemPaciente->persona->nombres; ?></b>
					</span>
					<span class="from">
						<b><?php echo $itemPaciente->persona->num_doc;?></b>
					</span>
				</div>
				<ul class="links padding-5">
					<li><a href="#" class="btn btn-danger btn-xs">Ver historia</a></li>
				</ul>
			</div>
		</div>
	</div>
<?php endforeach;?>
<?php endif;?>

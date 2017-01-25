<?php if(count($pacienteList)>0):?>
<?php foreach ($pacienteList as $itemPaciente):?>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body status">
				<div class="who clearfix">
					<?php if($itemPaciente->estado_paciente==2):?>
					<label for="" class="label label-danger pull-right">Internado</label>
					<?php endif; ?>
					<img src="images/<?php echo $itemPaciente->id_paciente ?>/photo.png" class="online" alt="">
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
				<div class="btn btn-group btn-group-justified">
					<?php echo CHtml::link('Ver Historial', array('historialMedico/index', 'id_paciente' => $itemPaciente->persona->id_persona), array('class' => 'btn btn-primary btn-xs')); ?>
					<?php echo CHtml::link('Detalle', array('Paciente/DetallePaciente', 'id' => $itemPaciente->persona->id_persona), array('class' => 'btn btn-info btn-xs')); ?>
				</div>
			</div>
		</div>
	</div>
<?php endforeach;?>
<?php endif;?>

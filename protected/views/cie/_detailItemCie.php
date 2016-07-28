<table class="table table-bordered table-striped">
	<tbody>
		<tr>
			<th width="20%">CODIGO</th>
			<td><?php echo CHtml::encode($cieModel->codigo);?></td>
		</tr>
		<tr>
			<th>TITULO</th>
			<td><?php echo CHtml::encode($cieModel->titulo);?></td>
		</tr>
		<tr>
			<th>DESCRIPCION</th>
			<td><a href="#" id="CIEdescripcion" data-type="textarea" data-pk="<?php echo CHtml::encode($cieModel->codigo);?>" data-url="<?php echo CHtml::normalizeUrl(['cie/editDescripcion']);?>" data-title="Escriba una descripcion"><?php echo CHtml::encode($cieModel->descripcion);?></a></td>
		</tr>
	</tbody>
</table>
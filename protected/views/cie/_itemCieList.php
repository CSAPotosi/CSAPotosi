<?php if(count($itemList)>0):?>
	<?php foreach ($itemList as $item):?>
		<tr>
			<td><?php echo CHtml::encode($item->codigo);?></td>
			<td><?php echo CHtml::encode($item->titulo);?></td>
			<td>
                <?php if($detail):?>
                <button class="btn btn-xs btn-primary btn-item-detail" data-toggle="modal" data-target="#modal-detail-cie" data-url="<?php echo CHtml::normalizeUrl(['cie/getDetailItemAjax']);?>" data-code="<?php echo CHtml::encode($item->codigo);?>"> <i class="fa fa-eye"></i> Detalle</button>
                <?php else:?>
                <button class="btn btn-xs btn-primary btn-select-item"><i class="fa fa-hand-o-left"></i> Seleccionar</button>
                <?php endif;?>
            </td>
		</tr>
	<?php endforeach; ?>
<?php else: ?>
	<?php for($i=0;$i<5;$i++):?>
		<tr>
			<td>&nbsp;</td>
			<td></td>
			<td></td>
		</tr>
	<?php endfor;?>
<?php endif;?>

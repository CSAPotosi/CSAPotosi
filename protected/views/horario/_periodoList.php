<div class="tab-pane fade <?php echo (!$errors)?'in active':'';?>" id="tab-p-list">
    <?php foreach ($periodoList as $itemP):?>
        <?php echo CHtml::encode($itemP->hora_entrada);?>
    <?php endforeach;?>

    <input type="checkbox" id="checkbox-1">
    <label for="checkbox-1">checkbox</label>
</div>
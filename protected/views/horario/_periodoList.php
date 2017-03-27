<style>
    
    .item-periodo{
        border-left: none;
        cursor: pointer;
    }
    .item-periodo-selected{
        border-left: solid 10px #9cb4c5;
    }

</style>
<div class="tab-pane fade <?php echo (!$errors)?'in active':'';?>" id="tab-p-list">
    <?php foreach ($periodoList as $itemP):?>
        <div class="alert alert-info item-periodo fade in"
            data-periodo="<?php echo $itemP->id_periodo;?>"
            data-start_min="<?php echo Yii::app()->dateTimeTools->convertTimeToMinutes($itemP->hora_entrada);?>"
            data-end_min="<?php echo Yii::app()->dateTimeTools->convertTimeToMinutes($itemP->hora_salida);?>"
            data-type = "<?php echo $itemP->tipo_periodo;?>"
        >
            <button class="close" data-dismiss="alert">
                &times;
            </button>
            <?php echo CHtml::encode($itemP->hora_entrada);?> -
            <?php echo CHtml::encode($itemP->hora_salida); ?> |
            <?php echo ($itemP->tipo_periodo) ? "DIA COMPLETO" : "MEDIO TIEMPO" ?>
        </div>
    <?php endforeach;?>
</div>
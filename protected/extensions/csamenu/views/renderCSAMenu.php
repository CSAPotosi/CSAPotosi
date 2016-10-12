<div class="panel-group options-menu">
    <?php foreach ($this->menu as $menuItem):?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <strong><?php echo $menuItem['label'];?></strong>
                </h4>
            </div>
            <div class="panel-body">
                <table class="table">
                    <?php foreach ($menuItem['items'] as $subMenuItem):?>
                        <tr class="<?php echo (array_key_exists('selected',$subMenuItem))?'selected':'';?>">
                            <td>
                                <?php echo CHtml::link($subMenuItem['label'],$subMenuItem['url']);?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
    <?php endforeach;?>
</div>
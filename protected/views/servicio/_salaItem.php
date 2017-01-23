<?php
    $opt_sala = [
        1 => ['title'=>'DISPONIBLE', 'toState'=>3, 'style'=>'facebook','change'=>'A MANTENIMIENTO'],
        2 => ['title'=>'OCUPADO', 'toState'=>2,'style'=> 'twitter','change'=>'OCUPADO'],
        3 => ['title'=>'MANTENIMIENTO', 'toState'=>1, 'style'=>'twitter','change'=>'A DISPONIBLE']
    ];
?>
<div class="row">
<?php if($type == 0):?>
    <div class="col-md-3" id="ninguno">
        <a href="#" class="info-tiles tiles-facebook has-footer item-sala">
            <div class="tiles-heading text-align-center">
                Ninguno
            </div>
            <div class="tiles-body text-center">
                <i class="fa fa-bed"></i>
            </div>
            <div class="tiles-footer item-sala-option option-select">
                <?php echo CHtml::activeHiddenField(new InternacionSala(),'id_sala',['value'=>'0']);?>
                Seleccionar
            </div>
        </a>
    </div>
<?php endif;?>
<?php if($salaList):?>
    <?php foreach ($salaList as $itemSala):?>
        <div class="col-md-3">
            <a class="info-tiles tiles-<?php echo $opt_sala[$itemSala->estado_sala]['style'];?> has-footer item-sala" href="#">
                <div class="tiles-heading text-align-center">
                    <?php
                        if($itemSala->estado_sala == 2){
                            echo $itemSala->internacionSala->internacion->historial->paciente->persona->nombreCompleto;
                        }
                        else
                            echo $opt_sala[$itemSala->estado_sala]['title'];
                    ?>
                </div>
                <div class="tiles-body text-center">
                    <?php echo $itemSala->cod_sala;?>
                </div>
                <?php
                    if($itemSala->estado_sala == 2)
                        echo '<div class="tiles-footer item-sala-option option-none">&nbsp;</div>';
                    else{
                        if($type == 0){
                            if($itemSala->estado_sala == 1)
                                echo '<div class="tiles-footer item-sala-option option-select">'.
                                    CHtml::activeHiddenField(new InternacionSala(),'id_sala',['value'=>$itemSala->id_sala])
                                    .'SELECCIONAR</div>';
                            else
                                echo '<div class="tiles-footer item-sala-option option-none">&nbsp;</div>';
                        }else{
                            $url = CHtml::normalizeUrl(['servicio/changeStateSalaAjax','s_id'=>$itemSala->id_sala]);
                            echo "<div class='tiles-footer item-sala-option option-state' 
                                data-to_state='{$opt_sala[$itemSala->estado_sala]['toState']}'
                                data-url='{$url}'>"
                                .$opt_sala[$itemSala->estado_sala]['change']
                            ."</div>";
                        }
                    }
                ?>
            </a>
        </div>
    <?php endforeach;?>
<?php else: ?>
    <div class="col-md-12">
        <h4 class="alert alert-info">Se han encontrado <strong>0</strong> resultados</h4>
    </div>
<?php endif;?>
</div>



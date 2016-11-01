<?php if($servItemList):?>
    <?php foreach ($servItemList as $servItem):?>
        <?php $dataS = $servItem->datosServicio;?>
        <div class="col-md-6 service" id="service-<?php echo $dataS->id_serv;?>">
            <div class="well padding-5 margin-bottom-5">
                <div class="row">
                    <div class="col-md-1">
                        <button type="button" class="btn btn-primary btn-xs select-item">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="col-md-5">
                        <?php echo $dataS->nombre_serv;?>
                    </div>
                    <div class="col-md-5">
                        <strong>Bs. </strong>
                        <?php echo $dataS->precio->monto;?>
                        <span class="pull-right" data-toggle="tooltip" data-original-title="<?php echo $dataS->entidad->razon_social;?>">
                            <i class="fa fa-info-circle"></i>
                        </span>
                    </div>
                </div>
            </div>
            <table class="hidden">
                <tr>
                    <td>
                        <button type="button" class="btn btn-danger btn-xs selected-item">
                            <i class="fa fa-minus"></i>
                        </button>
                        <?php echo CHtml::activeHiddenField(new DetallePrestacion,"[{$dataS->id_serv}]id_servicio",['value'=>$dataS->id_serv]);?>
                    </td>
                    <td>
                        <?php echo $dataS->nombre_serv;?>
                        <span class="pull-right" data-toggle="tooltip" data-original-title="<?php echo $dataS->entidad->razon_social;?>">
                            <i class="fa fa-info-circle"></i>
                        </span>
                    </td>
                    <td><?php echo $dataS->precio->monto;?></td>
                    <td>
                        <?php echo CHtml::activeTextField(new DetallePrestacion,"[{$dataS->id_serv}]cantidad",['class'=>'form-control input-xs','value'=>1]);?>
                        <?php echo CHtml::activeHiddenField(new DetallePrestacion,"[{$dataS->id_serv}]subtotal",['value'=>$dataS->precio->monto]);?>
                    </td>
                    <td class="text-align-right"><?php echo $dataS->precio->monto;?></td>
                </tr>
            </table>
        </div>
    <?php endforeach;?>
<?php endif;?>

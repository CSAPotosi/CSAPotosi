<input id="flag" type="hidden" value="1">
<div id="Layer1" style="height:180px; overflow-y: scroll;overflow-x: hidden ">
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'detalle-form-convenio-servicio',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'form-horizontal'),
    )); ?>
    <table class="table table-hover bordered" id="contenedor2">
        <tr>
            <th width="25%">Servicio</th>
            <th align="center" width="25%">Monto</th>
            <th align="center" width="25%">Opcion</th>
            <th align="center" width="25%">Descuento</th>
        </tr>
        <?php if ($listSelect != null) { ?>
            <?php foreach ($listSelect as $list): ?>
                <tr class="valor" id="<?php echo $list->servicio->id_serv ?>">
                    <td><?php echo $list->servicio->nombre_serv ?></td>
                    <td><?php echo $list->servicio->precio->monto ?></td>
                    <td class="hidden" name="datos"><?php if ($list->servicio->id_serv != 1) { ?>
                            <span class="label label-danger">inactivo</span>
                        <?php } else { ?>
                            <span class="label label-danger">activo</span>
                        <?php } ?></td>
                    <td class="hidden" name="datos"><?php echo $list->servicio->fecha_edicion ?></td>
                    <td class="hidden" name="datos"><?php echo $list->servicio->entidad->razon_social ?></td>
                    <td>
                        <input type="checkbox" checked="true" class="servicio"
                               value="<?php echo $list->servicio->id_serv ?>">
                    </td>
                    <td class="" name="ocultar">
                        <div class="input-group">
                            <?php echo CHtml::activeTextField($list, "[" . $list->servicio->id_serv . "]descuento_servicio", array('class' => 'form-control')) ?>
                            <span class="input-group-addon">%</span>
                        </div>
                        <?php echo CHtml::error($list, "[" . $list->servicio->id_serv . "]descuento_servicio", array('class' => 'label label-danger')); ?>

                    </td>
                    <td class="hidden" name="info">
                        <input type="text" value="<?php echo $convenio ?>"
                               name="ConvenioServicio[<?php echo $list->servicio->id_serv ?>][id_convenio]">
                        <input type="text" value="<?php echo $list->servicio->id_serv ?>"
                               name="ConvenioServicio[<?php echo $list->servicio->id_serv ?>][id_servicio]">
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php } ?>
    </table>
    <?php $this->endWidget(); ?>
</div>
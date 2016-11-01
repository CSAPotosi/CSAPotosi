<div id="Layer1" style="height:180px; overflow-y: scroll;overflow-x: hidden ">
    <table class="table table-hover bordered" id="contenedor1">
        <tr>
            <th align="center">Servicio</th>
            <th align="center">Monto</th>
            <th align="center">Estado Servicio</th>
            <th align="center">Fecha Actualizacion</th>
            <th align="center">Institucion</th>
            <th align="center">Opciones</th>
        </tr>
        <?php if ($listServicio != null) { ?>

            <?php foreach ($listServicio as $list): ?>
                <tr class="nombre-busca" id="<?php echo $list->id_serv ?>"
                    data-nombre="<?php echo $list->nombre_serv ?>">
                    <td><?php echo $list->nombre_serv ?></td>
                    <td><?php echo $list->precio->monto ?></td>
                    <td name="datos"><?php if ($list->activo != 1) { ?>
                            <span class="label label-danger">inactivo</span>
                        <?php } else { ?>
                            <span class="label label-info">activo</span>
                        <?php } ?></td>
                    <td name="datos"><?php echo $list->fecha_edicion ?></td>
                    <td name="datos"><?php echo $list->entidad->razon_social ?></td>
                    <td>
                        <input type="checkbox" class="servicio" value="<?php echo $list->id_serv ?>">
                    </td>
                    <td class="hidden" name="ocultar">
                        <div class="input-group">
                            <?php echo CHtml::activeTextField($convenioServicio, "[" . $list->id_serv . "]descuento_servicio", array('class' => 'form-control')) ?>
                            <span class="input-group-addon">%</span>
                        </div>
                        <?php echo CHtml::error($convenioServicio, "[" . $list->id_serv . "]descuento_servicio", array('class' => 'label label-danger')); ?>
                    </td>
                    <td class="hidden" name="info">
                        <input type="text" value="<?php echo $modelConvenio->id_convenio ?>"
                               name="ConvenioServicio[<?php echo $list->id_serv ?>][id_convenio]">
                        <input type="text" value="<?php echo $list->id_serv ?>"
                               name="ConvenioServicio[<?php echo $list->id_serv ?>][id_servicio]">
                    </td>
                </tr>
            <?php endforeach; ?>

        <?php } ?>
    </table>
</div>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/convenio/listServicio.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/iCheck/icheck.js', CClientScript::POS_END);
?>

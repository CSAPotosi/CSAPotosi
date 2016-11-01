<?php if($tList):?>
    <table class="table table-responsive table-condensed table-hover table-bordered">
        <thead>
        <tr>
            <th>Fecha y hora</th>
            <th>Instrucciones</th>
            <th>Observaciones</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($tList as $tItem):?>
                <tr>
                    <td><?php echo date('d/m/Y H:i',strtotime($tItem->fecha_trat));?></td>
                    <td><?php echo $tItem->instrucciones;?></td>
                    <td><?php echo $tItem->observaciones;?></td>
                    <td>
                        <button type="button"
                                class="btn btn-xs btn-primary btn-view-trat"
                                data-url="<?php echo CHtml::normalizeUrl(['tratamiento/getViewAjax','t_id' => $tItem->id_trat]);?>">
                            <i class="fa fa-list"></i>
                            Ver
                        </button>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>

    <div class="modal fade modal-primary" id="modal-tratamiento" data-url="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Detalle de tratamiento
                    </h4>
                </div>
                <div class="modal-body no-padding">
                    <div class="well no-margin" style="color: #000 !important;">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <?php Yii::app()->clientScript
        ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/tratamiento/index.js',CClientScript::POS_END);
    ?>
<?php else:?>
    <div class="alert alert-info">
        <strong>ATENCION. </strong>
        No se han encontrado datos para mostrar.
    </div>
<?php endif;?>

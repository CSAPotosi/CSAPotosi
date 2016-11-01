
<div class="jarviswidget" id="widget-form" data-widget-refreshbutton="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false">
    <header>
        <h2><strong>SERVICIOS SELECCIONADOS</strong></h2>
    </header>
    <div>
        <div class="widget-body no-padding">
            <fieldset>
                <legend class="padding-10">Agregar servicios</legend>
                <?php echo CHtml::beginForm([],'post',['id'=>'form-add-services']);?>
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                        <tr>
                            <th width="10%"></th>
                            <th width="30%">Servicio</th>
                            <th width="20%">P.U. (Bs.)</th>
                            <th width="20%">Cant.</th>
                            <th width="20%">Subtotal (Bs.)</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="4" class="text-align-right">Total</th>
                            <td class="text-align-right">0</td>
                        </tr>
                        </tfoot>
                    </table>
                    <button id="btn-send-prestacion" class="hidden" type="submit">X</button>
                <?php echo CHtml::endForm();?>
            </fieldset>
            <div class="widget-footer">
                <button class="btn btn-primary" id="send-form-prestacion">
                    <i class="fa fa-save"></i>
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/prestacionServicios/_prestacionForm.js',CClientScript::POS_END);
?>
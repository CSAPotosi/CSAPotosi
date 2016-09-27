<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'formDetallePrestacion',
    'action' => yii::app()->createUrl("PrestacionServicios/DetallePrestacion"),
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class' => 'form-horizontal'),
)); ?>
    <table class="table table-hover bordered" id="contenedorDetallePrestacion">
        <tr>
            <th>Estado</th>
            <th>Servicio</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Info</th>

        </tr>

    </table>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <form id="formPrestacionServicios"
                      data-url="<?php echo CHtml::normalizeUrl(array('HistorialMedico/prestacionCreate')) ?>">
                    <input type="hidden" name="PrestacionServicio[id_historial]"
                           value="<?php echo $Paciente->persona->id_persona ?>">
                    <div class="form-group">
                        <label>Observaciones</label>
                        <input type="text" name="PrestacionServicio[observaciones]" class="form-control">
                    </div>
                    <input type="hidden" name="PrestacionServicio[tipo]" value="0">
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <input type="button" value="Guardar" id="btnDetalleServicios" class="btn btn-primary">
                </div>
                <div class="col-md-4">
                    <input type="text" id="detallePrestacionTotal" class="form-control" disabled>
                </div>
            </div>
        </div>
    </div>


<?php $this->endWidget(); ?>
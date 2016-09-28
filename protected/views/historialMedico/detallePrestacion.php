<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'formDetallePrestacion',
    'action' => yii::app()->createUrl("HistorialMedico/detallePrestacion"),
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
                    <div class="form-group">
                        <label>Observaciones</label>
                        <input type="text" name="PrestacionServicio[observaciones]" class="form-control"
                               id="observacion1">
                    </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <input type="button" value="Guardar" id="btnDetalleServicios" class="btn btn-primary disabled">
                </div>
                <div class="col-md-4">
                    <input type="text" id="detallePrestacionTotal" class="form-control" disabled>
                </div>
            </div>
        </div>
    </div>


<?php $this->endWidget(); ?>
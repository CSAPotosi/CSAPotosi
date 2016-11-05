<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$dModel->historial]);?>

<section id="widget-grid">
    <div class="row">
        <div class="col-md-12">
            <div class="jarviswidget" id="widget-historial">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Formulario de evolucion</legend>
                            <?php echo CHtml::errorSummary($eModel,'<h4 class="alert-heading"><i class="fa fa-warning"></i> Debe corregir los siguientes errores:</h4>',null,['class'=>'alert alert-danger']);?>
                            <?php echo CHtml::beginForm();?>
                            <div class="row">
                                <div class="col-md-4">
                                    <?php echo CHtml::activeTextArea($eModel, 'exploracion_evo', ['class'=>'form-control','placeholder'=> 'EXPLORACION']);?>
                                    <?php echo CHtml::error($eModel,'exploracion_evo',['class'=>'label label-danger']);?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo CHtml::activeTextArea($eModel, 'estado_paciente', ['class'=>'form-control','placeholder'=>'ESTADO DE PACIENTE']);?>
                                    <?php echo CHtml::error($eModel,'estado_paciente',['class'=>'label label-danger']);?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo CHtml::activeTextArea($eModel, 'recomendaciones', ['class'=>'form-control','placeholder'=>'RECOMENDACIONES']);?>
                                    <?php echo CHtml::error($eModel,'recomendaciones',['class'=>'label label-danger']);?>
                                </div>
                                <div class="col-md-2 text-align-center">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fa fa-save"></i>
                                        Guardar
                                    </button>
                                </div>
                            </div>
                            <?php echo CHtml::endForm();?>
                        </fieldset>
                        <div class="row">
                            <div class="col-md-12">
                                <?php $this->renderPartial('_tableEvolucion',['evoList'=>$dModel->evoluciones]);?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


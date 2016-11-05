<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <?php echo CHtml::beginForm();?>
                        <fieldset>
                            <legend>Examen de <?php echo $detallePrestacion->servicio->nombre_serv;?></legend>
                            <?php echo CHtml::errorSummary(array_merge([$resultado],$detalleList),'<h4 class="alert-heading"><i class="fa fa-warning"></i> Debe corregir los siguientes errores:</h4>',null,['class'=>'alert alert-danger']);?>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <?php if($detalleList):?>
                                    <div class="row margin-bottom-10">
                                        <?php $index = 1;foreach ($detalleList as $detalle):?>
                                                <div class="col-md-4">
                                                    <label><?php echo $detalle->parametro->nombre_par;?></label>
                                                    <div class="input-group">
                                                        <?php echo CHtml::activeTextField($detalle,"[{$index}]valor_res",['class'=>'form-control']);?>
                                                        <?php echo CHtml::activeHiddenField($detalle,"[{$index}]id_par");?>
                                                        <span class="input-group-addon">
                                                            <?php echo $detalle->parametro->ext_par;?>
                                                        </span>
                                                    </div>
                                                    <?php echo CHtml::error($detalle,"[{$index}]valor_res",['class'=>'label label-danger']);?>
                                                </div>
                                            <?php $index++; endforeach;?>
                                    </div>
                                    <?php endif;?>
                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($resultado,'diagnostico_res');?>
                                        <?php echo CHtml::activeTextArea($resultado,'diagnostico_res',['class'=>'form-control']);?>
                                        <?php echo CHtml::error($resultado,'diagnostico_res',['class'=>'label label-danger']);?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($resultado,'observacion_res');?>
                                        <?php echo CHtml::activeTextArea($resultado,'observacion_res',['class'=>'form-control']);?>
                                        <?php echo CHtml::error($resultado,'observacion_res',['class'=>'label label-danger']);?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                Guardar
                            </button>
                        </div>
                        <?php echo CHtml::endForm();?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
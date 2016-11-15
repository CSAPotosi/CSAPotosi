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
                            <legend>
                                Programacion de cirugia
                            </legend>
                            <?php echo CHtml::errorSummary($parametro,'<h4 class="alert-heading"><i class="fa fa-warning"></i> Debe corregir los siguientes errores:</h4>',null,['class'=>'alert alert-danger']);?>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($parametro,'nombre_par');?>
                                        <?php echo CHtml::activeTextField($parametro,'nombre_par',['class'=>'form-control']);?>
                                        <?php echo CHtml::error($parametro,'nombre_par',['class'=>'label label-danger']);?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($parametro,'ext_par');?>
                                        <?php echo CHtml::activeTextField($parametro,'ext_par',['class'=>'form-control']);?>
                                        <?php echo CHtml::error($parametro,'ext_par',['class'=>'label label-danger']);?>
                                    </div>

                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($parametro,'tipo_par');?>
                                        <?php echo CHtml::activeDropDownList($parametro,'tipo_par',$parametro->getTipo(),['class'=>'form-control']);?>
                                        <?php echo CHtml::error($parametro,'tipo_par',['class'=>'label label-danger']);?>
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
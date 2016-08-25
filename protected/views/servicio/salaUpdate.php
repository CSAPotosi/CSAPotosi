<?php echo CHtml::errorSummary($tSala);?>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <?php echo CHtml::beginForm();?>
                        <fieldset>
                            <legend>
                                Tipo de sala
                            </legend>

                            <div class="form-group">
                                <?php echo CHtml::activeLabel($tSala,'cod_serv');?>
                                <?php echo CHtml::activeTextField($tSala, 'cod_serv',['class'=>'form-control']);?>
                                <?php echo CHtml::error($tSala, 'cod_serv');?>
                            </div>

                            <div class="form-group">
                                <?php echo CHtml::activeLabel($tSala,'nombre_serv');?>
                                <?php echo CHtml::activeTextField($tSala, 'nombre_serv',['class'=>'form-control']);?>
                                <?php echo CHtml::error($tSala, 'nombre_serv');?>
                            </div>

                            <div class="form-group">
                                <?php echo CHtml::activeLabel($tSala,'unidad_medida');?>
                                <?php echo CHtml::activeTextField($tSala, 'unidad_medida',['class'=>'form-control']);?>
                                <?php echo CHtml::error($tSala, 'unidad_medida');?>
                            </div>

                            <div class="form-group">
                                <?php echo CHtml::activeLabel($tSala,'tipo_cobro');?>
                                <?php echo CHtml::activeTextField($tSala, 'tipo_cobro',['class'=>'form-control']);?>
                                <?php echo CHtml::error($tSala, 'tipo_cobro');?>
                            </div>

                            <div class="form-group">
                                <?php echo CHtml::activeLabel($tSala,'activo');?>
                                <?php echo CHtml::activeTextField($tSala, 'activo',['class'=>'form-control']);?>
                                <?php echo CHtml::error($tSala, 'activo');?>
                            </div>

                            <div class="form-group">
                                <?php echo CHtml::activeLabel($tSala,'id_entidad');?>
                                <?php echo CHtml::activeDropDownList($tSala,'id_entidad',CHtml::listData(Entidad::model()->findAll(),'id_entidad','razon_social'),['class'=>'form-control'] )?>
                                <?php echo CHtml::error($tSala, 'id_entidad');?>
                            </div>

                            <div class="form-group">
                                <?php echo CHtml::activeLabel($tSala,'monto');?>
                                <?php echo CHtml::activeTextField($tSala, 'monto',['class'=>'form-control']);?>
                                <?php echo CHtml::error($tSala, 'monto');?>
                            </div>

                            <div class="form-group">
                                <?php echo CHtml::submitButton('Guardar',['class'=>'btn btn-primary']);?>
                            </div>

                        </fieldset>
                        <?php echo CHtml::endForm();?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<div class="tab-pane fade <?php echo ($errors)?'in active':'';?>" id="tab-p-new">
    <?php echo CHtml::beginForm(['horario/createPeriodo','id'=>$horarioModel->id_horario],'post',[]);?>
    <div class="form-group">
        <?php echo CHtml::activeLabelEx($periodoModel,'hora_entrada')?>
        <?php echo CHtml::activeTextField($periodoModel,'hora_entrada',['class'=>'form-control clockpicker','data-autoclose'=>'true']);?>
        <?php echo CHtml::error($periodoModel,'hora_entrada',['class'=>'label label-danger']);?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo CHtml::activeLabelEx($periodoModel,'inicio_entrada')?>
                <?php echo CHtml::activeTextField($periodoModel,'inicio_entrada',['class'=>'form-control spinner-both']);?>
                <?php echo CHtml::error($periodoModel,'inicio_entrada',['class'=>'label label-danger']);?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo CHtml::activeLabelEx($periodoModel,'fin_entrada')?>
                <?php echo CHtml::activeTextField($periodoModel,'fin_entrada',['class'=>'form-control spinner-both']);?>
                <?php echo CHtml::error($periodoModel,'fin_entrada',['class'=>'label label-danger']);?>
            </div>
        </div>
    </div>
    <hr>

    <div class="form-group">
        <?php echo CHtml::activeLabelEx($periodoModel,'hora_salida')?>
        <?php echo CHtml::activeTextField($periodoModel,'hora_salida',['class'=>'form-control clockpicker','data-autoclose'=>'true']);?>
        <?php echo CHtml::error($periodoModel,'hora_salida',['class'=>'label label-danger']);?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?php echo CHtml::activeLabelEx($periodoModel,'inicio_salida')?>
                <?php echo CHtml::activeTextField($periodoModel,'inicio_salida',['class'=>'form-control spinner-both']);?>
                <?php echo CHtml::error($periodoModel,'inicio_salida',['class'=>'label label-danger']);?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo CHtml::activeLabelEx($periodoModel,'fin_salida')?>
                <?php echo CHtml::activeTextField($periodoModel,'fin_salida',['class'=>'form-control spinner-both']);?>
                <?php echo CHtml::error($periodoModel,'fin_salida',['class'=>'label label-danger']);?>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <?php echo CHtml::activeLabelEx($periodoModel,'tolerancia')?>
                <?php echo CHtml::activeTextField($periodoModel,'tolerancia',['class'=>'form-control spinner-both']);?>
                <?php echo CHtml::error($periodoModel,'tolerancia',['class'=>'label label-danger']);?>
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-group">
                <?php echo CHtml::activeLabelEx($periodoModel,'tipo_periodo')?>
                <select class="form-control" name="Periodo[tipo_periodo]">
                    <option value="0">Medio Tiempo</option>
                    <option value="1">Dia Completo</option>
                </select>
                <?php echo CHtml::error($periodoModel,'tipo_periodo',['class'=>'label label-danger']);?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-block btn-primary">Guardar</button>
    </div>
    <?php echo CHtml::endForm();?>
</div>
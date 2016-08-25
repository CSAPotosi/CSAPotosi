<div class="tab-pane fade <?php echo ($errors)?'in active':'';?>" id="tab-p-new">
    <?php echo CHtml::beginForm(['horario/createPeriodo','id'=>$horarioModel->id_horario],'post',['class'=>'smart-form']);?>
    <div class="row">
        <section class="col col-4">
            <label for="" class="input">
                <?php echo CHtml::activeTextField($periodoModel,'hora_entrada');?>
            </label>
            <?php echo CHtml::error($periodoModel,'hora_entrada',['class'=>'note']);?>
        </section>
        <section class="col col-4">
            <label for="" class="input">
                <?php echo CHtml::activeTextField($periodoModel,'inicio_entrada');?>
            </label>
        </section>
        <section class="col col-4">
            <label for="" class="input">
                <?php echo CHtml::activeTextField($periodoModel,'fin_entrada');?>
            </label>
        </section>
    </div>
    <div class="row">
        <section class="col col-4">
            <label for="" class="input">
                <?php echo CHtml::activeTextField($periodoModel,'hora_salida');?>
            </label>
        </section>
        <section class="col col-4">
            <label for="" class="input">
                <?php echo CHtml::activeTextField($periodoModel,'inicio_salida');?>
            </label>
        </section>
        <section class="col col-4">
            <label for="" class="input">
                <?php echo CHtml::activeTextField($periodoModel,'fin_salida');?>
            </label>
        </section>
    </div>
    <div class="row">
        <section class="col col-6">
            <label for="" class="input">
                <?php echo CHtml::activeTextField($periodoModel,'tolerancia');?>
            </label>
        </section>
        <section class="col col-6">
            <label for="" class="input">
                <?php echo CHtml::activeTextField($periodoModel,'tipo_periodo');?>
            </label>
        </section>
    </div>
    <div class="row">
        <button type="submit" class="btn btn-block btn-primary">Guardar</button>
    </div>
    <?php echo CHtml::endForm();?>
</div>
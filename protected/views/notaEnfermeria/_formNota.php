<?php echo CHtml::beginForm(['notaEnfermeria/create','i_id'=>$iModel->id_inter]);?>
<div class="form-group">
    <?php echo CHtml::activeLabelEx($neModel,'estado_salud');?>
    <?php echo CHtml::activeTextField($neModel,'estado_salud',['class'=>'form-control']);?>
    <?php echo CHtml::error($neModel,'estado_salud',['class'=>'label label-danger error-message']);?>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo CHtml::activeLabelEx($neModel,'dieta_indicada');?>
            <?php echo CHtml::activeTextArea($neModel,'dieta_indicada',['class'=>'form-control']);?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo CHtml::activeLabelEx($neModel,'dieta_aceptada');?>
            <?php echo CHtml::activeTextArea($neModel,'dieta_aceptada',['class'=>'form-control']);?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo CHtml::activeLabelEx($neModel,'ind_medico');?>
            <?php echo CHtml::activeTextArea($neModel,'ind_medico',['class'=>'form-control']);?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <?php echo CHtml::activeLabelEx($neModel,'evacuaciones');?>
            <?php echo CHtml::activeTextArea($neModel,'evacuaciones',['class'=>'form-control']);?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo CHtml::activeLabelEx($neModel,'uresis');?>
            <?php echo CHtml::activeTextArea($neModel,'uresis',['class'=>'form-control']);?>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <?php echo CHtml::activeLabelEx($neModel,'vomito');?>
            <?php echo CHtml::activeTextArea($neModel,'vomito',['class'=>'form-control']);?>
        </div>
    </div>
</div>
<div class="form-group text-align-right">
    <button class="btn btn-primary">
        <i class="fa fa-save"></i> Registrar
    </button>
    <button type="reset" class="btn btn-danger" id="hide-form">
        <i class="fa fa-close"></i>
        Cancelar
    </button>
</div>
<?php echo CHtml::endForm();?>

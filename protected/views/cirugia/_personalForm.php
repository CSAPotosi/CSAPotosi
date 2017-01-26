<legend>
    Personal
</legend>
<div class="row">
    <div class="col-md-8 col-md-offset-2" id="personal">
        <?php $index = 0;?>
        <?php foreach ($persList as $personal):?>
        <div class="row margin-bottom-5">
            <div class="col-md-6">
                <?php if ($index == 0):?>
                <label for="">MEDICO/ENFERMERA</label>
                <?php endif;?>
                <div class="input-group">
                    <?php
                        $text = $personal->id_per?$personal->persona->nombreCompleto." ( {$personal->persona->num_doc} ) ":'';
                    ?>
                    <input type="text" class="form-control" placeholder="Buscar medico/enfermera" value="<?php echo $text;?>" disabled>
                    <?php echo CHtml::activeHiddenField($personal,"[{$index}]id_per");?>
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary btn-select-p" data-toggle="modal" data-target="#modal-personal"><i class="fa fa-search"></i> Buscar</button>
                    </div>
                </div>
                <?php echo CHtml::error($personal,"[{$index}]id_per",['class'=>'label label-danger error-message']);?>
            </div>
            <div class="col-md-4">
                <?php if ($index == 0):?>
                <label for="">ROL</label>
                <?php endif;?>
                <?php echo CHtml::activeDropDownList($personal,"[{$index}]rol_cirugia",PersonalCirugia::getRolPersonal(),['class'=>'form-control']);?>
            </div>
            <div class="col-md-1">
                <?php if ($index == 0):?>
                <label for="">RESP.</label>
                <?php endif;?>
                <div class="radio">
                    <label class="radio-label">
                        <?php echo CHtml::activeRadioButton($personal,"[{$index}]responsable",['class'=>'responsable radiobox style-0']);?>
                        <span></span>
                    </label>
                </div>
            </div>
            <div class="col-md-1">
                <?php if ($index == 0):?>
                    <label for=""></label>
                    <button type="button" class="btn btn-primary" id="add-p"><i class="fa fa-plus"></i></button>
                <?php else:?>
                    <button type="button" class="btn btn-danger remove-p"><i class="fa fa-minus"></i></button>
                <?php endif;?>
            </div>
        </div>
        <?php $index++;?>
        <?php endforeach;?>
    </div>
</div>
<div class="modal fade modal-primary" id="modal-personal" data-url="<?php echo CHtml::normalizeUrl(['cirugia/getMinimalList']);?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="modal-title">Seleccione medico/enfermera</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="input-sm form-control pull-left" placeholder="Buscar medico/enfermera">
                            <span class="input-group-addon">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body no-padding">
                <div class="well no-margin">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
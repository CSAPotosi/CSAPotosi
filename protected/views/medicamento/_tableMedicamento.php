<?= CHtml::beginForm(['medicamento/create'],'post',['id'=>'create-medicamento']);?>
    <div class="row padding-10 text-align-right" id="new-med-area">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" id="btn-new-med"><i class="fa fa-plus"></i> Nuevo</button>
        </div>
    </div>
    <div class="row padding-10 hidden" id="form-med-area">
        <div class="col-md-3">
            <div class="form-group">
                <?= CHtml::activeTextField(new Medicamento,'nombre_med',['class'=>'form-control', 'placeholder'=>'NOMBRE'])?>
                <span class="label label-danger error-message"></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?= CHtml::activeTextField(new Medicamento,'forma_farm',['class'=>'form-control', 'placeholder'=>'FORMA FARMACEUTICA'])?>
                <span class="label label-danger error-message"></span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <?= CHtml::activeTextField(new Medicamento,'concentracion',['class'=>'form-control', 'placeholder'=>'CONCENTRACION'])?>
                <span class="label label-danger error-message"></span>
            </div>
        </div>
        <div class="col-md-3 text-align-right">
            <button type="submit" class="btn btn-primary" id="btn-save-med" data-url="<?= CHtml::normalizeUrl(['medicamento/index'])?>"><i class="fa fa-save"></i> Guardar</button>
            <button type="button" class="btn btn-danger" id="btn-close-med"><i class="fa fa-close"></i> Cancelar</button>
        </div>
    </div>
<?= CHtml::endForm();?>

<?php if(count($mediList)>0):?>
    <table class="table table-hovered table-bordered table-striped table-condensed" id="medic-table">
        <thead>
        <?php if(!$selectable):?>
        <tr class="hasinput">
            <th><input type="text" class="form-control" placeholder="MEDICAMENTO"></th>
            <th><input type="text" class="form-control" placeholder="FORMA FARM."></th>
            <th><input type="text" class="form-control" placeholder="CONCENTRACION"></th>
            <th></th>
        </tr>
        <?php endif;?>
        <tr>
            <th width="40%">MEDICAMENTO</th>
            <th width="25%">FORMA FARM.</th>
            <th width="15%">CONCENTRACION</th>
            <th width="1%"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($mediList as $medi):?>
            <tr data-codigo="<?= $medi->codigo?>">
                <td>
                    <span class="text-normal">
                    <?php echo $medi->nombre_med;?>
                    </span>
                </td>
                <td><?php echo $medi->forma_farm;?></td>
                <td><?php echo $medi->concentracion;?></td>
                <td>
                    <?php if($selectable):?>
                        <button type="button" class="btn btn-xs btn-primary btn-item-select">
                            <i class="fa fa-hand-o-right"></i>
                            Seleccionar
                        </button>
                    <?php endif;?>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
<?php else:?>
    <div class="alert alert-info">
        <strong>No se han encontrado items.</strong>
    </div>
<?php endif;?>

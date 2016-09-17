<?php echo CHtml::beginForm('', 'post', array('class' => 'smart-form')); ?>
<header>
    titulo
</header>
<row class="col-md-6">
    <fieldset>
        <section>
            <?php echo CHtml::activeLabel($servicio, 'cod_serv'); ?>
            <label class="input">
                <?php echo CHtml::activeTextField($servicio, 'cod_serv', array('class' => 'form-control', 'placeholder' => 'Codigo Servicio')); ?>
            </label>
            <?php echo CHtml::error($servicio, 'cod_serv'); ?>
        </section>
        <section>
            <?php echo CHtml::activeLabel($servicio, 'nombre_serv'); ?>
            <?php echo CHtml::activeTextField($servicio, 'nombre_serv', array('class' => 'form-control', 'placeholder' => 'Nombre Servicio')); ?>
            <?php echo CHtml::error($servicio, 'nombre_serv'); ?>
        </section>

        <section>
            <?php echo CHtml::activeLabel($servicio, 'monto'); ?>
            <?php echo CHtml::activeTextField($servicio, 'monto', array('class' => 'form-control', 'placeholder' => 'Precio')); ?>
            <?php echo CHtml::error($servicio, 'monto'); ?>
        </section>

        <section>
            <?php echo CHtml::activeLabel($servicio, 'id_entidad'); ?>
            <?php echo CHtml::activeDropDownList($servicio, 'id_entidad', CHtml::listData($entidad, 'id_entidad', 'razon_social'), array('class' => 'form-control', 'placeholder' => 'Entidad')); ?>
            <?php echo CHtml::error($servicio, 'id_entidad'); ?>
        </section>
    </fieldset>
</row>
<row class="col-md-6">
    <fieldset>
        <section>
            <?php echo CHtml::activeLabel($servicio, 'condiciones_ex'); ?>
            <label class="textarea textarea-expandable">
                <?php echo CHtml::activeTextArea($servicio, 'condiciones_ex', array('class' => 'custom-scroll', 'rows' => '3', 'placeholder' => 'Condiciones')); ?>
            </label>
            <?php echo CHtml::error($servicio, 'condiciones'); ?>
        </section>
        <?php echo CHtml::activeHiddenField($servicio, 'id_cat_ex', array('id' => "id_categoria")); ?>
        <section>
            <label>CATEGORIA</label>
            <select style="width:100%" id="select2">
                <option disabled <?php echo ($servicio->id_cat_ex == null) ? 'selected' : ''; ?> > ----- Seleccione una
                    Categoria -----
                </option>
                <?php foreach ($categoria as $item): ?>
                    <option value="<?php echo $item->id_cat_ex; ?>"
                            data-descripcion="<?php echo $item->descripcion_cat_ex; ?>" <?php echo ($servicio->id_cat_ex == $item->id_cat_ex) ? 'selected' : ''; ?> >
                        <?php echo $item->nombre_cat_ex; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </section>
        <section>
            <?php echo CHtml::activeLabel($servicio, 'activo'); ?>
            <span class="onoffswitch pull-right">
                <?php echo CHtml::activeCheckBox($servicio, 'activo', ['class' => 'onoffswitch-checkbox']); ?>
                <?php echo CHtml::activeLabel($servicio, 'activo', ['class' => 'onoffswitch-label', 'label' => '<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span><span class="onoffswitch-switch"></span>']); ?>
            </span>
            <?php echo CHtml::error($servicio, 'activo'); ?>
        </section>
    </fieldset>
</row>

<div class="form-actions">
    <?php echo CHtml::submitButton(empty($servicio->idServicio) ? 'Crear' : 'Guardar', array('class' => 'btn btn-primary btn-lg')); ?>
</div>
<?php echo CHtml::endForm(); ?>

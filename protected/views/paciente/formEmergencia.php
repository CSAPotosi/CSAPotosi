<?php
/* @var $this PersonaController */
$this->pageTitle = "PACIENTE <span></span>";
$this->breadcrumbs = array(
    'Paciente',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>REGISTRO PACIENTE DE EMERGENCIA</legend>
                            <?php echo CHtml::errorSummary($modelPerson, '<h4 class="alert-heading"><i class="fa fa-warning"></i> DEBE CORREGIR LOS SIGUIENTES ERRORES </h4>', null, array('class' => 'alert alert-danger error-message')); ?>
                            <br>
                            <div class="row">
                                <div class="col-md-8 col-lg-offset-2">
                                    <?php echo CHtml::beginForm(array(), 'post', array('id' => 'wizard-1')); ?>
                                    <div class="form-group">
                                        <?php echo CHtml::activeHiddenField($modelPerson, 'num_doc', array('class' => 'form-control', 'value' => 'null')); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>NOMBRES</label>
                                        <?php echo CHtml::activeTextField($modelPerson, 'nombres', array('class' => 'form-control', 'placeholder' => 'Nombres')); ?>
                                        <?php echo CHtml::error($modelPerson, 'nombres', ['class' => 'label label-danger error-message']); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>PRIMER APELLIDO</label>
                                        <?php echo CHtml::activeTextField($modelPerson, 'primer_apellido', array('class' => 'form-control', 'placeholder' => 'Primer Apellido')); ?>
                                        <?php echo CHtml::error($modelPerson, 'primer_apellido', ['class' => 'label label-danger error-message']); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>SEGUNDO APELLIDO</label>
                                        <?php echo CHtml::activetextField($modelPerson, 'segundo_apellido', array('class' => 'form-control', 'placeholder' => 'Segundo Apellido')); ?>
                                        <?php echo CHtml::error($modelPerson, 'segundo_apellido', array('class' => 'label label-danger error-message')); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>GENERO</label>
                                        <?php echo CHtml::activedropDownList($modelPerson, 'genero', $modelPerson->getGenero(), array('class' => 'form-control')); ?>
                                        <?php echo CHtml::error($modelPerson, 'genero', array('class' => 'label label-danger error-message')); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>FECHA DE NACIMIENTO</label>
                                        <input type="datepicker" class="form-control datepicker"
                                               data-dateformat="yyyy-mm-dd" name="PersonaForm[fecha_nac]"
                                               placeholder="aaaa-mm-dd"'
                                        value="<?php echo $modelPerson->fecha_nac ?>">
                                        <?php echo CHtml::error($modelPerson, 'fecha_nac', ['class' => 'label label-danger error-message']); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo CHtml::activeHiddenField($modelPerson, 'nacionalidad', array('class' => 'form-control', 'value' => 'BOL')); ?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button class="btn btn-primary" type="sutmit"><i class='fa fa-save'></i>
                                Guardar
                            </button>
                            <?php echo CHtml::endForm(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

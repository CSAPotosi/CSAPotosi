<?php
/* $this ServicioController */
$this->pageTitle = "PACIENTE <span></span>";
$this->breadcrumbs = array(
    'Paciente',
);
?><?php $this->renderPartial('/layouts/_cardProfile', ['historialModel' => $paciente->historialMedico]); ?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <?php echo CHtml::beginForm(array(), 'post', array()); ?>
                        <fieldset>
                            <legend>CREAR SEGURO</legend>
                            <br>
                            <div class="col-md-10 col-lg-offset-1">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>TIPO DE ASEGURADO</label>
                                            <?php echo CHtml::activedropDownList($modelAsegurado, 'tipo_asegurado', $modelAsegurado->getTipoAsegurado(), array('class' => 'form-control')); ?>
                                            <?php echo CHtml::error($modelAsegurado, 'tipo_asegurado', array('class' => 'label label-danger error-message')); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>FECHA INICIO</label>
                                            <?php echo CHtml::activeTextField($modelAsegurado, 'fecha_inicio', array('class' => 'form-control datepicker', 'data-dateformat' => 'dd/mm/yy', 'placeholder' => 'dd/mm/aaaa')); ?>
                                            <?php echo CHtml::error($modelAsegurado, 'fecha_inicio', ['class' => 'label label-danger error-message']); ?>
                                            <?php echo CHtml::error($modelAsegurado, 'fecha_inicio', ['class' => 'label label-danger error-message']); ?>
                                        </div>
                                        <div class="form-group">
                                            <label>CONVENIO</label>
                                            <?php echo CHtml::activedropDownList($modelAsegurado, 'convenio', $modelAsegurado->getConvenios(), array('class' => 'form-control')); ?>
                                            <?php echo CHtml::error($modelAsegurado, 'convenio', ['class' => 'label label-danger error-message']); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo CHtml::activeHiddenField($modelAsegurado, 'id_paciente_titular', array('class' => 'form-control')); ?>

                                            <?php echo CHtml::activeHiddenField($modelAsegurado, 'id_paciente', array('class' => 'form-control', 'value' => $paciente->id_paciente)); ?>
                                        </div>
                                        <div id="contenedor_paciente" class="hide">
                                            <h1 align="center">Paciente titular</h1>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="paciente_titular">
                                                <?php echo CHtml::error($modelAsegurado, 'id_paciente_titular', ['class' => 'label label-danger error-message']); ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="jarviswidget jarviswidget-color-blue" id="widget1"
                                             data-widget-togglebutton="false"
                                             data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                                             data-widget-custombutton="false">
                                            <header><h2><strong>Pacientes Registrados</strong></h2></header>
                                            <div class="widget-body">
                                                <div class="widget-body-toolbar">
                                                    <div class="input-group">
                                                                <span class="input-group-addon"><i
                                                                        class="fa fa-search"></i></span>
                                                        <input class="form-control" id="searchPacienteTitular"
                                                               placeholder="Buscar Paciente"
                                                               type="text" disabled>
                                                    </div>
                                                </div>
                                                <table class="table table-responsive table-bordered table-hover hide"
                                                       id="table-paciente">
                                                    <thead>
                                                    <tr>
                                                        <th>Codigo Paciente</th>
                                                        <th>Numero de Docuemnto</th>
                                                        <th>Nombre Completo</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($listPaciente as $item) { ?>
                                                        <tr class="val"
                                                            data-nombre="<?php echo $item->persona->getNombreCompleto() ?>"
                                                            data-paciente="<?php echo $item->id_paciente ?>">
                                                            <td><?php echo $item->codigo_paciente ?></td>
                                                            <td><?php echo $item->persona->num_doc ?></td>
                                                            <td><?php echo $item->persona->getNombreCompleto() ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit" id="btn-seguro"><i class="fa fa-save"></i>
                                Asegurar a Paciente
                            </button>
                        </div>
                        <?php echo CHtml::endForm(); ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!--Start Scripts-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/paciente/seguroCreate.js', CClientScript::POS_END); ?>
<!--End plugins-->
<!-- start plugins-->

<!--end plugins-->


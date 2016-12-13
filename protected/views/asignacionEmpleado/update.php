<?php
/* @var $this PacienteController */
$this->pageTitle = "Asignacion Empleado <span> > Actualizacion de Asignacion</span>";
$this->breadcrumbs = array(
    'Asignacion de Empleado',
);
?>
    <section id="widget-grid">
        <div class="row">
            <article class="col-md-12">
                <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                    <header></header>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Actualizacion de Asignacion</legend>
                            <div class="row">
                                <div class="col-md-6 col-lg-offset-3">
                                    <?php echo CHtml::beginForm(array(), 'post', array('id' => 'formActualizarAsig')); ?>
                                    <label>Nombre Del Empleado</label>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" id="AsignacionEmpleadoNombre"
                                                       disabled
                                                       value="<?php echo $modelAsignacionEmpleado->empleado->empleadoPersona->getNombreCompleto(); ?>">
                                                <input type="hidden" name="AsignacionEmpleado[id_empleado]"
                                                       id="AsignacionEmpleadoId"
                                                       value="<?php echo $modelAsignacionEmpleado->id_empleado ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php echo CHtml::activelabelEx($modelAsignacionEmpleado, 'Fecha Inicio'); ?>
                                                <?php echo CHtml::activedateField($modelAsignacionEmpleado, 'fecha_inicio', array('class' => 'form-control')); ?>
                                                <?php echo CHtml::error($modelAsignacionEmpleado, 'fecha_inicio', array('class' => 'label label-danger')); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?php echo CHtml::activelabelEx($modelAsignacionEmpleado, 'Fecha Fin'); ?>
                                                <?php
                                                $Empleado = AsignacionEmpleado::model()->findAll(array(
                                                    'condition' => "id_asignacion='{$modelAsignacionEmpleado->id_asignacion}' and fecha_fin is null",
                                                ));
                                                if ($Empleado != null) {
                                                    ?>
                                                    <?php echo CHtml::activedateField($modelAsignacionEmpleado, 'fecha_fin', array('class' => 'form-control')); ?>
                                                <?php } else {
                                                    ?><br>
                                                    <div class="col-md-6 col-lg-offset-3">
                                                        <div class="alert alert-info fade in">
                                                            <i class="fa-fw fa fa-info"></i>
                                                            <strong><?php echo $modelAsignacionEmpleado->fecha_fin ?></strong>.
                                                            <?php echo CHtml::activeHiddenField($modelAsignacionEmpleado, 'fecha_fin', array('class' => 'form-control')); ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                <?php echo CHtml::error($modelAsignacionEmpleado, 'fecha_fin', array('class' => 'label label-danger')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php echo CHtml::activelabelEx($modelAsignacionEmpleado, 'Cargo'); ?>
                                                <?php echo CHtml::activedropDownList($modelAsignacionEmpleado, 'id_cargo', $modelAsignacionEmpleado->getCargo(), array('class' => 'form-control', 'placeholder' => 'Nombre de la Unidad')); ?>
                                                <?php echo CHtml::error($modelAsignacionEmpleado, 'id_cargo', array('class' => 'label label-danger')); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-6 col-lg-offset-3">
                                                        <div class="alert alert-info fade in">
                                                            <i class="fa-fw fa fa-info"></i>
                                                            <strong><?php echo ($modelAsignacionEmpleado->vigente != false) ? 'Activo' : 'Inactivo' ?></strong>.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <input type="submit" value="Guardar" class="btn btn-primary">
                        </div>
                        <?php echo CHtml::endForm(); ?>
                    </div>

                </div>
            </article>
        </div>
    </section>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/iCheck/icheck.js', CClientScript::POS_END); ?>
<?php
/* @var $this CuentaController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = 'Creacion de Nueva Tarea';
?>
    <section id="widget-grid">
        <div class="row">
            <article class="col-md-12">
                <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                    <header></header>
                    <div>
                        <div class="widget-body">
                            <?php echo CHtml::beginForm(); ?>
                            <fieldset>
                                <legend>Crear Tarea</legend>
                                <?php echo CHtml::errorSummary($task, '<h4 class="alert-heading"><i class="fa fa-warning"></i> DEBE CORREGIR LOS SIGUIENTES ERRORES </h4>', null, array('class' => 'alert alert-danger')); ?>
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabelEx($task, 'name'); ?>
                                            <?php echo CHtml::activeTextField($task, 'name', array('class' => 'form-control', 'placeholder' => 'Nombre de la Tarea')); ?>
                                            <?php echo CHtml::error($task, 'name', array('class' => 'label label-danger')); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabelEx($task, 'description'); ?>
                                            <?php echo CHtml::activeTextArea($task, 'description', array('class' => 'form-control', 'placeholder' => 'Descripcion')); ?>
                                            <?php echo CHtml::error($task, 'description', array('class' => 'label label-danger')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 col-md-offset-1">
                                        <div class="jarviswidget" id="widget2" data-widget-togglebutton="false"
                                             data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                                             data-widget-custombutton="false">
                                            <header>
                                                <h2><strong>LISTADO DE OPERACIONES</strong></h2>
                                            </header>
                                            <div>
                                                <div class="widget-body no-padding">
                                                    <div class="widget-body-toolbar">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="text" class="form-control"
                                                                       id="input-filter" placeholder="BUSCAR...">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive"
                                                         style="overflow: auto; height: 500px;">
                                                        <table class="table table-condensed table-bordered "
                                                               id="desasignado" width="100%;">
                                                            <thead>
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Descripcion</th>
                                                                <th>Accion</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($listOperations as $item): ?>
                                                                <tr id="<?php echo str_replace(" ", "_", $item->name); ?>">
                                                                    <td><?php echo $item->name; ?></td>
                                                                    <td><?php echo $item->description; ?></td>
                                                                    <td>
                                                                        <label class="checkbox-inline">
                                                                            <input type="checkbox"
                                                                                   class="checkbox style-0 operacion"
                                                                                   name="operaciones[]"
                                                                                   value="<?php echo $item->name; ?>">
                                                                            <span></span>
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="jarviswidget" id="widget3" data-widget-togglebutton="false"
                                             data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                                             data-widget-custombutton="false">
                                            <header>
                                                <h2><strong>OPERACIONES ASIGNADAS</strong></h2>
                                            </header>
                                            <div>
                                                <div class="widget-body no-padding">
                                                    <div class="widget-body-toolbar">
                                                        <span class="label label-info">SELECCIONE OPERACIONES DE LA TABLA DE LA IZQUIERDA</span>
                                                    </div>
                                                    <div class="table-responsive"
                                                         style="overflow: auto; height: 500px;">
                                                        <table class="table table-condensed table-bordered"
                                                               id="asignado">
                                                            <thead>
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Descripcion</th>
                                                                <th>Accion</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-actions">
                                <?php echo CHtml::submitButton('Crear', array('class' => 'btn btn-primary btn-lg')); ?>
                            </div>
                            <?php echo CHtml::endForm(); ?>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/authentication/createTask.js', CClientScript::POS_END); ?>
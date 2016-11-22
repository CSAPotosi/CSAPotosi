<?php
/* @var $this CuentaController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = 'Creacion de Roles';
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
                                <?php echo CHtml::errorSummary($role, '<h4 class="alert-heading"><i class="fa fa-warning"></i> DEBE CORREGIR LOS SIGUIENTES ERRORES </h4>', null, array('class' => 'alert alert-danger')); ?>
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabelEx($role, 'name'); ?>
                                            <?php echo CHtml::activeTextField($role, 'name', array('class' => 'form-control', 'placeholder' => 'Nombre del Rol')); ?>
                                            <?php echo CHtml::error($role, 'name', array('class' => 'label label-danger')); ?>
                                        </div>
                                        <div class="form-group">
                                            <?php echo CHtml::activeLabelEx($role, 'description'); ?>
                                            <?php echo CHtml::activeTextArea($role, 'description', array('class' => 'form-control', 'placeholder' => 'Descripcion')); ?>
                                            <?php echo CHtml::error($role, 'description', array('class' => 'label label-danger')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="jarviswidget" id="widget2" data-widget-togglebutton="false"
                                             data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                                             data-widget-custombutton="false">
                                            <header>
                                                <h2><strong>LISTADO DE TAREAS</strong></h2>
                                            </header>
                                            <div>
                                                <div class="widget-body no-padding">
                                                    <div class="widget-body-toolbar">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="text" class="form-control"
                                                                       id="input-filter-1" placeholder="BUSCAR...">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive"
                                                         style="overflow: auto; height: 500px;">
                                                        <table class="table table-condensed table-bordered "
                                                               id="desasignado1" width="100%;">
                                                            <thead>
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Accion</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($listTasks as $item): ?>
                                                                <tr id="<?php echo str_replace(" ", "_", $item->name); ?>">
                                                                    <td><?php echo $item->name; ?></td>
                                                                    <td>
                                                                        <label class="checkbox-inline">
                                                                            <input type="checkbox"
                                                                                   class="checkbox style-0 tarea"
                                                                                   name="tarea_rol[]"
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

                                    <div class="col-md-4">
                                        <div class="jarviswidget" id="widget3" data-widget-togglebutton="false"
                                             data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                                             data-widget-custombutton="false">
                                            <header>
                                                <h2><strong>LISTADO DE ROLES</strong></h2>
                                            </header>
                                            <div>
                                                <div class="widget-body no-padding">
                                                    <div class="widget-body-toolbar">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <input type="text" class="form-control"
                                                                       id="input-filter-2" placeholder="BUSCAR...">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive"
                                                         style="overflow: auto; height: 500px;">
                                                        <table class="table table-condensed table-bordered "
                                                               id="desasignado2" width="100%;">
                                                            <thead>
                                                            <tr>
                                                                <th>Nombre</th>
                                                                <th>Accion</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($listRoles as $item): ?>
                                                                <tr id="<?php echo str_replace(" ", "_", $item->name); ?>">
                                                                    <td><?php echo $item->name; ?></td>
                                                                    <td>
                                                                        <label class="checkbox-inline">
                                                                            <input type="checkbox"
                                                                                   class="checkbox style-0 rol"
                                                                                   name="tarea_rol[]"
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

                                    <div class="col-md-4">
                                        <div class="jarviswidget" id="widget3" data-widget-togglebutton="false"
                                             data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                                             data-widget-custombutton="false">
                                            <header>
                                                <h2><strong>TAREAS O ROLES ASIGNADOS</strong></h2>
                                            </header>
                                            <div>
                                                <div class="widget-body no-padding">
                                                    <div class="widget-body-toolbar">
                                                        <span class="label label-info">SELECCIONE TAREAS O ROLES DE LAS TABLAS DE LA IZQUIERDA</span>
                                                    </div>
                                                    <div class="table-responsive"
                                                         style="overflow: auto; height: 500px;">
                                                        <table class="table table-condensed table-bordered"
                                                               id="asignado">
                                                            <thead>
                                                            <tr>
                                                                <th>Nombre</th>
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

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/authentication/createRole.js', CClientScript::POS_END); ?>
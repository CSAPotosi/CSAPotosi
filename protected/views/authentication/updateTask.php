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
                                <legend>ACTUALIZAR ASIGNACION DE OPERACIONES A TAREA</legend>
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="form-group">
                                            <label for="name">NOMBRE</label>
                                            <input type="text" class="form-control" name="name"
                                                   value="<?php echo $task->name ?>" disabled/>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">DESCRIPCION</label>
                                            <textarea class="form-control"
                                                      name="description"> <?php echo $task->description ?> </textarea>
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
                                                                <?php if (!(Yii::app()->authManager->hasItemChild($task->name, $item->name))): ?>
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
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
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
                                                            <?php foreach ($listOperationsSelected as $item): ?>
                                                                <tr id="<?php echo str_replace(" ", "_", $item->name); ?>">
                                                                    <td><?php echo $item->name; ?></td>
                                                                    <td><?php echo $item->description; ?></td>
                                                                    <td>
                                                                        <label class="checkbox-inline">
                                                                            <input type="checkbox"
                                                                                   class="checkbox style-0 operacion"
                                                                                   name="operaciones[]"
                                                                                   value="<?php echo $item->name; ?>"
                                                                                   checked>
                                                                            <span></span>
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <input type="hidden" id="oculto" name="oculto">
                            <div class="form-actions">
                                <?php echo CHtml::submitButton('Guardar', array('class' => 'btn btn-primary btn-lg', 'id' => 'activarOculto')); ?>
                            </div>
                            <?php echo CHtml::endForm(); ?>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/authentication/updateTask.js', CClientScript::POS_END); ?>
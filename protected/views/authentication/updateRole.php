<?php
/* @var $this CuentaController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = 'ACTUALIZACION DE ROLES ASIGNADOS';
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
                                <legend>ACTUALIZAR ROL</legend>
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="form-group">
                                            <label for="name">NOMBRE</label>
                                            <input type="text" class="form-control" name="name"
                                                   value="<?php echo $role->name ?>" disabled/>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">DESCRIPCION</label>
                                            <textarea class="form-control"
                                                      name="description"> <?php echo $role->description ?> </textarea>
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
                                                                <?php if (!(Yii::app()->authManager->hasItemChild($role->name, $item->name))): ?>
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
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
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
                                                                <?php if ((!(Yii::app()->authManager->hasItemChild($role->name, $item->name))) and ($role->name != $item->name)): ?>
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
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
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
                                                            <?php foreach ($listTasksRolesSelected as $item): ?>
                                                                <?php if ($item->type > 0): ?>
                                                                    <tr id="<?php echo str_replace(" ", "_", $item->name); ?>">
                                                                        <td><?php echo $item->name; ?></td>
                                                                        <td>
                                                                            <label class="checkbox-inline">
                                                                                <input type="checkbox"
                                                                                       class="checkbox style-0 <?php echo ($item->type == 1) ? 'tarea' : 'rol'; ?>"
                                                                                       name="tarea_rol[]"
                                                                                       value="<?php echo $item->name; ?>"
                                                                                       checked>
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

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/authentication/updateRole.js', CClientScript::POS_END); ?>
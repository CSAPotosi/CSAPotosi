<?php
/* @var $this CuentaController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = ($rol->type == 2) ? 'DATOS DEL ROL' : 'DATOS DE LA TAREA';
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>DATOS <?php echo ($rol->type == 2) ? 'DEL ROL' : 'DE LA TAREA' ?> </legend>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>NOMBRE</td>
                                            <td><?php echo $rol->name; ?></td>
                                        </tr>
                                        <tr>
                                            <td>DESCRIPCION</td>
                                            <td><?php echo $rol->description; ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="jarviswidget" id="widget1" data-widget-togglebutton="false"
                                         data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                                         data-widget-custombutton="false">
                                        <header>
                                            <h2><strong>LISTADO
                                                    DE<?php echo ($rol->type == 2) ? ' ROLES O TAREAS ASIGNADAS' : ' OPERACIONES ASIGNADAS' ?></strong>
                                            </h2>
                                        </header>
                                        <div>
                                            <div class="widget-body no-padding">
                                                <div class="table-responsive">
                                                    <table class="table table-condensed table-striped table-bordered "
                                                           width="100%;">
                                                        <thead>
                                                        <tr>
                                                            <th>Nombre</th>
                                                            <th>Descripcion</th>
                                                            <th>Tipo</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($listSelected as $item): ?>
                                                            <tr>
                                                                <td><?php echo $item->name; ?></td>
                                                                <td><?php echo $item->description; ?></td>
                                                                <th><?php echo $types[$item->type] ?></th>
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
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

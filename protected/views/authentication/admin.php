<?php
/* @var $this CuentaController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = ($tipo == 1) ? 'LISTADO DE TAREAS DEL SISTEMA' : 'LISTADO DE ROLES DEL SISTEMA';
?>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2><?php echo ($tipo == 1) ? 'TAREAS DEL SISTEMA' : 'ROLES DEL SISTEMA'; ?></h2>
                </header>
                <div>
                    <div class="jarviswidget-editbox">

                    </div>
                    <div class="widget-body no-padding">
                        <table class="table table-condensed table-striped table-bordered " id="operaciones"
                               width="100%;">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($list as $item): ?>
                                <tr>
                                    <td><?php echo $item->name; ?></td>
                                    <td><?php echo $item->description; ?></td>
                                    <td>
                                        <?php echo CHtml::link('Ver', array('authentication/view', 'id' => $item->name), array('class' => 'btn btn-primary')); ?>
                                        <?php echo CHtml::link('Editar', array(($item->type == 2) ? 'authentication/updateRole' : 'authentication/updateTask', 'id' => $item->name), array('class' => 'btn btn-info')); ?>
                                        <?php echo CHtml::link('Borrar', array('authentication/deleteRol', 'id' => $item->name), array('class' => 'btn btn-danger', "confirm" => "Esta seguro?")); ?>
                                    </td>
                                </tr>
                                <?php
                            endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/resources/js/plugin/datatable/datatable.propio.css'); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/datatable/jquery.dataTables.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/datatable/dataTables.bootstrap.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/authentication/viewOperations.js', CClientScript::POS_END); ?>

<?php
/* @var $this CuentaController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = 'LISTA DE OPERACIONES DEL SISTEMAS';
?>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>OPERACIONES DEL SISTEMA</h2>
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
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($listOperations as $item): ?>
                                <tr>
                                    <td><?php echo $item->name; ?></td>
                                    <td><?php echo $item->description; ?></td>
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

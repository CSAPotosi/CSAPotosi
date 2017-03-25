<?php
/* $this ServicioController */
$this->pageTitle = "Seguridad <span> > Backups</span>";
$this->breadcrumbs = array(
    'Respaldo',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body no-padding">
                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo CHtml::link("<i class=\"fa fa-database\"></i> Crear Backup",
                                        array('Seguridad/CreateBackup'),
                                        array('class' => 'btn btn-primary')); ?>
                                </div>
                            </div>
                        </div>
                        <fieldset>
                            <legend class="padding-10">Backups</legend>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-responsive table-bordered" id="custom-table">
                                        <thead>
                                        <tr>
                                            <th class="hasinput"><input type="text" placeholder="NOMBRE" class="form-control"></th>
                                            <th class="hasinput"><input type="text" placeholder="FECHA CREACION" class="form-control"></th>
                                            <th class="hasinput"><input type="text" placeholder="FECHA MODIFICACION" class="form-control"></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th>NOMBRE</th>
                                            <th>FECHA DE CREACION</th>
                                            <th>FECHA DE MODIFICACION</th>
                                            <th>
                                            </th>
                                        </tr>
                                        </thead>
                                        <?php while ($archivo = readdir($backups)) {
                                            if (basename($archivo) != '.' and basename($archivo) != '..' and basename($archivo) != '.gitignore') {
                                                ?>
                                                <tr>
                                                    <td><?php echo basename($archivo) ?></td>
                                                    <?php $resultado = intval(preg_replace('/[^0-9]+/', '', basename($archivo))) ?>
                                                    <td><?php echo date('d/m/Y H:i:s', $resultado) ?></td>
                                                    <td><?php echo date("d/m/Y H:i:s", filectime("Backups/" . basename($archivo))) ?></td>
                                                    <td align="center"><?php echo CHtml::link('<i class="fa fa-download"></i> Descargar',
                                                            array('Seguridad/CargarBackup', 'id' => $resultado),
                                                            array('class' => 'btn btn-primary btn-xs')); ?></td>
                                                </tr>
                                            <?php }
                                        } ?>
                                    </table>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/jquery.dataTables.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.colVis.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.tableTools.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.bootstrap.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatable-responsive/datatables.responsive.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/reporte/common.js',CClientScript::POS_END)
?>

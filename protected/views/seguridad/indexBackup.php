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
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo CHtml::link("<i class=\"fa fa-database\"></i> Crear Backup",
                                        array('Seguridad/CreateBackup'),
                                        array('class' => 'btn btn-primary btn-lg')); ?>
                                </div>
                            </div>
                        </div>
                        <fieldset>
                            <legend>Backups</legend>
                            <br>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-responsive table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Nombre de Archivo</th>
                                            <th>Fecha de Creacion</th>
                                            <th>Fecha de Modificacion</th>
                                            <th>
                                                <center>Cargar Backup</center>
                                            </th>
                                        </tr>
                                        </thead>
                                        <?php while ($archivo = readdir($backups)) {
                                            if (basename($archivo) != '.' and basename($archivo) != '..') {
                                                ?>
                                                <tr>
                                                    <td><?php echo basename($archivo) ?></td>
                                                    <?php $resultado = intval(preg_replace('/[^0-9]+/', '', basename($archivo))) ?>
                                                    <td><?php echo date('d-m-Y H:i:s', $resultado) ?></td>
                                                    <td><?php echo date("d/m/Y H:i:s", filectime("Backups/" . basename($archivo))) ?></td>
                                                    <td align="center"><?php echo CHtml::link('<i class="fa fa-upload"></i> Cargar Backup',
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



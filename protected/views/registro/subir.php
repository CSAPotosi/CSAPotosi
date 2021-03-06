<?php
/* $this ServicioController */
$this->pageTitle = "Asistencia <span> > Cargar Asitencia</span>";
$this->breadcrumbs = array(
    'Asistencia',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Subir Archivo de Asistencia</legend>
                            <div class="row">
                                <div class="col-md-6 col-lg-offset-3">
                                    <form enctype="multipart/form-data" class="ui-autocomplete-loading"
                                          action="<?php echo CHtml::normalizeUrl(array("registro/subir")); ?>"
                                          method="POST">
                                        <label>Registro de Asistencia</label>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <?php echo CHtml::activeFileField($modelSubir, 'uploadedfile', array('class' => 'form-control')); ?>
                                                    <?php echo CHtml::error($modelSubir, 'uploadedfile', array('class' => 'label label-danger error-message')); ?>
                                                    <?php echo (Yii::app()->user->hasFlash('extencion')) ? '<div class="label label-danger">' . Yii::app()->user->getFlash('extencion') . '</div>' : ''; ?>
                                                    <?php echo (Yii::app()->user->hasFlash('vacio')) ? '<div class="label label-danger">' . Yii::app()->user->getFlash('vacio') . '</div>' : ''; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <button class="btn btn-primary" type="submit"><i
                                                            class="fa fa-upload"></i> Subir
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table table-responsive table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Nombre de Archivo</th>
                                                        <th>Fecha de Modificacion</th>
                                                    </tr>
                                                    </thead>
                                                    <?php while ($archivo = readdir($directorio)) {
                                                        if (basename($archivo) != '.' and basename($archivo) != '..') {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo basename($archivo) ?></td>
                                                                <td><?php echo date("d/m/Y.", filectime("archivo/" . basename($archivo))) ?></td>
                                                            </tr>
                                                        <?php }
                                                    } ?>
                                                </table>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!--Start Scripts-->

<!--End plugins-->
<!-- start plugins-->


<!--end plugins-->


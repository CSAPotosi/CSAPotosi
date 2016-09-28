<?php
/* $this ServicioController */
$this->pageTitle = "Servicio <span> > Atencion Medica</span>";
$this->breadcrumbs = array(
    'AtencionMedica',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Subir Archivo de Asistencia</legend>
                            <div class="row">
                                <div class="col-md-6 col-lg-offset-3">
                                    <form enctype="multipart/form-data"  action="<?php echo CHtml::normalizeUrl(array("registro/subir")); ?>" method="POST">
                                        <div class="form-group">
                                            <label>Regisro de Asistencia</label>
                                            <input name="uploadedfile" type="file"  class="form-control"/>

                                            <br>
                                            <input type="submit" value="Subir archivo"  class="btn btn-primary"/>
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
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/servicio/index.js', CClientScript::POS_END); ?>
<!--End plugins-->
<!-- start plugins-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/jquery-nestable/jquery.nestable.min.js', CClientScript::POS_END); ?>

<!--end plugins-->
<script>

</script>

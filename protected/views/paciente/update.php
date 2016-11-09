<?php
/* $this ServicioController */
$this->pageTitle = "Servicio <span> > Registro Asistencia</span>";
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
                            <legend>Actualizar Paciente</legend>
                            <br>
                            <div class="row">

                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" id="btnEnviar" class="btn btn-primary"
                                    data-url="<?php echo CHtml::normalizeUrl(array('registro/registrarAsistencia')) ?>">
                                <i class="fa fa-save"></i> Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!--Start Scripts-->

<!--End plugins-->
<!-- start plugins-->
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/registro/registroManual.js', CClientScript::POS_END);
?>
<!--end plugins-->


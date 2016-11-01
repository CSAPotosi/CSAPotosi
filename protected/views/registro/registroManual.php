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
                            <legend>Asistencia</legend>
                            <div class="row">
                                <div class="col-md-8 col-lg-offset-2">
                                    <div>
                                        <div class="well no-padding">
                                            <h1 id="horafecha" align="center"
                                                style="font-size: 2cm;font-weight:bold"><?php echo date('d/m/Y') ?>
                                                &nbsp&nbsp<span id="reloj"></span></code></h1>
                                        </div>
                                    </div>
                                    <?php echo CHtml::beginForm(array(), 'post', array('id' => 'formBusqueda')); ?>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-offset-3">
                                            <div class="form-group">
                                                <br>
                                                <input align="center"
                                                       style="width: 380px; height: 80px; font-size: 70px" type="text"
                                                       id="ci" name="numero" class="form-control" placeholder="C.I"
                                                       data-url="<?php echo CHtml::normalizeUrl(array('registro/busquedaCi')) ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo CHtml::endForm(); ?>

                                    <?php echo CHtml::beginForm(array(), 'post', array('id' => 'formRegistro')); ?>
                                    <div id="contenedorInfoEmpleado">

                                    </div>
                                    <input type="hidden" name="Registro[fecha]" value="<?php echo date('Y-m-d') ?>">
                                    <input type="hidden" name="Registro[hora_asistencia]"
                                           value="<?php echo date('H:i', time()) ?>">
                                    <input type="hidden" name="Registro[observaciones]" value="Maquina Reemplazo">
                                    <?php echo CHtml::endForm(); ?>

                                </div>
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


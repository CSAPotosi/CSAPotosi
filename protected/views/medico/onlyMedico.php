<?php
/* $this ServicioController */
$this->pageTitle = "Servicio <span> > Informacion Medica</span>";
$this->breadcrumbs = array(
    'Medico',
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
                            <legend>Informacion medica</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo CHtml::beginForm(); ?>
                                    <div class="jarviswidget" id="widget1" data-widget-togglebutton="false"
                                         data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                                         data-widget-custombutton="false">
                                        <header>
                                            <h2><strong>Informacion Medica</strong></h2>
                                        </header>
                                        <div class="widget-body">
                                            <div class="widget-body-toolbar">

                                            </div>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <input type="hidden" name="Medico[id_medico]"
                                                               value="<?php echo $id ?>">
                                                        <?php echo CHtml::activeLabel($modelMedico, 'matricula'); ?>
                                                        <?php echo CHtml::activeTextField($modelMedico, 'matricula', ['class' => 'form-control']); ?>
                                                        <?php echo CHtml::error($modelMedico, 'matricula', ['class' => 'label label-danger']); ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <fieldset>
                                                        <legend>Especialidades Asignadas a Medico</legend>
                                                        <table class="table table-responsive table-bordered"
                                                               id="contenedorAsignadas">
                                                            <tr>
                                                                <th>Nombre Especialidad</th>
                                                                <th>Descripcion</th>
                                                                <th>Accion</th>
                                                            </tr>
                                                        </table>
                                                    </fieldset>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="jarviswidget" id="widget1" data-widget-togglebutton="false"
                                         data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                                         data-widget-custombutton="false">
                                        <header>
                                            <h2><strong>ESPECIALIDADES</strong></h2>
                                        </header>
                                        <div class="widget-body">
                                            <div id="contenedorListaEspecialidad">
                                                <?php $this->renderPartial('_specialtyList', array('listSpecialty' => $listSpecialty, 'modelMedicoEspe' => $modelMedicoEspe)) ?>
                                            </div>
                                            <div class="form-actions">
                                                <button type="button" class="btn btn-primary"
                                                        data-target="#modalEspecialidad" data-toggle="modal">
                                                    <i class="fa fa-plus"></i>Agregar Especialidad
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Guardar
                            </button>
                        </div>
                        <?php echo CHtml::endForm(); ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<div class="modal fade in" id="modalEspecialidad" tabindex="-1" role="dialog" aria-hidden="true" style="display:none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">Registrar Especialidad Medica</h4>
            </div>
            <div class="modal-body" id="contenedorFormularioEspecialidad">
                <?php $this->renderPartial('_formSpecialty', array('modelEspecialidad' => $modelEspecialidad)) ?>
            </div>
            <div class="modal-footer clearfix">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary pull-left" id="btnGuardarEspecialidad"
                        data-url="<?php echo CHtml::normalizeUrl(['medico/CreateSpecialyAjax']) ?>">Guardar
                </button>
            </div>
        </div>
    </div>
</div>
<!--Start Scripts-->

<!--End plugins-->
<!-- start plugins-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/medico/onlyMedico.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/iCheck/icheck.js', CClientScript::POS_END); ?>


<!--end plugins-->
<script>

</script>

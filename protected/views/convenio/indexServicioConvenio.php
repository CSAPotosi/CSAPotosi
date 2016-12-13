<?php
/* $this ServicioController */
$this->pageTitle = "Servicio <span> Servicios en Convenio</span>";
$this->breadcrumbs = array(
    'AtencionMedica',
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
                                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="fa fa-search"></i></span>
                                            <input class="form-control" id="searchConvenioServicio"
                                                   placeholder="BUSCAR SERVICIOS EN CONVENIO"
                                                   type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <fieldset>
                                <legend>Servicio en <?php echo $modelConvenio->nombre_convenio ?></legend>
                                <div class="row">
                                    <div class="col-md-10 col-lg-offset-1">
                                        <?php if ($listConvenioServicio != null) { ?>
                                            <table class="table table-responsive table-bordered">
                                                <tr>
                                                    <th>Servicio</th>
                                                    <th>Monto</th>
                                                    <th>Institucion</th>
                                                    <th>Descuento</th>
                                                    <th>Estado</th>
                                                </tr>
                                                <?php foreach ($listConvenioServicio as $list): ?>
                                                    <?php $servicio = Servicio::model()->findByPk($list->id_servicio) ?>
                                                    <tr data-nombre="<?php echo $servicio->nombre_serv ?>"
                                                        class="valor">
                                                        <td><?php echo $servicio->nombre_serv ?></td>
                                                        <td><?php echo $servicio->precio->monto ?></td>
                                                        <td><?php echo $servicio->entidad->razon_social ?></td>
                                                        <td><?php echo $list->descuento_servicio ?></td>
                                                        <td>
                                                            <input type="checkbox"
                                                                   class="convenioCheckbox" <?php echo ($list->activo) ? "checked" : "" ?>
                                                                   data-url="<?php echo CHtml::normalizeUrl(array('/convenio/changeStateConvenioServivio', 'id' => $list->id_con_ser)) ?>">
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </table>
                                        <?php } else { ?>
                                            <div class="alert alert-info alert-block">
                                                <h1 class="alert-heading">NO EXISTE SERVICIOS!</h1>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary" data-target="#servicioconvenio"
                                        data-toggle="modal">
                                    <i class="fa fa-save"></i> Agregar Servivios
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
    <div class="modal fade in" id="servicioconvenio" tabindex="-1" role="dialog" aria-hidden="true"
         style="display:none">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
                    <h4 class="modal-title">Agregar Servicio a Covenio Institucional</h4>
                </div>
                <div class="modal-body">
                    <div id="contenedorprincipalconvenioservicio">
                        <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-togglebutton="false"
                             data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                             data-widget-custombutton="false">
                            <header>
                                <h2><strong>SERVICIOS DISPONIBLES</strong></h2>
                            </header>
                            <div class="widget-body">
                                <div class="widget-body-toolbar">
                                    <div class="row">
                                        <div class="col-xs-9 col-sm-5 col-md-5 col-lg-5">
                                            <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="fa fa-search"></i></span>
                                                <input class="form-control" id="searchServicios"
                                                       placeholder="BUSCAR SERVICIOS"
                                                       type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $this->renderPartial('listServicios', array('listServicio' => $listServicio, 'modelConvenio' => $modelConvenio, 'convenioServicio' => $convenioServicio,)) ?>
                            </div>
                        </div>
                        <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-togglebutton="false"
                             data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                             data-widget-custombutton="false">
                            <header>
                                <h2><strong>SERVICIOS SELECCIONADOS</strong></h2>
                            </header>
                            <div class="widget-body">
                                <div id="contenedorlistaconvenio">
                                    <?php echo $this->renderPartial('serviciosSelect', array('listSelect' => $listSelect)) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer clearfix">
                    <?php echo CHtml::tag('button', array('id' => 'btnConvenioServicio', 'class' => 'btn btn-primary pull-left', 'data-url' => CHtml::normalizeUrl(array('Convenio/detalleConvenioServicio'))), '<i class="fa fa-plus"></i> Guardar', true) ?>
                    <?php echo CHtml::tag('button', array('id' => 'btnCloseUpditemlab', 'class' => 'btn btn-danger', 'data-dismiss' => 'modal'), '<i class="fa fa-times"></i> Cancelar', true) ?>
                </div>
            </div>
        </div>
    </div>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/convenio/indexServicioConvenio.js', CClientScript::POS_END);
?>
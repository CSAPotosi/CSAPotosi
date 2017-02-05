<?php
/* $this ServicioController */
$this->pageTitle = "PRESTACION <span></span>";
$this->breadcrumbs = array(
    'AtencionMedica',
);
$catTipoExamen = new CategoriaServExamen();
$modelPrestacion = new PrestacionServicio();
$modelDetallePrestacion = new DetallePrestacion();
$listTipoEx = $catTipoExamen->getTipoEx();
$listNombreEx = $catTipoExamen->getNombreTipo();
$listExamen = ServExamen::model()->findAll();
$listCategoriaExamen = CategoriaServExamen::model()->findAll();
$listCategoriaClinico = CategoriaServClinico::model()->findAll();
?>
<?php $this->renderPartial('/layouts/_cardProfile', ['historialModel' => $Paciente->historialMedico]); ?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>PRESTACION DE SERVICIOS</legend>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="jarviswidget jarviswidget-color-blue" id="wid-id-11"
                                         data-widget-togglebutton="false"
                                         data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                                         data-widget-custombutton="false">
                                        <header>
                                            <h2><strong>SERVICIOS</strong></h2>
                                            <ul id="widget-tab-1" class="nav nav-tabs pull-right">
                                                <li class="active">
                                                    <a data-toggle="tab" href="#hr1" id="hr11"> <span
                                                            class="hidden-mobile hidden-tablet"> Examenes </span> </a>
                                                </li>
                                                <li>
                                                    <a data-toggle="tab" href="#hr2" id="hr22"> <span
                                                            class="hidden-mobile hidden-tablet"> Clinicos</span></a>
                                                </li>
                                            </ul>
                                        </header>
                                        <div>
                                            <div class="widget-body no-padding">
                                                <div class="widget-body-toolbar">
                                                    <div class="row">
                                                        <div class="col-xs-9 col-sm-5 col-md-5 col-lg-5">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i
                                                                        class="fa fa-search"></i></span>
                                                                <input class="form-control" id="searchServicio"
                                                                       placeholder="Buscar Servicios"
                                                                       type="text">
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-9 col-sm-5 col-md-5 col-lg-5 pull-right">
                                                            <select class="form-control" id="selector">
                                                                <?php $var = 0;
                                                                foreach ($listTipoEx as $item) {
                                                                    echo "<option value='$var'>" . $listNombreEx[$var] . "</option>";
                                                                    $var++;
                                                                } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-content padding-10">
                                                    <div class="tab-pane fade in active" id="hr1">
                                                        <?php foreach ($listCategoriaExamen as $item):
                                                        echo "<fieldset class='servExamen' data-tipo='$item->tipo_ex'>
                                                                  <legend><strong>$item->nombre_cat_ex</strong></legend>";
                                                        foreach ($item->examenes as $var):
                                                        echo "<div class='col-md-6'>" ?>
                                                        <table class='table table-hover'
                                                               id="<?php echo $var->datosServicio->id_serv ?>">
                                                            <tr class='val'
                                                                data-titulo="<?php echo $var->datosServicio->nombre_serv; ?>"
                                                                data-precio="<?php echo $var->datosServicio->precio->monto ?>">
                                                                <?php echo "<td><input class='checkeded' type='checkbox' value=" . $var->datosServicio->id_serv . "></td>
                                                                      <td>" . $var->datosServicio->nombre_serv . "</td>"; ?>
                                                                <td><?php echo "bs." . $var->datosServicio->precio->monto ?></td>
                                                                <td class="hide" name="ocultar" data-prueba="hola">
                                                                    <input type="text"
                                                                           name="DetallePrestacion[<?php echo $var->datosServicio->id_serv ?>][cantidad]"
                                                                           value="1" class="cantidad" disabled></td>
                                                                <td><a style="color: black" href="#"
                                                                       data-toggle="tooltip"
                                                                       title="<?php echo $var->datosServicio->entidad->razon_social; ?>"><i
                                                                            class="fa fa-info-circle"></i></a>
                                                                    <input type="hidden"
                                                                           name="DetallePrestacion[<?php echo $var->datosServicio->id_serv ?>][id_prestacion]"
                                                                           class="id_prestacion">
                                                                    <input type="hidden"
                                                                           name="DetallePrestacion[<?php echo $var->datosServicio->id_serv ?>][id_servicio]"
                                                                           value="<?php echo $var->datosServicio->id_serv ?>">
                                                                    <input type="hidden"
                                                                           name="DetallePrestacion[<?php echo $var->datosServicio->id_serv ?>][pagado]"
                                                                           value="true">
                                                                    <input type="hidden"
                                                                           name="DetallePrestacion[<?php echo $var->datosServicio->id_serv ?>][realizado]"
                                                                           value="0">
                                                                </td>
                                                                <?php echo "</tr>
                                                             </table>
                                                             </div>";
                                                                endforeach;
                                                                echo "</fieldset>";
                                                                endforeach; ?>
                                                    </div>
                                                    <div class="tab-pane fade" id="hr2">
                                                        <?php foreach ($listCategoriaClinico as $item):
                                                        echo "<fieldset class='servClinicos'>
                                                                  <legend><strong>$item->nombre_cat_cli</strong></legend>";
                                                        foreach ($item->servClinicos as $var):
                                                        echo "<div class='col-md-6'>"; ?>
                                                        <table class='table table-hover'
                                                               id="<?php echo $var->datosServicio->id_serv ?>">
                                                            <tr class='val1'
                                                                data-titulo="<?php echo $var->datosServicio->nombre_serv; ?>"
                                                                data-precio="<?php echo $var->datosServicio->precio->monto ?>">
                                                                <?php echo "<td><input class='checkeded' type='checkbox' value=" . $var->datosServicio->id_serv . "></td>
                                                                                        <td>" . $var->datosServicio->nombre_serv . "</td>"; ?>
                                                                <td><?php echo "bs." . $var->datosServicio->precio->monto ?></td>
                                                                <td class="hide" name="ocultar"><input type="text"
                                                                                                       name="DetallePrestacion[<?php echo $var->datosServicio->id_serv ?>][cantidad]"
                                                                                                       value="1"
                                                                                                       class="cantidad">
                                                                </td>
                                                                <td><a style="color: black" href="#"
                                                                       data-toggle="tooltip"
                                                                       title="<?php echo $var->datosServicio->entidad->razon_social; ?>"><i
                                                                            class="fa fa-info-circle"></i></a>
                                                                    <input type="hidden"
                                                                           name="DetallePrestacion[<?php echo $var->datosServicio->id_serv ?>][id_prestacion]"
                                                                           class="id_prestacion">
                                                                    <input type="hidden"
                                                                           name="DetallePrestacion[<?php echo $var->datosServicio->id_serv ?>][id_servicio]"
                                                                           value="<?php echo $var->datosServicio->id_serv ?>">
                                                                    <input type="hidden"
                                                                           name="DetallePrestacion[<?php echo $var->datosServicio->id_serv ?>][pagado]"
                                                                           value="true">
                                                                    <input type="hidden"
                                                                           name="DetallePrestacion[<?php echo $var->datosServicio->id_serv ?>][realizado]"
                                                                           value="false">
                                                                </td>
                                                                <?php echo "</tr>
                                                                                </table>
                                                                              </div>";
                                                                endforeach;
                                                                echo "</fieldset>";
                                                                endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="jarviswidget jarviswidget-color-blue" id="widget1"
                                         data-widget-togglebutton="false"
                                         data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                                         data-widget-custombutton="false">
                                        <header>
                                            <h2><strong>DETALLE PRESTACION</strong></h2>
                                            <form id="formPrestacionServicios" class="hide"
                                                  data-url="<?php echo CHtml::normalizeUrl(array('HistorialMedico/prestacionCreate')) ?>">
                                                <input type="hidden" name="PrestacionServicio[id_historial]"
                                                       value="<?php echo $Paciente->persona->id_persona ?>">
                                                <div class="form-group">
                                                    <label>Observaciones</label>
                                                    <input type="text" name="PrestacionServicio[observaciones]"
                                                           class="form-control" id="observacion2">
                                                </div>
                                                <input type="hidden" name="PrestacionServicio[tipo]" value="0">
                                            </form>
                                        </header>
                                        <div class="widget-body">
                                            <?php $this->renderPartial('detallePrestacion', array('modelDetallePrestacion' => $modelDetallePrestacion)) ?>
                                        </div>
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
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/prestacionServicios/externoCreate.js', CClientScript::POS_END); ?>
<!--End plugins-->
<!-- start plugins-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/iCheck/icheck.js', CClientScript::POS_END); ?>
<!--end plugins-->

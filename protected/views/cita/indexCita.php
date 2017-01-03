<?php $errors = $modelCita->hasErrors(); ?>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-5">
                <div class="jarviswidget jarviswidget-color-blue" id="wid-id-11" data-widget-togglebutton="false"
                     data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                     data-widget-custombutton="false">
                    <header>
                        <h2><strong>Citas</strong></h2>
                        <ul id="widget-tab-1" class="nav nav-tabs pull-right">
                            <li class="<?php echo (!$errors) ? 'active' : '' ?>">
                                <a data-toggle="tab" href="#hr1" id="hr11"> <span
                                        class="hidden-mobile hidden-tablet"> Citas </span> </a>
                            </li>
                            <li class="<?php echo ($errors) ? 'active' : '' ?>">
                                <a data-toggle="tab" href="#hr2" id="hr22"> <span
                                        class="hidden-mobile hidden-tablet"> Nueva cita</span></a>
                            </li>
                        </ul>
                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <div class="widget-body-toolbar cabecera1 hide">
                                <div class="row">
                                    <div class="col-xs-9 col-sm-5 col-md-5 col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="fa fa-search"></i></span>
                                            <input class="form-control" id="searchCitas"
                                                   placeholder="Buscar Citas"
                                                   type="text">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content padding-10">
                                <div class="tab-pane fade <?php echo (!$errors) ? 'in active' : '' ?>" id="hr1">
                                    <?php $this->renderPartial('listCitas', ['listCitas' => $listCitas]) ?>
                                </div>
                                <div class="tab-pane fade <?php echo ($errors) ? 'in active' : '' ?>" id="hr2">
                                    <div class="col-md-12">
                                        <?php $this->renderPartial('_formCita', array('modelCita' => $modelCita, 'paciente' => $paciente)) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-togglebutton="false"
                     data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                     data-widget-custombutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                        <h2> Calendario</h2>
                        <div class="widget-toolbar">
                            <!-- add: non-hidden - to disable auto hide -->
                            <div class="btn-group">
                                <button class="btn dropdown-toggle btn-xs btn-default" data-toggle="dropdown">
                                    Tiempo<i class="fa fa-caret-down"></i>
                                </button>
                                <ul class="dropdown-menu js-status-update pull-right">
                                    <li>
                                        <a href="javascript:void(0);" id="mt">Mes</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" id="ag">Semana</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" id="td">Hoy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </header>
                    <div>

                        <div class="widget-body no-padding">
                            <!-- content goes here -->
                            <div class="widget-body-toolbar">
                                <div id="calendar-buttons">
                                    <div class="btn-group">
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-prev"><i
                                                class="fa fa-chevron-left"></i></a>
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-next"><i
                                                class="fa fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div id="calendar"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade in" id="modalPaciente" tabindex="-1" role="dialog" aria-hidden="true" style="display:none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">Registrar Especialidad Medica</h4>
            </div>
            <div class="modal-body" id="contenedorModalPaciente">
                <table class="table table-responsive table-bordered table-hover"
                       id="table-paciente">
                    <thead>
                    <tr>
                        <th>Codigo Paciente</th>
                        <th>Numero de Docuemnto</th>
                        <th>Nombre Completo</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    ?>
                    <?php foreach ($listPaciente as $item) { ?>
                        <tr class="val"
                            data-nombre="<?php echo $item->persona->getNombreCompleto() ?>"
                            id_paciente="<?php echo $item->id_paciente ?>">
                            <td><?php echo $item->codigo_paciente ?></td>
                            <td><?php echo $item->persona->num_doc ?></td>
                            <td><?php echo $item->persona->getNombreCompleto() ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
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
<div class="modal fade in" id="modalAtencion" tabindex="-1" role="dialog" aria-hidden="true" style="display:none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">x</button>
                <h4 class="modal-title">Registrar Especialidad Medica</h4>
            </div>
            <div class="modal-body" id="contenedorModalPaciente">
                <table class="table table-responsive table-bordered table-hover"
                       id="table-atenciones">
                    <thead>
                    <tr>
                        <th>Codigo Paciente</th>
                        <th>Numero de Docuemnto</th>
                        <th>Nombre Completo</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    ?>
                    <?php foreach ($listAtencionMedica as $item) { ?>
                        <tr class="val1"
                            data-nombre="<?php echo $item->medicoEspecialidad->idEspecialidad->nombre_especialidad ?>"
                            id_servicio="<?php echo $item->id_m_e ?>">
                            <td><?php echo $item->medicoEspecialidad->medico->persona->getNombreCompleto() ?></td>
                            <td><?php echo $item->medicoEspecialidad->idEspecialidad->nombre_especialidad ?></td>
                            <td><?php echo $item->servicio->precio->monto ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
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
<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/fullcalendar/moment.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/fullcalendar/fullcalendar.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/fullcalendar/locale-all.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/cita/indexCita.js', CClientScript::POS_END);
?>

<?php

$this->pageTitle = "Servicio <span> > Lista de Servicios </span>";
$this->breadcrumbs = array(
    'Servicio',
);
?>
    <section id="widget-grid">
        <div class="row">
            <article class="col-md-12">
                <div class="jarviswidget" id="widget1">
                    <header></header>
                    <div>
                        <div class="widget-body">
                            <div class="row">
                                <article class="col-md-12">
                                    <div class="widget-body-toolbar">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="icon-addon addon-md">
                                                    <input type="text" placeholder="Nombre del Servicio"
                                                           class="form-control" id="searchServicio">
                                                    <label class="glyphicon glyphicon-search"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <br>
                                    <table class="table table-bordered table-responsive">
                                            <thead>
                                            <tr>
                                                <th>Codigo Servicio</th>
                                                <th>Servicio</th>
                                                <th>Unidad de Medida</th>
                                                <th>Precio del Servicio</th>
                                                <th>Tipo de cobro</th>
                                                <th>Activo</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if ($listServicio != null) { ?>
                                                <?php foreach ($listServicio as $item): ?>
                                                    <tr class="val"
                                                        data-nombre="<?php echo $item->datosServicio->nombre_serv ?>">
                                                        <td><?php echo $item->datosServicio->cod_serv ?></td>
                                                        <td><?php echo $item->datosServicio->nombre_serv ?></td>
                                                        <td><?php echo $item->unidad_medida ?></td>
                                                        <td><?php echo $item->datosServicio->precio->monto ?></td>
                                                        <td><?php switch ($item->datosServicio->tipo_cobro) {
                                                                case 1:
                                                                    echo "por cantidad";
                                                                    break;
                                                                case 2:
                                                                    echo "por dia";
                                                                    break;
                                                            } ?></td>
                                                        <td>
                                                    <span class="onoffswitch">
													    <input
                                                            type="checkbox" <?php echo ($item->datosServicio->activo == true) ? 'checked' : ''; ?>
                                                            name="start_interval" class="onoffswitch-checkbox"
                                                            id="<?php echo $item->datosServicio->id_serv ?>"
                                                            data-url="<?php echo CHtml::normalizeUrl(['Servicio/ChangeStateServicio', 'id' => $item->datosServicio->id_serv]); ?>">
															<label class="onoffswitch-label"
                                                                   for="<?php echo $item->datosServicio->id_serv ?>">
                                                                <span class="onoffswitch-inner" data-swchon-text="YES"
                                                                      data-swchoff-text="NO"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label> 
                                                    </span>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo CHtml::link('Editar', ['servicio/update', 'grupo' => $dataUrl['grupo'], 'id' => $item->id_serv], ['class' => 'btn btn-primary btn-xs']);
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;
                                            } ?>
                                            </tbody>
                                        </table>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/servicio/clinicoIndex.js', CClientScript::POS_END); ?>
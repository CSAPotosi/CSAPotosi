<?php
/* $this ServicioController */
$this->pageTitle = "Reporte <span> >Lista de Servicios de Examenes</span>";
$this->breadcrumbs = array(
    'Reporte',
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
                                <div class="col-md-3">
                                    <div class="icon-addon addon-md">
                                        <input type="text" placeholder="Nombre del Servicio"
                                               class="form-control" id="searchServicio">
                                        <label class="glyphicon glyphicon-search"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <fieldset>
                            <legend>Lista de Servicios de Examenes</legend>
                            <div class="row">
                                <div class="col-md-10 col-lg-offset-1">
                                    <table class="table table-responsive table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Codigo Servicio</th>
                                            <th>Servicio</th>
                                            <th>Precio del Servicio</th>
                                            <th width="220px">
                                                <?php
                                                echo CHtml::dropDownList('ListaCategorias', null,
                                                    CHtml::listData(CategoriaServExamen::model()->findAll(
                                                        ['condition' => "tipo_ex='{$dataUrl['tipo']}' and activo=true",]
                                                    ), 'nombre_cat_ex', 'nombre_cat_ex'),
                                                    array('empty' => "TODAS LAS CATEGORIAS ", 'class' => 'select2'));
                                                ?>
                                            </th>
                                            <th>Activo</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if ($listServicio != null) { ?>
                                            <?php foreach ($listServicio as $item): ?>
                                                <tr class="val"
                                                    data-nombre="<?php echo $item->datosServicio->nombre_serv ?>"
                                                    data-categoria="<?php echo $item->categoria->nombre_cat_ex ?>">
                                                    <td><?php echo $item->datosServicio->cod_serv ?></td>
                                                    <td><?php echo $item->datosServicio->nombre_serv ?></td>
                                                    
                                                    <td><?php echo $item->datosServicio->precio->monto ?></td>
                                                    <td><?php echo $item->categoria->nombre_cat_ex ?></td>
                                                    <td>
                                                    <span class="onoffswitch">
													    <input
                                                            type="checkbox" <?php echo ($item->datosServicio->activo == true) ? 'checked' : ''; ?>
                                                            class="onoffswitch-checkbox"
                                                            id="<?php echo $item->datosServicio->id_serv ?>"
                                                            data-url="<?php echo CHtml::normalizeUrl(['Servicio/ChangeStateServicio', 'id' => $item->datosServicio->id_serv]); ?>">
															<label class="onoffswitch-label"
                                                                   for="<?php echo $item->datosServicio->id_serv ?>">
                                                                <span class="onoffswitch-inner" data-swchon-text="SI"
                                                                      data-swchoff-text="no"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                    </span>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo CHtml::link('Editar', ['servicio/update', 'grupo' => $dataUrl['grupo'], 'tipo' => $dataUrl['tipo'], 'id' => $item->id_serv], ['class' => 'btn btn-primary btn-xs']);
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach;
                                        } ?>
                                        </tbody>
                                    </table>
                                </div>
                        </fieldset>
                        <div class="form-actions">
                            <?php echo CHtml::link('Agregar Servicio', array('servicio/create', 'grupo' => $dataUrl['grupo'], 'tipo' => $dataUrl['tipo']), array('class' => 'btn btn-info')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!--Start Scripts-->
<!-- start plugins-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/servicio/examenIndex.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/select2/select2.min.js', CClientScript::POS_END); ?>
<!--end plugins-->
<!--end plugins-->
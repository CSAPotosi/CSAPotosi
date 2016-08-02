<?php
/* $this ServicioController */
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
                                <div class="table-responsive">
                                    <center class="text-align-center"><h2>Lista de Servicios</h2></center>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="icon-addon addon-md">
                                                <input type="text" placeholder="Nombre del Servicio"
                                                       class="form-control" id="searchServicio">
                                                <label class="glyphicon glyphicon-search"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <?php echo CHtml::link('Categorias', ['categoriaServicio/index', 'grupo' => $dataUrl['grupo'], 'tipo' => $dataUrl['tipo']]); ?>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Codigo Servicio</th>
                                            <th>Servicio</th>
                                            <th>Unidad de Medida</th>
                                            <th>Precio del Servicio</th>
                                            <th>Tipo de cobro</th>
                                            <th>Fecha Creacion</th>
                                            <th>Fecha Edicion</th>
                                            <th>
                                                <select style="width:100%" class="select2 select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true" placeholder="Categorio">
                                                    
                                                </select>
                                                <span
                                                    class="select2 select2-container select2-container--default select2-container--above select2-container--open"
                                                    dir="ltr" style="width: 100%;">

                                                </span>
                                            </th>
                                            <th>Activo</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if ($listServicio != null) { ?>
                                            <?php foreach ($listServicio as $item): ?>
                                                <tr class="val"
                                                    data-nombre="<?php echo $item->servExamenServicio->nombre_serv ?>">
                                                    <td><?php echo $item->servExamenServicio->cod_serv ?></td>
                                                    <td><?php echo $item->servExamenServicio->nombre_serv ?></td>
                                                    <td><?php echo $item->servExamenServicio->unidad_medida ?></td>
                                                    <td><?php echo $item->servExamenServicio->precio_serv ?></td>
                                                    <td><?php switch ($item->servExamenServicio->tipo_cobro) {
                                                            case 1:
                                                                echo "unidad";
                                                                break;
                                                            case 2:
                                                                echo "mas de uno";
                                                                break;
                                                            case 3:
                                                                echo "Por Uso";
                                                                break;
                                                            case 4:
                                                                echo "Por Dia";
                                                                break;
                                                        } ?></td>
                                                    <td><?php echo $item->servExamenServicio->fecha_creacion ?></td>
                                                    <td><?php echo $item->servExamenServicio->fecha_edicion ?></td>
                                                    <td><?php echo $item->servExamenCategoria->nombre_cat_ex ?></td>
                                                    <td>
                                                    <span class="onoffswitch">
													    <input
                                                            type="checkbox" <?php echo ($item->servExamenServicio->activo == true) ? 'checked' : ''; ?>
                                                            name="start_interval" class="onoffswitch-checkbox"
                                                            id="<?php echo $item->servExamenServicio->id_serv ?>"
                                                            data-url="<?php echo CHtml::normalizeUrl(['Servicio/ChangeStateServicio', 'id' => $item->servExamenServicio->id_serv]); ?>">
															<label class="onoffswitch-label"
                                                                   for="<?php echo $item->servExamenServicio->id_serv ?>">
                                                                <span class="onoffswitch-inner" data-swchon-text="YES"
                                                                      data-swchoff-text="NO"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label> 
                                                    </span>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            <?php endforeach;
                                        } ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="10"
                                                class="text-align-right"><?php echo CHtml::link('Agregar Servicio', array('cargo/create'), array('class' => 'btn btn-info')); ?></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!-- start plugins-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/servicio/examenIndex.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/select2/select2.min.js', CClientScript::POS_END); ?>

<!--end plugins-->

<script>

</script>

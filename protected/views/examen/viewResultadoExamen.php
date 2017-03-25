<?php $this->pageTitle = 'EXAMENES DE LABORATORIO';?>

<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$resultado->detallePrestacion->prestacion->historial]);?>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <div class="widget-body-toolbar padding-5">
                            <a href="<?= CHtml::normalizeUrl(['examen/viewResultadoExamenPDF','id_res'=>$resultado->id_res])?>" class="btn btn-default" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a>
                        </div>
                        <legend class="padding-10">RESULTADO DE EXAMEN</legend>
                        <?php if($resultado->detalleResultados):?>
                        <table class="table table-hover table-striped table-bordered margin-bottom-5">
                            <thead>
                            <tr>
                                <th width="30%">PARAMETRO</th>
                                <th width="30%">VALOR OBTENIDO</th>
                                <th width="40%">VALORES DE REFERENCIA</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($resultado->detalleResultados as $detalle):?>
                                <tr>
                                    <td>
                                        <?php echo $detalle->parametro->nombre_par;?>
                                    </td>
                                    <td>
                                        <?php echo $detalle->valor_res;?>
                                        ( <?php echo $detalle->parametro->ext_par;?> )
                                    </td>
                                    <td>
                                        <?= nl2br($detalle->parametro->val_ref) ?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                        <?php endif;?>
                        <table class="table table-hover table-striped table-bordered">
                            <tbody>
                            <tr>
                                <th class="text-align-right" width="30%">Diagnostico:</th>
                                <td><?php echo $resultado->diagnostico_res;?></td>
                            </tr>
                            <tr>
                                <th class="text-align-right" width="30%">Observaciones:</th>
                                <td><?php echo $resultado->observacion_res;?></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
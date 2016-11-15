<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <?php if($resultado->detalleResultados):?>
                        <table class="table table-hover table-striped table-bordered margin-bottom-5">
                            <thead>
                            <tr>
                                <th width="30%">Parametro</th>
                                <th width="70%">Valor obtenido</th>
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
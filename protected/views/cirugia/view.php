<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <table class="table table-hover table-striped">
                            <tbody>
                            <tr>
                                <th width="20%" class="text-align-right">PACIENTE</th>
                                <td>
                                    <?php echo $cirugia->historial->paciente->persona->nombreCompleto;?>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-align-right">SALA</th>
                                <td>
                                    <?php echo "{$cirugia->sala->cod_sala} ({$cirugia->sala->tSala->servicio->nombre_serv})"; ?>
                                </td>
                            </tr>
                            <?php if($cirugia->reservado):?>
                                <tr>
                                    <th class="text-align-right">ESTADO</th>
                                    <td>PROGRAMADO</td>
                                </tr>
                                <tr>
                                    <th class="text-align-right">FECHA Y HORA PROGRAMACION</th>
                                    <td><?php echo date('d/m/Y H:i',strtotime($cirugia->fec_reserva));?></td>
                                </tr>
                                <tr>
                                    <th class="text-align-right">TIEMPO ESTIMADO (MIN)</th>
                                    <td><?php echo $cirugia->tiempo_estimado;?></td>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <th class="text-align-right">ESTADO</th>
                                    <td>CONFIRMADO</td>
                                </tr>
                                <tr>
                                    <th class="text-align-right">FECHA Y HORA INICIO</th>
                                    <td><?php echo date('d/m/Y H:i',strtotime($cirugia->fec_inicio));?></td>
                                </tr>
                                <tr>
                                    <th class="text-align-right">FECHA Y HORA FIN</th>
                                    <td><?php echo date('d/m/Y H:i',strtotime($cirugia->fec_fin));?></td>
                                </tr>
                                <tr>
                                    <th class="text-align-right">TIEMPO TOTAL (MIN)</th>
                                    <td><?php echo $cirugia->tiempo_real;?></td>
                                </tr>
                                <tr>
                                    <th class="text-align-right">INSTRUMENTAL</th>
                                    <td><?php echo $cirugia->detalle_instrumental;?></td>
                                </tr>
                                <tr>
                                    <th class="text-align-right">NATURALEZA</th>
                                    <td><?php echo $cirugia->naturaleza;?></td>
                                </tr>
                                <tr>
                                    <th class="text-align-right">PERSONAL</th>
                                    <td>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th width="60%">NOMBRE</th>
                                                <th width="30%">ROL</th>
                                                <th width="10%">RESP.</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($cirugia->personalCirugias as $personal):?>
                                                <tr>
                                                    <td><?php echo $personal->persona->nombreCompleto;?></td>
                                                    <td><?php echo $personal->rol_cirugia;?></td>
                                                    <td>
                                                        <?php
                                                        if($personal->responsable)
                                                            echo "<span class='label label-primary'>SI</span>";
                                                        else
                                                            echo "<span class='label label-danger'>NO</span>";
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach;?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            <?php endif;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
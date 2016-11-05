<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <?php if($examenList):?>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="15%">Fecha</th>
                                    <th width="45%">Paciente</th>
                                    <th width="30%">Examen</th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($examenList as $examen):?>
                                    <?php if($examen->servicio->servExamen && $examen->servicio->servExamen->categoria->tipo_ex == 1):?>
                                    <tr>
                                        <td><?php echo date('d/m/Y H:i',strtotime($examen->fecha_solicitud))?></td>
                                        <td><?php echo $examen->prestacion->historial->paciente->persona->nombres;?></td>
                                        <td><?php echo $examen->servicio->nombre_serv;?></td>
                                        <td>
                                            <a href="<?php echo CHtml::normalizeUrl(['examen/createResultadoExamen','id_det_pres'=>$examen->id_detalle]);?>" class="btn btn-xs btn-primary">
                                                <i class="fa fa-pencil"></i>
                                                Realizar
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        <?php else:?>
                            <div class="alert alert-info">
                                <strong>
                                    No se han encontrado resultados
                                </strong>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
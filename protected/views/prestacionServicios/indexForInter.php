<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$iModel->historial]);?>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Servicios otorgados durante la internacion</legend>
                            <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th>
                                        Fecha y Hora
                                    </th>
                                    <th>Servicio</th>
                                    <th>Cant.</th>
                                    <th>SubTotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $total=0;?>
                                <?php foreach($iModel->prestaciones->detallePrestacions as $itemPres):?>
                                    <tr>
                                        <td><?php echo date('d/m/Y H:i',strtotime($itemPres->fecha_solicitud));?></td>
                                        <td><?php echo $itemPres->servicio->nombre_serv;?></td>
                                        <td><?php echo $itemPres->cantidad;?></td>
                                        <td><?php $total+=$itemPres->subtotal; echo $itemPres->subtotal;?></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <td colspan="3">Total</td>
                                        <td><?php echo $total;?></td>
                                    </tr>
                                </tfooter>
                            </table>

                        </fieldset>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
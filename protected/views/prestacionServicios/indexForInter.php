<?php $this->pageTitle = 'INTERNACION - <small>SERVICIOS OTORGADOS</small>';?>

<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$iModel->historial]);?>
<style>
    #table-detail>tbody>tr>td:last-child,table>tbody>tr>td:nth-child(3){
        text-align: right;
    }
    #table-detail>thead>tr>th{
        text-align: center;
    }
</style>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>SERVICIOS OTORGADOS DURANTE LA INTERNACION</legend>
                            <table class="table table-bordered table-condensed table-hover" id="table-detail">
                                <thead>
                                <tr>
                                    <th>
                                        FECHA Y HORA
                                    </th>
                                    <th>SERVICIO</th>
                                    <th>CANTIDAD</th>
                                    <th>SUBTOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $total=0;?>
                                <?php foreach($iModel->prestaciones->detallePrestacions as $itemPres):?>
                                    <tr>
                                        <td><?php echo date('d/m/Y H:i',strtotime($itemPres->fecha_solicitud));?></td>
                                        <td><?php echo $itemPres->servicio->nombre_serv;?></td>
                                        <td><?php echo $itemPres->cantidad;?></td>
                                        <td><?php $total+=$itemPres->subtotal; echo number_format($itemPres->subtotal,2);?></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <th colspan="3">TOTAL</th>
                                        <td><?php echo number_format($total,2);?></td>
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
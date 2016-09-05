<?php echo CHtml::link('Nuevo',['servicio/create','grupo'=>$dataUrl['grupo']]);?>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <table class="table table-hovered table-bordered">
                            <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>DESCRIPCION</th>
                                <th>COSTO</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tSalaList as $tSalaItem):?>
                                <tr>
                                    <td><?php echo $tSalaItem->servicio->nombre_serv;?></td>
                                    <td></td>
                                    <td><?php echo $tSalaItem->servicio->precio->monto;?></td>
                                    <td>
                                        <?php echo CHtml::link('Editar',['servicio/update','grupo'=>$dataUrl['grupo'],'id'=>$tSalaItem->id_serv], ['class'=>'btn btn-primary btn-xs']);?>
                                        <?php echo CHtml::link('Ver',['servicio/view','grupo'=>$dataUrl['grupo'],'id'=>$tSalaItem->id_serv], ['class'=>'btn btn-primary btn-xs']);?>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<?php
    $this->pageTitle = 'Lista de tipos de salas';
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <table class="table table-hovered table-hover table-bordered">
                            <thead>
                            <tr>
                                <th width="20%" style="text-align: center">NOMBRE</th>
                                <th width="40%" style="text-align: center">DESCRIPCION</th>
                                <th width="10%" style="text-align: center">COSTO</th>
                                <th width="10" style="text-align: center">ACTIVO</th>
                                <th width="20%"></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tSalaList as $tSalaItem):?>
                                <tr>
                                    <td><?php echo $tSalaItem->servicio->nombre_serv;?></td>
                                    <td></td>
                                    <td style="text-align: right"><?php echo $tSalaItem->servicio->precio->monto;?></td>
                                    <td style="text-align: center">
                                        <?php
                                            if($tSalaItem->servicio->activo)
                                                echo '<span class="label label-primary">ACTIVO</span>';
                                            else
                                                echo '<span class="label label-danger">INACTIVO</span>';
                                        ?>
                                    </td>
                                    <td style="text-align: center">
                                        <?php echo CHtml::link('<i class="fa fa-edit"></i> Editar',['servicio/update','grupo'=>$dataUrl['grupo'],'id'=>$tSalaItem->id_serv], ['class'=>'btn btn-primary btn-xs']);?>
                                        <?php echo CHtml::link('<i class="fa fa-eye"></i> Detalle',['servicio/view','grupo'=>$dataUrl['grupo'],'id'=>$tSalaItem->id_serv], ['class'=>'btn btn-primary btn-xs']);?>
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

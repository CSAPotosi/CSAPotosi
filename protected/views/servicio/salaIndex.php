<?php
    $this->pageTitle = 'Grupos de salas';
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body no-padding">
                        <legend class="padding-5">Lista de grupos</legend>
                        <table class="table table-hovered table-hover table-bordered" id="groups-table">
                            <thead>
                            <tr>
                                <th class="hasinput">
                                    <input type="text" class="form-control" placeholder="NOMBRE">
                                </th>
                                <th class="hasinput">
                                    <input type="text" class="form-control" placeholder="DESCRIPCION">
                                </th>
                                <th class="hasinput">
                                    <select class="form-control">
                                        <option value="">TODOS</option>
                                        <option value="QUIROFANO">QUIROFANOS</option>
                                        <option value="INTERNACION">INTERNACION</option>
                                    </select>
                                </th>
                                <th class="hasinput">
                                    <input type="text" class="form-control" placeholder="COSTO">
                                </th>
                                <th class="hasinput">
                                    <select class="form-control">
                                        <option value="">TODOS</option>
                                        <option value="ACTIVO">ACTIVO</option>
                                        <option value="INACTIVO">INACTIVO</option>
                                    </select>
                                </th>
                                <th></th>
                            </tr>
                            <tr>
                                <th width="20%" style="text-align: center">NOMBRE</th>
                                <th width="30%" style="text-align: center">DESCRIPCION</th>
                                <th width="10%" style="text-align: center">TIPO</th>
                                <th width="10%" style="text-align: center">COSTO (Bs.)</th>
                                <th width="10" style="text-align: center">ACTIVO</th>
                                <th width="20%"></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tSalaList as $tSalaItem):?>
                                <tr>
                                    <td><?php echo $tSalaItem->servicio->nombre_serv;?></td>
                                    <td><?php echo $tSalaItem->descripcion_t_sala;?></td>
                                    <td>
                                        <?php
                                            if($tSalaItem->servicio->tipo_cobro == 2)
                                                echo '<span class="label label-info">INTERNACION</span>';
                                            else
                                                echo '<span class="label label-info">QUIROFANO</span>';
                                        ?>
                                    </td>
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

<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/jquery.dataTables.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.colVis.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.tableTools.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.bootstrap.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatable-responsive/datatables.responsive.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/servicio/salaIndex.js',CClientScript::POS_END);
?>

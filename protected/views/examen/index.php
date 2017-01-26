<?php $this->pageTitle = 'EXAMENES DE LABORATORIO';?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <legend class="padding-10">LISTA DE EXAMENES PENDIENTES</legend>
                        <?php if($examenList):?>
                        <table class="table table-bordered table-striped table-hover" id="examen-table">
                            <thead>
                                <tr>
                                    <th class="hasinput"><input type="text" class="form-control" placeholder="FECHA Y HORA"></th>
                                    <th class="hasinput"><input type="text" class="form-control" placeholder="PACIENTE"></th>
                                    <th class="hasinput"><input type="text" class="form-control" placeholder="EXAMEN"></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th width="15%">FECHA Y HORA</th>
                                    <th width="45%">PACIENTE</th>
                                    <th width="30%">EXAMEN</th>
                                    <th width="10%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($examenList as $examen):?>
                                    <?php if($examen->servicio->servExamen && $examen->servicio->servExamen->categoria->tipo_ex == 1):?>
                                    <tr>
                                        <td><?php echo date('d/m/Y H:i',strtotime($examen->fecha_solicitud))?></td>
                                        <td><?php echo $examen->prestacion->historial->paciente->persona->nombreCompleto;?></td>
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

<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/jquery.dataTables.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.colVis.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.tableTools.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.bootstrap.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatable-responsive/datatables.responsive.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/examen/index.js', CClientScript::POS_END);
?>
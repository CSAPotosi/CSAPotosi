<?php $this->pageTitle = 'REPORTES DE LABORATORIO';?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <div class="widget-body-toolbar padding-5">
                            <?= CHtml::beginForm(['reporteLaboratorio/indexPDF'],'post',['id'=>'form-pdf','target'=>'_blank'])?>
                            <button type="button" id="btn-report-all" class="btn btn-default btn-sm pull-left"><i class="fa fa-file-pdf-o"></i> PDF</button>
                            <?= CHtml::endForm()?>
                            <?php echo CHtml::beginForm();?>
                            <button type="submit" class="btn btn-primary btn-sm pull-right">Consultar</button>
                            <div id="reportrange" class="pull-right margin-right-5" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; ">
                                <input type="hidden" name="fec_ini" id="fec_ini">
                                <input type="hidden" name="fec_fin" id="fec_fin">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                <span></span> <b class="caret"></b>
                            </div>
                            <?php echo CHtml::endForm();?>
                        </div>
                        <legend class="padding-10">EXAMENES DE LABORATORIO</legend>
                        <?php if ($labList):?>
                        <canvas id="pieChart" height="70"></canvas>
                        <?php endif;?>
                        <table class="table table-bordered table-hover table-striped" id="custom-table">
                            <thead>
                            <tr>
                                <th width="10%">FECHA Y HORA</th>
                                <th width="30%">PACIENTE</th>
                                <th width="30%">EXAMEN</th>
                                <th width="15%">REALIZADO</th>
                                <th width="5%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php  $r=0;$nr=0; foreach ($labList as $lab):?>
                                <tr>
                                    <td><?php echo date('d/m/Y H:i',strtotime($lab->fecha_solicitud));?></td>
                                    <td><?php echo $lab->prestacion->historial->paciente->persona->nombreCompleto;?></td>
                                    <td><?php echo $lab->servicio->nombre_serv;?></td>
                                    <td>
                                        <?php

                                            if($lab->realizado){
                                                $r++;
                                                echo '<span class="label label-primary">SI</span>';
                                            }
                                            else{
                                                $nr++;
                                                echo '<span class="label label-danger">NO</span>';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default btn-report">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </button>
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
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/bootstrap-daterangepicker/js/moment.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/bootstrap-daterangepicker/js/daterangepicker.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/chartjs/chart.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/jquery.dataTables.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.colVis.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.tableTools.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.bootstrap.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatable-responsive/datatables.responsive.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/reporte/common.js',CClientScript::POS_END)
    ->registerScript('script',"
        $(function() {
            var start = moment('".$fec_ini."','DD/MM/YYYY');
            var end = moment('".$fec_fin."','DD/MM/YYYY');
            function cb(start, end) {
                $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
                $('#fec_ini').val(start.format('DD/MM/YYYY'));
                $('#fec_fin').val(end.format('DD/MM/YYYY'));
            }
            $('#reportrange').daterangepicker({
                locale:{'format':'DD/MM/YYYY','customRangeLabel':'Personalizado'},
                startDate: start,
                endDate: end,
                ranges: {
                   'Hoy': [moment(), moment()],
                   'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
                   'Este mes': [moment().startOf('month'), moment().endOf('month')],
                   'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);
            cb(start, end);
        });
        
        $('#btn-report-all').on('click',function(){
            $('#form-pdf').find('input').remove();
            $('#form-pdf').append($('#reportrange').find('input').clone());
            $('#form-pdf').submit();
            return false;
        });
        
        var pieConfig = {
            type: 'pie',
            data:{
                datasets:[{data:[ {$r},{$nr} ],backgroundColor:['blue','red']}],
                labels:[ 'REALIZADOS','NO REALIZADO' ]
            },
            options: {
                responsive: true
            }
        };

        $(document).ready(function(){
            var myPie = new Chart(document.getElementById('pieChart'), pieConfig);
        });
    ");
?>


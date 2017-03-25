<?php $this->pageTitle = 'REPORTES DE CIRUGIA';?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">

                <header>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <div class="widget-body-toolbar padding-5">
                            <?= CHtml::beginForm(['reporteCirugia/estadisticaSalaPDF'],'post',['id'=>'form-pdf','target'=>'_blank'])?>
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
                        <legend class="padding-10">USO DE QUIROFANOS</legend>
                        <?php if ($cirugiaList):?>
                        <canvas id="pieChart" height="70"></canvas>
                        <?php endif;?>
                        <table class="table table-hover table-striped table-bordered" id="custom-table">
                            <thead>
                            <tr>
                                <th width="20%">FECHA Y HORA</th>
                                <th width="40%">GRUPO</th>
                                <th width="40%">SALA</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $report = [];
                            ?>
                            <?php foreach($cirugiaList as $cirugia):?>
                            <tr>
                                <td><?php echo date('d/m/Y H:i',strtotime($cirugia->fec_inicio));?></td>
                                <td><?php
                                    echo "{$cirugia->sala->tSala->servicio->nombre_serv}";
                                    $id = $cirugia->sala->tSala->servicio->id_serv;
                                    $report[$id]['count'] = isset($report[$id]['count'])?$report[$id]['count']+1:1;
                                    $report[$id]['name'] = $cirugia->sala->tSala->servicio->nombre_serv;
                                    ?>
                                </td>
                                <td><?php
                                    echo "{$cirugia->sala->cod_sala}";
                                    $report[$id]['items'][$cirugia->sala->id_sala]['count'] = isset($report[$id]['items'][$cirugia->sala->id_sala]['count'])?$report[$id]['items'][$cirugia->sala->id_sala]['count']+1:1;
                                    $report[$id]['items'][$cirugia->sala->id_sala]['name'] = $cirugia->sala->cod_sala;
                                    ?></td>
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
    $data = '[';$color = '[';$label = '[';
    foreach ($report as $r){
        $data.= $r['count'].',';
        $color.= '"#'.str_pad(dechex(rand(0,255)),2,'0',STR_PAD_LEFT).str_pad(dechex(rand(0,255)),2,'0',STR_PAD_LEFT).str_pad(dechex(rand(0,255)),2,'0',STR_PAD_LEFT).'",';
        $label.= '"'.$r['name'].'",';
    }
    $data.="]";$color.="]";$label.="]";

    $json = "{ datasets: [{ data: {$data},backgroundColor: {$color} }], labels: {$label} }";
?>

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
            data:".$json.",
            options: {
                responsive: true
            }
        };
        
        $(document).ready(function(){
            var myPie = new Chart(document.getElementById('pieChart'), pieConfig); 
        });
    ");
?>
<?php
$totales = [];
foreach ($labList as $lab){
    $totales[$lab->servicio->nombre_serv] = isset($totales[$lab->servicio->nombre_serv])? $totales[$lab->servicio->nombre_serv]+1:1;
}

$data = '[';$color = '[';$label = '[';
foreach ($totales as $i=>$tot){
    $data.= $tot.',';
    $color.= '"#'.str_pad(dechex(rand(0,255)),2,'0',STR_PAD_LEFT).str_pad(dechex(rand(0,255)),2,'0',STR_PAD_LEFT).str_pad(dechex(rand(0,255)),2,'0',STR_PAD_LEFT).'",';
    $label.= '"'.$i.'",';
}
$data.="]";$color.="]";$label.="]";
$json = "{ datasets: [{ data: {$data},backgroundColor: {$color} }], labels: {$label} }";
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar padding-5">
                            <button id="btn-report-all" data-url="<?php echo CHtml::normalizeUrl(['reporteLaboratorio/indexPDF'])?>" class="btn btn-default btn-sm pull-left"><i class="fa fa-file-pdf-o"></i> PDF</button>
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
                        <canvas id="pieChart" height="70"></canvas>
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th width="10%">Fecha y hora</th>
                                <th width="30%">Paciente</th>
                                <th width="30%">Examen</th>
                                <th width="15%">Realizado</th>
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
            var form = $('<form>',{
                action:$(this).data('url'),
                target:'_blank',
                method:'post'
            });
            
            form.append($('#reportrange').find('input').clone());
            form.submit();
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


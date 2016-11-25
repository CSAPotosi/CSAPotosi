<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1" data-widget-refreshbutton="false">

                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar padding-5">
                            <button id="btn-report-all" data-url="<?php echo CHtml::normalizeUrl(['reporteCirugia/estadisticaPersonalPDF'])?>" class="btn btn-default btn-sm pull-left"><i class="fa fa-file-pdf-o"></i> PDF</button>
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
                        <div class="row">
                            <div class="col-md-6">
                                <h6>MOTIVO</h6>
                                <canvas id="pieChart1" height="120"></canvas>
                            </div>
                            <div class="col-md-6">
                                <h6>PROCEDENCIA</h6>
                                <canvas id="pieChart2" height="120"></canvas>
                            </div>
                        </div>
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

        /*$('#btn-report-all').on('click',function(){
            var form = $('<form>',{
                action:$(this).data('url'),
                target:'_blank',
                method:'post'
            });

            form.append($('#reportrange').find('input').clone());
            form.submit();
            return false;
        });*/

        var pieConfig = {
            type: 'pie',
            data:{
                datasets:[{data:[ {$motivo[0]},{$motivo[1]},{$motivo[2]}, ],backgroundColor:['blue','red','green']}],
                labels:[ 'ENFERMEDAD','ACCIDENTE','PARTO' ]
            },
            options: {
                responsive: true
            }
        };

        var pieConfig2 = {
            type: 'pie',
            data:{
                datasets:[{data:[ {$procedencia[0]},{$procedencia[1]},{$procedencia[2]}, ],backgroundColor:['blue','red','green']}],
                labels:[ 'CONSULTA EXTERNA','EMERGENCIA','EXTERNO' ]
            },
            options: {
                responsive: true
            }
        };

        $(document).ready(function(){
            var myPie = new Chart(document.getElementById('pieChart1'), pieConfig);
            var myPie2 = new Chart(document.getElementById('pieChart2'), pieConfig2);
        });
    ");
?>
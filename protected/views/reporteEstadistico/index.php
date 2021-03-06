<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <button id="btn-report-all"
                                    data-url="<?php echo CHtml::normalizeUrl(['reporteEstadistico/EstadisticoPdf']) ?>"
                                    class="btn btn-default btn-sm pull-left"><i class="fa fa-file-pdf-o"></i> PDF
                            </button>
                            <?php echo CHtml::beginForm(); ?>
                            <div class="row">
                                <div class="col-md-3" id="selector">
                                    <select class="form-control" name="Report[tipoEstadistico]">
                                        <option value="0">Consulta Externa</option>
                                        <option value="1">Hospitalizacion</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary btn-xs pull-right">Ver reporte</button>
                                    <div id="reportrange" class="pull-right margin-right-5"
                                         style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; ">
                                        <input type="hidden" name="Report[fec_ini]" id="fec_ini">
                                        <input type="hidden" name="Report[fec_fin]" id="fec_fin">
                                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                                        <span></span> <b class="caret"></b>
                                    </div>
                                </div>
                            </div>
                            <?php echo CHtml::endForm(); ?>
                        </div>
                        <fieldset>
                            <legend>Reportes Estadisticos</legend>
                            <div>
                                <?php if ($capitulo) { ?>
                                    <div class="jarviswidget-editbox">
                                        <input class="form-control" type="text">
                                    </div>
                                    <div class="widget-body">
                                        <canvas id="pieChart" height="80"></canvas>
                                    </div>
                                <?php } ?>
                            </div>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Capitulo</th>
                                    <th>Descripcion</th>
                                    <th>Cantidad</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($capitulo as $cap => $cant) {
                                    $nombre = CapituloCie::model()->findByPk($cap);
                                    echo "<tr><td>" . $cap . "</td>
                                          <td>" . $nombre->titulo_cap . "</td>
                                          <td>" . $cant . "</td></tr>";
                                } ?>
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<?php
$data = '[';
$color = '[';
$label = '[';
foreach ($capitulo as $c => $p) {
    $nombre = CapituloCie::model()->findByPk($c);
    $data .= $p . ',';
    $color .= '"#' . str_pad(dechex(rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(rand(0, 255)), 2, '0', STR_PAD_LEFT) . str_pad(dechex(rand(0, 255)), 2, '0', STR_PAD_LEFT) . '",';
    $label .= '"' . $nombre->titulo_cap . '",';
}
$data .= "]";
$color .= "]";
$label .= "]";
$json = "{ datasets: [{ data: {$data},backgroundColor: {$color} }], labels: {$label} }";
?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/chartjs/chart.min.js', CClientScript::POS_END); ?>
<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/bootstrap-daterangepicker/js/moment.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/bootstrap-daterangepicker/js/daterangepicker.js', CClientScript::POS_END)
    ->registerScript('script', "
        $(function() {
            var start = moment('" . $fec_ini . "','DD/MM/YYYY');
            var end = moment('" . $fec_fin . "','DD/MM/YYYY');
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
                form.append($('#selector').find('select').clone());
                form.submit();
                return false;
            });
            var pieConfig = {
                type: 'pie',
                data:" . $json . ",
                options: {
                    responsive: true
                }
            };
            $(document).ready(function(){
                var myPie = new Chart(document.getElementById('pieChart'), pieConfig); 
            });
    ");
?>




<?php
    $personalList = [];
    foreach ($cirugiaList as $cirugia){
        foreach ($cirugia->personalCirugias as $pc){
            $personalList[$pc->id_per]['nombre'] = $pc->persona->nombreCompleto;
            $personalList[$pc->id_per]['roles'][$pc->rol_cirugia] = isset($personalList[$pc->id_per]['roles'][$pc->rol_cirugia])?$personalList[$pc->id_per]['roles'][$pc->rol_cirugia]+1:1;
            $personalList[$pc->id_per]['total'] = isset($personalList[$pc->id_per]['total'])?$personalList[$pc->id_per]['total']+1:1;
        }
    }
?>
<?php $this->pageTitle = 'REPORTES DE CIRUGIA';?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">

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
                        <legend>PERSONAL</legend>
                        <?php if ($cirugiaList):?>
                            <canvas id="pieChart" height="70"></canvas>
                        <?php endif;?>
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="30%">MEDICO/ENFERMERA</th>
                                <th width="30%">ROL</th>
                                <th width="20%">PARTICIPACION</th>
                                <th width="20%">TOTAL PART.</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($personalList as $personal):?>
                                    <?php $i=0;foreach ($personal['roles'] as $rol=>$rol_cant):?>
                                        <?php if($i == 0):?>
                                        <tr>
                                            <td rowspan="<?php echo count($personal['roles']);?>"><?php echo $personal['nombre'];?></td>
                                            <td><?php echo $rol;?></td>
                                            <td><?php echo $rol_cant;?></td>
                                            <td rowspan="<?php echo count($personal['roles']);?>"><?php echo $personal['total'];?></td>
                                        </tr>
                                        <?php else:?>
                                        <tr>
                                            <td><?php echo $rol;?></td>
                                            <td><?php echo $rol_cant;?></td>
                                        </tr>
                                        <?php endif;?>
                                    <?php $i++;endforeach;?>
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
foreach ($personalList as $p){
    $data.= $p['total'].',';
    $color.= '"#'.str_pad(dechex(rand(0,255)),2,'0',STR_PAD_LEFT).str_pad(dechex(rand(0,255)),2,'0',STR_PAD_LEFT).str_pad(dechex(rand(0,255)),2,'0',STR_PAD_LEFT).'",';
    $label.= '"'.$p['nombre'].'",';
}
$data.="]";$color.="]";$label.="]";
$json = "{ datasets: [{ data: {$data},backgroundColor: {$color} }], labels: {$label} }";
?>

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
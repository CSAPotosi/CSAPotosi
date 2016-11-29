<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1" data-widget-refreshbutton="false">

                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar padding-5">
                            <button id="btn-report-all" data-url="<?php echo CHtml::normalizeUrl(['seguridad/auditTXT']);?>" class="btn btn-default btn-sm pull-left"><i class="fa fa-file-text-o"></i> TXT</button>
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
                        <table class="table table-bordered table-hover table-striped table-condensed">
                            <thead>
                            <tr>
                                <th>Tabla</th>
                                <th>Fecha</th>
                                <th>Accion</th>
                                <th>Original</th>
                                <th>Nuevo</th>
                                <th>Consulta</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($audit as $au): ?>
                                <tr>
                                    <td><?php echo $au['table_name'];?></td>
                                    <td><?php echo date('d/m/Y H:i:s',strtotime($au['action_tstamp']));?></td>
                                    <td><?php echo $au['action'];?></td>
                                    <td><?php echo $au['original_data'];?></td>
                                    <td><?php echo $au['new_data'];?></td>
                                    <td><?php echo $au['query'];?></td>
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

    ");
?>


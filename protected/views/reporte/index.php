<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">

                <header>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <div class="widget-body-toolbar padding-5">
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
                        <legend class="padding-10">REPORTES GENERADOS</legend>
                        <table class="table table-hover table-bordered table-striped" id="custom-table">
                            <thead>
                            <tr>
                                <th class="hasinput">
                                    <input type="text" placeholder="FECHA Y HORA" class="form-control">
                                </th>
                                <th class="hasinput">
                                    <input type="text" placeholder="NOMBRE" class="form-control">
                                </th>
                                <th class="hasinput">
                                    <input type="text" placeholder="USUARIO" class="form-control">
                                </th>
                                <th></th>
                            </tr>
                            <tr>
                                <th>FECHA Y HORA</th>
                                <th>NOMBRE</th>
                                <th>USUARIO</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($reportes as $reporte):?>
                                <tr>
                                    <td><?= HelpTools::getDate($reporte->fecha_report)->format('d/m/Y H:i:s')?></td>
                                    <td><?= $reporte->name_report?></td>
                                    <td><?= $reporte->usuario->nombre_usuario?></td>
                                    <td class="text-align-center">
                                        <a href="<?= CHtml::normalizeUrl(['reporte/view','id'=>$reporte->id_au_report])?>" class="btn btn-primary btn-xs" target="_blank">
                                            <i class="fa fa-file-pdf-o"></i> Descargar
                                        </a>
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


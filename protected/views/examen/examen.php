<?php
    $this->pageTitle = 'EXAMENES DE LABORATORIO';
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <legend class="padding-10">ADMINISTRACION DE EXAMENES DE LABORATORIO</legend>
                        <table class="table table-striped table-bordered table-hover" id="examen-table">
                            <thead>
                            <tr>
                                <th class="hasinput"><input type="text" class="form-control" placeholder="NOMBRE"></th>
                                <th class="hasinput"><input type="text" class="form-control" placeholder="CONDICIONES"></th>
                                <th class="hasinput"><input type="text" class="form-control" placeholder="CATEGORIA"></th>
                                <th></th>
                            </tr>
                            <tr>
                                <th width="30%">NOMBRE</th>
                                <th width="30%">CONDICIONES</th>
                                <th width="25%">CATEGORIA</th>
                                <th width="15%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($examenList as $examen):?>
                                <tr>
                                    <td><?php echo $examen->datosServicio->nombre_serv;?></td>
                                    <td><?php echo $examen->condiciones;?></td>
                                    <td><?php echo $examen->categoria->nombre_cat_ex;?></td>
                                    <td>
                                        <a href="<?php echo CHtml::normalizeUrl(['examen/adminExamenParams','id_ex' => $examen->id_serv])?>" class="btn btn-primary btn-xs">
                                            <i class="fa fa-list"></i>
                                            Adm. parametros
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
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/jquery.dataTables.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.colVis.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.tableTools.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatables/dataTables.bootstrap.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/datatable-responsive/datatables.responsive.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/examen/index.js', CClientScript::POS_END);
?>
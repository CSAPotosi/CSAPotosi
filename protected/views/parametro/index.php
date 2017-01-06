<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <table class="table-striped table table-hover table-bordered" id="params-table">
                            <thead>
                            <tr>
                                <th class="hasinput">
                                    <input type="text" placeholder="Nombre" class="form-control">
                                </th>
                                <th class="hasinput">
                                    <input type="text" placeholder="Extension" class="form-control">
                                </th>
                                <th class="hasinput">
                                    <select class="form-control" style="width: 100%">
                                        <option value="">TODOS</option>
                                        <option value="EXAMEN">EXAMEN</option>
                                        <option value="SIGNOS VITALES">SIGNOS VITALES</option>
                                        <option value="ANTECEDENTE">ANTECEDENTES</option>
                                    </select>
                                </th>
                                <th></th>
                            </tr>
                            <tr>
                                <th width="40%">Nombre</th>
                                <th width="20%">Extension</th>
                                <th width="30%">Tipo</th>
                                <th>

                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach (Parametro::model()->findAll() as $param):?>
                                <tr>
                                    <td><?php echo $param->nombre_par;?></td>
                                    <td><?php echo $param->ext_par;?></td>
                                    <td><?php echo Parametro::model()->getTipo()[$param->tipo_par];?></td>
                                    <td>
                                        <a href="<?php echo CHtml::normalizeUrl(['parametro/edit','id_p'=>$param->id_par])?>" class="btn btn-xs btn-primary">
                                            <i class="fa fa-edit"></i> Editar
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
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/parametro/index.js', CClientScript::POS_END);
?>
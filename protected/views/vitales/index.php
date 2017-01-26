<?php
$this->pageTitle = 'SIGNOS VITALES';
?>
    <section id="widget-grid">
        <div class="row">
            <article class="col-md-12">
                <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                    <header>
                    </header>
                    <div>
                        <div class="widget-body no-padding">
                            <legend class="padding-10">SIGNOS VITALES REGISTRADOS</legend>
                            <table class="table table-bordered table-hover table-condensed table-striped" id="vitales-table">
                                <thead>
                                <tr>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Fecha y hora">
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="Parametro">
                                    </th>
                                    <th class="hasinput"></th>
                                </tr>
                                <tr>
                                    <th width="20%">FECHA Y HORA</th>
                                    <th width="60%">PARAMETRO</th>
                                    <th width="60%">VALOR</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($historial->signosVitales as $vital):?>
                                    <tr>
                                        <td><?= date('d/m/Y H:i:s',strtotime($vital->fecha_sv));?></td>
                                        <td><?= $vital->parametro->nombre_par;?> <?= ($vital->parametro->ext_par=="")?"":" ( {$vital->parametro->ext_par} ) " ?> </td>
                                        <td><?php
                                            $json_def = json_decode($vital->parametro->def_par);
                                            if($json_def->type == "boolean")
                                                echo  "SI";
                                            else
                                                echo $vital->valor_sv;
                                            ?></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>

                            <legend class="padding-10">REGISTRAR SIGNOS VITALES</legend>
                            <?= CHtml::beginForm(['vitales/create','h_id'=>$historial->id_historial],'post');?>
                            <table class="table table-bordered table-hover table-condensed table-striped" id="vitales-table-form">
                                <thead>
                                <tr>
                                    <th class="hasinput">
                                        <input type="text" class="form-control input-sm" PLACEHOLDER="Parametro">
                                    </th>
                                    <th>
                                        <button type="submit" class="btn btn-primary pull-right">
                                            <i class="fa fa-save"></i> Guardar
                                        </button>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="50%">PARAMETRO</th>
                                    <th width="50%">VALOR</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $index = 0;if($vital_list):?>
                                    <?php foreach ($vital_list as $vital):?>
                                        <tr>
                                            <td><?= $vital->parametro->nombre_par;?></td>
                                            <td>
                                                <div class="form-group">
                                                    <?php
                                                    $json_def = json_decode($vital->parametro->def_par);
                                                    switch ($json_def->type){
                                                        case 'numeric':
                                                            echo CHtml::activeTextField($vital,"[$index]valor_sv",['class'=>'form-control input-sm']);
                                                            break;
                                                        case 'list':
                                                            $list[""] = "Elegir item";
                                                            foreach($json_def->list as $item){
                                                                $list[$item] = $item;
                                                            }
                                                            echo CHtml::activeDropDownList($vital,"[$index]valor_sv",$list,['class'=>'form-control input-sm']);
                                                            break;
                                                        case 'boolean':
                                                            echo CHtml::activeCheckBox($vital,"[$index]valor_sv",['uncheckValue'=>'']);
                                                            break;
                                                        default:
                                                            echo CHtml::activeTextArea($vital,"[$index]valor_sv",['class'=>'form-control input-sm']);
                                                            break;
                                                    }
                                                    echo CHtml::activeHiddenField($vital,"[$index]id_par");
                                                    echo CHtml::error($vital,"[$index]valor_sv",['class'=>'label label-danger']);
                                                    $index++;
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                                </tbody>
                            </table>
                            <?= CHtml::endForm();?>
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
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/vitales/index.js', CClientScript::POS_END);
?>
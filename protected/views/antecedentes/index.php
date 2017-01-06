<?php
    $this->pageTitle = 'Antecedentes';
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <legend style="padding-left: 5px;">Antecedentes registrados</legend>
                        <table class="table table-bordered table-hover table-condensed table-striped" id="antecedentes-table">
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
                                <th width="20%">Fecha y hora</th>
                                <th width="60%">Parametro</th>
                                <th width="60%">Valor</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($historial->antecedentes as $antecedente):?>
                                <tr>
                                    <td><?= date('d/m/Y H:i:s',strtotime($antecedente->fecha_ant));?></td>
                                    <td><?= $antecedente->parametro->nombre_par;?> <?= ($antecedente->parametro->ext_par=="")?"":" ( {$antecedente->parametro->ext_par} ) " ?> </td>
                                    <td><?php
                                        $json_def = json_decode($antecedente->parametro->def_par);
                                        if($json_def->type == "boolean")
                                            echo  "SI";
                                        else
                                            echo $antecedente->valor_ant;
                                        ?></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>

                        <legend style="padding-left: 5px;">Registrar antecedentes</legend>
                        <?= CHtml::beginForm(['antecedentes/create','h_id'=>$historial->id_historial],'post');?>
                        <table class="table table-bordered table-hover table-condensed table-striped" id="antecedentes-table-form">
                            <thead>
                            <tr>
                                <th class="hasinput">
                                    <input type="text" class="form-control input-sm">
                                </th>
                                <th>
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-save"></i> Guardar
                                    </button>
                                </th>
                            </tr>
                            <tr>
                                <th width="50%">Parametro</th>
                                <th width="50%">Valor</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $index = 0;if($antecedente_list):?>
                            <?php foreach ($antecedente_list as $antecedente):?>
                            <tr>
                                <td><?= $antecedente->parametro->nombre_par;?></td>
                                <td>
                                    <div class="form-group">
                                        <?php
                                        $json_def = json_decode($antecedente->parametro->def_par);
                                        switch ($json_def->type){
                                            case 'numeric':
                                                echo CHtml::activeTextField($antecedente,"[$index]valor_ant",['class'=>'form-control input-sm']);
                                                break;
                                            case 'list':
                                                $list[""] = "Elegir item";
                                                foreach($json_def->list as $item){
                                                    $list[$item] = $item;
                                                }
                                                echo CHtml::activeDropDownList($antecedente,"[$index]valor_ant",$list,['class'=>'form-control input-sm']);
                                                break;
                                            case 'boolean':
                                                echo CHtml::activeCheckBox($antecedente,"[$index]valor_ant",['uncheckValue'=>'']);
                                                break;
                                            default:
                                                echo CHtml::activeTextArea($antecedente,"[$index]valor_ant",['class'=>'form-control input-sm']);
                                                break;
                                        }
                                        echo CHtml::activeHiddenField($antecedente,"[$index]id_par");
                                        echo CHtml::error($antecedente,"[$index]valor_ant",['class'=>'label label-danger']);
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
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/antecedentes/index.js', CClientScript::POS_END);
?>
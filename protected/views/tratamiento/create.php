<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$dModel->historial]);?>

<section id="widget-grid">
    <div class="row">
        <div class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget-historial">
                <header>
                </header>

                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Tratamiento</legend>
                            <?php echo CHtml::errorSummary($tModel,'<h4 class="alert-heading"><i class="fa fa-warning"></i> Debe corregir los siguientes errores:</h4>',null,['class'=>'alert alert-danger']);?>
                            <?php echo CHtml::beginForm();?>
                                <div class="form-group">
                                    <?php echo CHtml::activeLabelEx($tModel, 'instrucciones');?>
                                    <?php echo CHtml::activeTextArea($tModel, 'instrucciones',['class'=>'form-control']);?>
                                    <?php echo CHtml::error($tModel, 'instrucciones', ['class'=>'label label-danger']);?>
                                </div>
                                <div class="form-group">
                                    <?php echo CHtml::activeLabelEx($tModel, 'observaciones');?>
                                    <?php echo CHtml::activeTextArea($tModel, 'observaciones',['class'=>'form-control']);?>
                                    <?php echo CHtml::error($tModel, 'observaciones', ['class'=>'label label-danger']);?>
                                </div>
                                <legend>
                                    Receta
                                </legend>
                                <table class="table-receta table table-bordered table-stripped table-responsive table-condensed">
                                    <thead>
                                        <tr>
                                            <th width="30%">MEDICAMENTO</th>
                                            <th width="15%">CANTIDAD</th>
                                            <th width="20%">VIA</th>
                                            <th width="25%">PAUTA</th>
                                            <th width="10%">
                                                <button type="button" class="btn btn-primary btn-xs" id="btn-add-item">
                                                    <i class="fa fa-plus"></i>
                                                    Agregar
                                                </button>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <i>Para a&ntildeadir items a la receta presione el boton "Agregar"</i>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($rList):?>
                                            <?php
                                            $index = 0;
                                            foreach ($rList as $rItem):
                                            ?>
                                            <tr>
                                                <td style="padding: 0;vertical-align: middle">
                                                    <i><a href="#" class="select-med selected" data-toggle="modal" data-target="#modal-receta">
                                                            <?php if($rItem->medicamento):?>
                                                                <?php echo $rItem->medicamento->nombre_med;?>
                                                            <?php else:?>
                                                                Seleccionar medicamento
                                                            <?php endif;?>
                                                        </a>
                                                    </i>
                                                    <?php echo CHtml::activeHiddenField($rItem,"[{$index}]codigo_med");?>
                                                    <?php echo CHtml::error($rItem,"[{$index}]codigo_med",['class'=>'label label-danger']);?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::activeTextField($rItem,"[{$index}]cant_solicitada",['class'=>'form-control', 'placeholder'=>'CANTIDAD','id'=>""]);?>
                                                    <?php echo CHtml::error($rItem,"[{$index}]cant_solicitada",['class'=>'label label-danger']);?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::activeDropDownList($rItem,"[{$index}]via",Receta::model()->getOptionsVia(),['class'=>'form-control','placeholder'=>'VIA','id'=>'']);?>
                                                    <?php echo CHtml::error($rItem,"[{$index}]via",['class'=>'label label-danger']);?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::activeTextArea($rItem,"[{$index}]pauta",['class'=>'form-control', 'placeholder'=>'PAUTA','rows'=>'1','id'=>'']); ?>
                                                    <?php echo CHtml::error($rItem,"[{$index}]pauta",['class'=>'label label-danger']);?>
                                                </td>
                                                <td style="padding: 0;vertical-align: middle">
                                                    <button type="button" class="btn btn-danger btn-xs btn-remove-item">
                                                        <i class="fa fa-remove"></i>
                                                        Borrar
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                            $index++;
                                            endforeach;
                                            ?>
                                        <?php endif;?>
                                    </tbody>
                                </table>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i>
                                        Guardar
                                    </button>
                                </div>
                            <?php echo CHtml::endForm();?>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade modal-primary" id="modal-receta" data-url="<?php echo CHtml::normalizeUrl(['medicamento/getItemsAjax','selectable'=>true]);?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="modal-title">
                            SELECCIONE UN MEDICAMENTO DE LA LISTA
                        </h4>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="input-sm form-control" placeholder="MEDICAMENTO" id="input-search-medi">
                    </div>
                </div>
            </div>
            <div class="modal-body no-padding">
                <div class="well no-margin" style="color: #000 !important;">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div id="templates" style="display: none">
    <table id="item-receta">
        <tr>
            <td style="padding: 0;vertical-align: middle">
                <i><a href="#" class="select-med" data-toggle="modal" data-target="#modal-receta">Seleccionar medicamento</a></i>
                <?php echo CHtml::activeHiddenField(new Receta(),"[]codigo_med");?>
            </td>
            <?php
            echo "<td>".CHtml::activeTextField(new Receta(),'[]cant_solicitada',['class'=>'form-control', 'placeholder'=>'CANTIDAD','id'=>""])."</td>";
            echo "<td>".CHtml::activeDropDownList(new Receta(),'[]via',Receta::model()->getOptionsVia(),['class'=>'form-control','placeholder'=>'VIA','id'=>''])."</td>";
            echo "<td>".CHtml::activeTextArea(new Receta(),'[]pauta',['class'=>'form-control', 'placeholder'=>'PAUTA','rows'=>'1','id'=>''])."</td>";
            ?>
            <td style="padding: 0;vertical-align: middle">
                <button type="button" class="btn btn-danger btn-xs btn-remove-item">
                    <i class="fa fa-remove"></i>
                    Borrar
                </button>
            </td>
        </tr>
    </table>
</div>
<style>
    .table-receta tr th:last-child,.table-receta tr td:last-child{
        text-align: center;
    }
    .table-receta textarea{
        resize: none;
    }
    .select-med{
        border-bottom: dashed 1px;
    }
</style>

<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/tratamiento/create.js',CClientScript::POS_END)
?>
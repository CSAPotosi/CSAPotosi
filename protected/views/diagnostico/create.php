<?php
    $this->pageTitle = 'DIAGNOSTICO'
?>
<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$historialModel]);?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">

                        <?php echo CHtml::beginForm();?>
                        <fieldset>
                            <legend>NUEVO DIAGNOSTICO</legend>
                            <?php echo CHtml::errorSummary($diagnosticoModel,'<h4 class="alert-heading"><i class="fa fa-warning"></i> Debe corregir los siguientes errores:</h4>',null,['class'=>'alert alert-danger error-message']);?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($diagnosticoModel,'anamnesis');?>
                                        <?php echo CHtml::activeTextArea($diagnosticoModel,'anamnesis',['class'=>'form-control']);?>
                                        <?php echo CHtml::error($diagnosticoModel,'anamnesis',['class'=>'label label-danger error-message']);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <?php echo CHtml::activeLabelEx($diagnosticoModel,'exploracion');?>
                                    <?php echo CHtml::activeTextArea($diagnosticoModel,'exploracion',['class'=>'form-control']);?>
                                    <?php echo CHtml::error($diagnosticoModel,'exploracion',['class'=>'label label-danger error-message']);?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($diagnosticoModel,'conclusion');?>
                                        <?php echo CHtml::activeTextArea($diagnosticoModel,'conclusion',['class'=>'form-control']);?>
                                        <?php echo CHtml::error($diagnosticoModel,'conclusion',['class'=>'label label-danger error-message']);?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($diagnosticoModel,'observaciones');?>
                                        <?php echo CHtml::activeTextArea($diagnosticoModel,'observaciones',['class'=>'form-control']);?>
                                        <?php echo CHtml::error($diagnosticoModel,'observaciones',['class'=>'label label-danger error-message']);?>
                                    </div>
                                </div>
                            </div>
                            <?php echo CHtml::activeHiddenField($diagnosticoModel,'tipo');?>
                        </fieldset>
                        <table class="table table-responsive table-bordered table-condensed" id="table-consulta-cie">
                            <thead>
                                <tr>
                                    <th colspan="3" class="row-unique">Clasificacion Internacional de Enfermedades (CIE10)</th>
                                </tr>
                                <tr>
                                    <th>CODIGO</th>
                                    <th>TITULO</th>
                                    <th><button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-cie">Agregar</button></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($dcList)>0):?>
                                    <?php foreach ($dcList as $dcItem):?>
                                        <tr>
                                            <td><?php echo $dcItem->codigo;?></td>
                                            <td><?php echo $dcItem->cie->titulo;?></td>
                                            <td>
                                                <button type='button' class='btn btn-xs btn-primary btn-remove-item'><i class='fa fa-remove'></i> Quitar</button>
                                                <input type='hidden' name='DiagnosticoCie[][codigo]' value="<?php echo $dcItem->codigo;?>">
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php else:?>
                                <tr>
                                    <th colspan="3" class="row-unique">No se ha especificado ningun item CIE10.</th>
                                </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Guardar
                            </button>
                        </div>
                        <?php echo CHtml::endForm();?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<div class="modal fade modal-primary" id="modal-cie" data-url="<?php echo CHtml::normalizeUrl(['cie/getCieAjax']);?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                SELECCIONE UN ITEM DE LA LISTA
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

<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/select2/select2.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/diagnostico/create.js',CClientScript::POS_END);
?>
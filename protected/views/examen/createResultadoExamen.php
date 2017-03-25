<?php
    $this->pageTitle = 'EXAMENES DE LABORATORIO';
?>

<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$detallePrestacion->prestacion->historial]);?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <?php echo CHtml::beginForm();?>
                        <fieldset>
                            <legend>EXAMEN DE <?php echo $detallePrestacion->servicio->nombre_serv;?></legend>
                            <?php echo CHtml::errorSummary(array_merge([$resultado],$detalleList),'<h4 class="alert-heading"><i class="fa fa-warning"></i> Debe corregir los siguientes errores:</h4>',null,['class'=>'alert alert-danger error-message']);?>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <?php if($detalleList):?>
                                    <div class="row margin-bottom-10">
                                        <?php $index = 1;foreach ($detalleList as $detalle):?>
                                                <div class="col-md-4 margin-top-5">
                                                    <label><?php echo $detalle->parametro->nombre_par;?></label>
                                                    <div class="input-group">
                                                        <?php $flag=false;$json = json_decode($detalle->parametro->def_par); ?>
                                                        <?php
                                                            switch ($json->type){
                                                                case 'numeric':
                                                                    echo CHtml::activeTextField($detalle,"[{$index}]valor_res",['class'=>'form-control']);
                                                                    break;
                                                                case 'list':
                                                                    $lista = [];
                                                                    foreach ($json->list as $item)
                                                                        $lista[$item]=$item;
                                                                    echo CHtml::activeDropDownList($detalle,"[{$index}]valor_res",$lista,['class'=>'form-control']);
                                                                    break;
                                                                case 'boolean':
                                                                    echo CHtml::activeCheckBox($detalle,"[{$index}]valor_res",['value'=>'1']);
                                                                    $flag = true;
                                                                    break;
                                                                default:
                                                                    echo CHtml::activeTextArea($detalle,"[{$index}]valor_res",['class'=>'form-control']);
                                                                    break;
                                                            }
                                                        ?>
                                                        <?php echo CHtml::activeHiddenField($detalle,"[{$index}]id_par");?>
                                                        <?php if(!$flag):?>
                                                        <span class="input-group-addon">
                                                            <?php echo $detalle->parametro->ext_par;?>
                                                        </span>
                                                        <?php endif;?>
                                                    </div>

                                                    <?php echo CHtml::error($detalle,"[{$index}]valor_res",['class'=>'label label-danger error-message']);?>
                                                </div>
                                            <?php $index++; endforeach;?>
                                    </div>
                                    <?php endif;?>
                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($resultado,'diagnostico_res');?>
                                        <?php echo CHtml::activeTextArea($resultado,'diagnostico_res',['class'=>'form-control']);?>
                                        <?php echo CHtml::error($resultado,'diagnostico_res',['class'=>'label label-danger error-message']);?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo CHtml::activeLabelEx($resultado,'observacion_res');?>
                                        <?php echo CHtml::activeTextArea($resultado,'observacion_res',['class'=>'form-control']);?>
                                        <?php echo CHtml::error($resultado,'observacion_res',['class'=>'label label-danger error-message']);?>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i>
                                Guardar
                            </button>
                        </div>
                        <?php echo CHtml::endForm();?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
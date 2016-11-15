<style>
    #table-selected-params tbody tr{
        cursor: pointer;
    }
    #table-selected-params tbody tr.selected-param{
        background: #357ca5;
        color: #FFF;
    }
</style>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <?php echo CHtml::beginForm();?>
                        <?php echo CHtml::errorSummary($epList,'<h4 class="alert-heading"><i class="fa fa-warning"></i> Debe corregir los siguientes errores:</h4>',null,['class'=>'alert alert-danger']);?>
                        <?php echo CHtml::activeHiddenField($examen,'id_serv');?>
                        <fieldset>
                            <legend>Datos de examen</legend>
                            <table class="table table-striped table-bordered table-hover">
                                <tbody>
                                <tr>
                                    <th width="20%" class="text-align-right">Nombre</th>
                                    <td><?php echo $examen->datosServicio->nombre_serv;?></td>
                                </tr>
                                <tr>
                                    <th class="text-align-right">Condiciones</th>
                                    <td><?php echo $examen->condiciones;?></td>
                                </tr>
                                <tr>
                                    <th class="text-align-right">Categoria</th>
                                    <td><?php echo $examen->categoria->nombre_cat_ex;?></td>
                                </tr>
                                </tbody>
                            </table>
                            <legend>Parametros</legend>
                            <div class="btn-group margin-bottom-5">
                                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-params"><i class="fa fa-plus"></i> Agregar</button>
                                <button type="button" id="btn-remove-row" class="btn btn-default btn-xs"><i class="fa fa-minus"></i> Eliminar</button>
                                <button type="button" id="btn-up-row" class="btn btn-default btn-xs"><i class="fa fa-arrow-up"></i> Subir</button>
                                <button type="button" id="btn-down-row" class="btn btn-default btn-xs"><i class="fa fa-arrow-down"></i> Bajar</button>
                            </div>
                            <table id="table-selected-params" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="5%">Ord.</th>
                                    <th width="65%">Nombre</th>
                                    <th width="30%">Extension</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $index = 1; if($epList):?>
                                        <?php foreach ($epList as $ep):?>
                                        <tr data-id="<?php echo $ep->id_par;?>">
                                            <td><?php echo $index;?></td>
                                            <td><?php echo $ep->parametro->nombre_par;?></td>
                                            <td>
                                                <?php echo $ep->parametro->ext_par;?>
                                                <?php echo CHtml::activeHiddenField($ep,"[{$index}]id_par");?>
                                                <input type="hidden" name="ExamenParametro[<?php echo $index;?>][orden]" value="<?php echo $index;?>">
                                            </td>
                                        </tr>
                                        <?php $index++; endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </fieldset>
                        <div class="form-actions">
                            <button class="btn btn-primary">
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

<div class="modal fade modal-primary" id="modal-params" data-url="<?php echo CHtml::normalizeUrl(['examen/getParamsTable']);?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="modal-title">Seleccione parametros</h4>
                    </div>
                </div>
            </div>
            <div class="modal-body no-padding">
                <div class="well no-margin">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" id="btn-select-param"><i class="fa fa-plus"></i> Seleccionar</button>
                <button type="button" class="btn btn-outline" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
            </div>
        </div>
    </div>
</div>

<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/examen/adminExamenParams.js',CClientScript::POS_END);
?>
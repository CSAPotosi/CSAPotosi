
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
                            <legend>
                                Parametros
                            </legend>
                            <?php echo CHtml::errorSummary($parametro,'<h4 class="alert-heading"><i class="fa fa-warning"></i> Debe corregir los siguientes errores:</h4>',null,['class'=>'alert alert-danger']);?>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <?php echo CHtml::activeLabelEx($parametro,'nombre_par');?>
                                                <?php echo CHtml::activeTextField($parametro,'nombre_par',['class'=>'form-control']);?>
                                                <?php echo CHtml::error($parametro,'nombre_par',['class'=>'label label-danger']);?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <?php echo CHtml::activeLabelEx($parametro,'ext_par');?>
                                                <?php echo CHtml::activeTextField($parametro,'ext_par',['class'=>'form-control']);?>
                                                <?php echo CHtml::error($parametro,'ext_par',['class'=>'label label-danger']);?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php echo CHtml::activeLabelEx($parametro,'tipo_par');?>
                                                <?php echo CHtml::activeDropDownList($parametro,'tipo_par',$parametro->getTipo(),['class'=>'form-control']);?>
                                                <?php echo CHtml::error($parametro,'tipo_par',['class'=>'label label-danger']);?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?= CHtml::activeHiddenField($parametro,'def_par');?>
                                                <label for="param_type">TIPO DE DATO</label>
                                                <select id="param_type" class="form-control">
                                                    <option value="string">TEXTO</option>
                                                    <option value="boolean">SI/NO</option>
                                                    <option value="numeric">NUMERICO</option>
                                                    <option value="list">LISTA GENERICA</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="param_def">
                                        <div class="param_def_type">

                                        </div>
                                        <div class="param_def_options">
                                        </div>
                                        <div class="param_def_values">
                                        </div>
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

<div id="templates" class="hidden">
    <div class="numeric">
        <div class="row">
            <div class="col-md-4">
                <label for="check-range">RESTRINGIR</label>
                <input type="checkbox" class="has-range" id="check-range">
                <span class="label label-danger input-error"></span>
            </div>
            <div class="col-md-4">
                <input type="text" class="input-range input-range-min form-control" disabled placeholder="Val. Minimo">
            </div>
            <div class="col-md-4">
                <input type="text" class="input-range input-range-max form-control" disabled placeholder="Val. Maximo">
            </div>
        </div>
    </div>
    <div class="list">
        <div class="row">
            <div class="col-md-6">
                <label>LISTA:</label>
                <div class="panel">
                    <div class="panel-body status item-list">
                    </div>
                </div>
                <span class="label label-danger input-error"></span>
            </div>
            <div class="col-md-6">
                <label>NUEVO ITEM:</label>
                <div class="input-group">
                    <input type="text" class="input-add-item form-control" placeholder="Agregar item">
                    <div class="input-group-btn">
                        <button type="button" class="btn-add-item btn btn-default">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="item who clearfix no-padding">
        <b><span class="texto"></span></b><span class="remove-item-list pull-right"><i class="fa fa-close"></i></span>
    </div>
</div>
<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/parametro/formParametro.js', CClientScript::POS_END);
?>
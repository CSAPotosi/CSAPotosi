<?php
    $modelTSala = ServTipoSala::model()->with([
        'servicio'=>['condition'=>'activo AND tipo_cobro = 2']
    ])->findAll();
?>


<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-6">
                                    <?php echo CHtml::beginForm(['Servicio/getSalasAjax','type'=>1],'post',['class'=>'smart-form','id'=>'form-t-sala'])?>
                                        <label class="select">
                                            <?php echo CHtml::dropDownList('tSala',null,CHtml::listData($modelTSala,'id_serv','servicio.nombre_serv'),['class'=>'input-sm'])?>
                                            <i></i>
                                        </label>
                                    <?php echo CHtml::endForm();?>
                                </div>
                            </div>
                        </div>
                        <div class="widget-body-container">
                            
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<?php
    Yii::app()->clientScript
        ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/servicio/sala.js',CClientScript::POS_END);
?>
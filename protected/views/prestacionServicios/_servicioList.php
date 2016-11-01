<?php
    $catExList = CategoriaServExamen::model()->findAll(['order'=>'tipo_ex ASC, nombre_cat_ex ASC']);
?>
<div class="jarviswidget" id="widget-list" data-widget-refreshbutton="false" data-widget-fullscreenbutton="false" data-widget-togglebutton="false">
    <header>
        <h2><strong>LISTA DE SERVICIOS</strong></h2>
        <ul id="widget-tab-1" class="nav nav-tabs pull-right in">
            <li class="active">
                <a data-toggle="tab" href="#hr1" id="tab-hr1">
                    <span class="hidden-mobile hidden-tablet"> Examenes </span>
                </a>
            </li>
            <li>
                <a data-toggle="tab" href="#hr2" id="tab-hr2">
                    <span class="hidden-mobile hidden-tablet"> Clinicos</span>
                </a>
            </li>
        </ul>
    </header>
    <div>
        <div class="widget-body no-padding">
            <div class="widget-body-toolbar">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-search"></i>
                        </span>
                            <input type="text" class="form-control input-sm" id="search-servicio" placeholder="BUSCAR SERVICIO">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php echo CHtml::dropDownList('examenTipoList','',CategoriaServExamen::model()->getNombreTipo(),['class'=>'form-control input-sm'])?>
                    </div>
                </div>
            </div>
            <div class="tab-content padding-10">
                <div class="tab-pane active" id="hr1">
                    <?php foreach ($catExList as $itemCEx):?>
                        <fieldset class="categoria" data-tipo="<?php echo $itemCEx->tipo_ex;?>">
                            <legend><?php echo $itemCEx->nombre_cat_ex;?></legend>
                            <div class="row">
                                <?php $this->renderPartial('_servicioItem',['servItemList'=> $itemCEx->examenes]);?>
                            </div>
                        </fieldset>
                    <?php endforeach;?>
                </div>
                <div class="tab-pane" id="hr2">
                    contenido
                </div>
            </div>
        </div>
    </div>
</div>

<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/prestacionServicios/_servicioList.js',CClientScript::POS_END);
?>

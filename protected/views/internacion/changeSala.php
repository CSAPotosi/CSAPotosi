<?php
    $this->pageTitle = 'INTERNACION - <small>CAMBIO DE SALA</small>';

    $modelTSala = ServTipoSala::model()->with([
        'servicio'=>['condition'=>'activo']
    ])->findAll();

    $isModel = $internacionModel->salaActual;
    if($isModel == null){
        $isModel = new InternacionSala();
        $isModel->id_sala=0;
    }

?>

<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$internacionModel->historial]);?>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>CAMBIAR SALA</legend>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="small-box bg-primary margin-bottom-5" id="selected-sala">
                                        <div class="inner text-align-center">
                                            <h3><?php echo ($isModel->isNewRecord)?'<i class="fa fa-bed"></i>':$isModel->sala->cod_sala;?></h3>
                                            <p><?php echo ($isModel->isNewRecord)?'Ninguno':$isModel->sala->tSala->servicio->nombre_serv;?></p>
                                        </div>
                                        <a href="#" id="sala" class="small-box-footer" data-toggle="modal" data-target="#modal-sala">
                                            Elegir sala
                                        </a>
                                    </div>
                                    <?php echo CHtml::beginForm(null,'post',['id'=>'form-inter-sala']);?>
                                    <div class="form-group">
                                        <?php echo CHtml::activeTextField($isModel, 'fecha_entrada',['class'=>'form-control', 'value'=>date('d/m/Y H:i')]);?>
                                    </div>
                                    <div class="form-group" id="item-sala">
                                        <?php echo CHtml::activeHiddenField($isModel,'id_sala');?>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary btn-block disabled btn-change-sala" disabled>
                                            <i class="fa fa-exchange"></i>
                                            Cambiar Sala
                                        </button>
                                    </div>
                                    <?php echo CHtml::endForm();?>
                                </div>
                                <div class="col-md-10">
                                    <?php $this->renderPartial('_salaTable',['salas'=>$internacionModel->salas]);?>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<div class="modal fade modal-primary" id="modal-sala" data-url="<?php echo CHtml::normalizeUrl(['Servicio/getSalasAjax'])?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="modal-title">Seleccione sala</h4>
                    </div>
                    <div class="col-md-6">
                        <?php echo CHtml::dropDownList('tSala',null,CHtml::listData($modelTSala,'id_serv','servicio.nombre_serv'),['class'=>'input-sm form-control pull-left'])?>
                    </div>
                </div>
            </div>
            <div class="modal-body no-padding">
                <div class="well no-margin">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/internacion/changeSala.js',CClientScript::POS_END);
?>
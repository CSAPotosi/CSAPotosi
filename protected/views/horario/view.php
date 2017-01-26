<?php
    $errors = $periodoModel->hasErrors();
?>
<div class="row">
    <div class="col-md-12">
        <div class="well no-padding" id="ciclo" data-ciclo="<?php echo CHtml::encode($horarioModel->ciclo_total);?>">
            <table class="table table-hovered table-striped table-condensed">
                <tbody>
                    <tr>
                        <th class="text-align-right" width="20%">HORARIO</th>
                        <td width="80%"><?php echo Chtml::encode($horarioModel->nombre_horario);?></td>
                    </tr>
                    <tr>
                        <th class="text-align-right" width="20%">DESCRIPCION</th>
                        <td width="80%"><?php echo Chtml::encode($horarioModel->descripcion);?></td>
                    </tr>
                    <tr>
                        <th class="text-align-right" width="20%">TOTAL DIAS</th>
                        <td width="80%"><?php echo Chtml::encode($horarioModel->ciclo_total);?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-3">
            <div class="jarviswidget jarviswidget-color-blue" id="wid-periodo" data-widget-fullscreenbutton="false" data-widget-togglebutton="false">
                <header>
                    <h2><strong>Periodos</strong></h2>
                    <ul id="widget-tab-period" class="nav nav-tabs pull-right">
                        <li class="<?php echo (!$errors)?'active':'';?>">
                            <a data-toggle="tab" href="#tab-p-list">Lista</a>
                        </li>
                        <li class="<?php echo ($errors)?'active':'';?>">
                            <a data-toggle="tab" href="#tab-p-new">Nuevo</a>
                        </li>
                    </ul>
                </header>
                <div>
                    <div class="widget-body">
                        <div class="tab-content">
                            <!--Tab p list-->
                            <?php $this->renderPartial('_periodoList', ['errors'=>$errors, 'periodoList'=>Periodo::model()->findAll()]);?>
                            <!--Tab p new-->
                            <?php $this->renderPartial('_periodoForm', ['errors'=>$errors,'periodoModel'=>$periodoModel, 'horarioModel'=>$horarioModel]);?>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <article class="col-md-9">
            <div class="jarviswidget jarviswidget-color-blue" id="wid-horario">
                <header>
                    <h2><strong>Horarios</strong></h2>
                </header>
                <div>
                    <div class="widget-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-horario">
                                <thead>
                                <tr>
                                    <th width="7%"></th>
                                    <?php for($day=1;$day<=$horarioModel->ciclo_total;$day++):?>
                                        <th>Dia <?php echo $day;?></th>
                                    <?php endfor;?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php for($hour=0;$hour<24;$hour++):?>
                                    <tr>
                                        <th><?php printf("%02d:00",$hour)?></th>
                                        <?php for($day=1;$day<=$horarioModel->ciclo_total;$day++):?>
                                            <td></td>
                                        <?php endfor;?>
                                    </tr>
                                <?php endfor;?>
                                </tbody>
                            </table>
                        </div>
                        <div class="widget-footer">
                            <?php echo CHtml::beginForm(['horario/setPeriodos','id'=>$horarioModel->id_horario],'post',['id'=>'form-edit-lapse']);?>
                                <?php echo CHtml::submitButton('Guardar',['class'=>'btn btn-primary'])?>
                            <?php echo CHtml::endForm();?>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<script>
    var lapses = [
        <?php foreach ($horarioModel->horarioPeriodos as $itemHP):?>
        {
            <?php
            $startM = Yii::app()->dateTimeTools->convertTimeToMinutes($itemHP->periodo->hora_entrada);
            $endM = Yii::app()->dateTimeTools->convertTimeToMinutes($itemHP->periodo->hora_salida);
            ?>
            periodo: <?php echo $itemHP->id_periodo;?> ,
            startMin: <?php echo $startM?> ,
            lenMin: <?php echo $endM + (1440*$itemHP->periodo->tipo_periodo) - $startM;?> ,
            day: <?php echo $itemHP->dia;?>
        },
        <?php endforeach;?>
    ];
</script>

<div id="templates" style="display: none">
    <div class="lapse lapse-full" style="width: 0;height: 0">
        <div class="block block-lapse">
            <a href="#">&times;</a>
        </div>
        <?php echo CHtml::activeHiddenField(new HorarioPeriodo(),'[]id_periodo');?>
        <?php echo CHtml::activeHiddenField(new HorarioPeriodo(),'[]dia');?>
    </div>
    <div class="lapse lapse-partial" style="width: 0;height: 0;">
        <div class="block block-lapse">
            <a href="#">&times;</a>
        </div>
        <div class="block block-lapse-end">
        </div>
        <?php echo CHtml::activeHiddenField(new HorarioPeriodo(),'[]id_periodo');?>
        <?php echo CHtml::activeHiddenField(new HorarioPeriodo(),'[]dia');?>
    </div>
</div>

<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/clockpicker/clockpicker.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/resources/js/plugin/bootstrap-touchspin/jquery.bootstrap-touchspin.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/bootstrap-touchspin/jquery.bootstrap-touchspin.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/horario/view.js',CClientScript::POS_END);
?>
<?php
    $errors = $periodoModel->hasErrors();
?>
<div class="row">
    <div class="col-md-12">
        <div class="well">
            <button class="close" data-dismiss="alert">×
            </button>
            <p>
                <?php echo CHtml::encode($horarioModel->nombre_horario);?>
            </p>
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
                        hola mundo
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/resources/js/plugin/iCheck/all.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/iCheck/icheck.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/horario/view.js',CClientScript::POS_END);
?>
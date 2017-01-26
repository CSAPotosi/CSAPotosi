<?php $this->pageTitle = 'CIRUGIAS'; ?>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        <div class="widget-body-toolbar">
                            <div id="calendar-buttons" data-url="<?php echo CHtml::normalizeUrl(['cirugia/getEventsAjax'])?>">
                                <div class="btn-group">
                                    <a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-month">Mes</a>
                                    <a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-week">Semana</a>
                                    <a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-day">Dia</a>
                                </div>

                                <div class="btn-group">
                                    <a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-prev"><i class="fa fa-chevron-left"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-today">Hoy</a>
                                    <a href="javascript:void(0)" class="btn btn-default btn-xs" id="btn-next"><i class="fa fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/fullcalendar/moment.min.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/fullcalendar/fullcalendar.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/plugin/fullcalendar/locale-all.js',CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/cirugia/index.js',CClientScript::POS_END);
?>

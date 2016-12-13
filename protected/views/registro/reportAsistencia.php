<?php
/* $this ServicioController */
$this->pageTitle = "Reporte <span> >Reporte de Asistencia</span>";
$this->breadcrumbs = array(
    'Reporte',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <?php echo CHtml::beginForm(array(), 'post',
                                array('id' => 'form-report')); ?>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Unidad</label>
                                        <?php echo CHtml::dropDownList('unidad', null,
                                            CHtml::listData(Unidad::model()->findAll(), 'id_unidad', 'nombre_unidad'),
                                            array(
                                                'ajax' => array(
                                                    'type' => 'post',
                                                    'url' => CHtml::normalizeUrl(['Registro/getCargosAjax']),
                                                    'update' => '#cargo',
                                                ), 'class' => 'form-control', 'prompt' => 'TODOS'
                                            )
                                        ); ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Cargo</label>
                                        <?php echo CHtml::dropDownList('cargo', null,
                                            array(), array(
                                                'ajax' => array(
                                                    'type' => 'post',
                                                    'url' => CHtml::normalizeUrl(['Registro/getEmpleadosAjax']),
                                                    'update' => '#empleado',
                                                ), 'class' => 'form-control', 'prompt' => 'TODOS'
                                            )
                                        ); ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Empleado</label>
                                        <?php echo CHtml::dropDownList('empleado', null,
                                            array(), array(
                                                'class' => 'form-control', 'prompt' => 'TODOS'
                                            )
                                        ); ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Fecha Inicio - Fecha Fin</label>
                                        <input type="text" name="daterange" value="" class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-2 col-lg-offset-1">
                                    <div class="form-group">
                                        <br>
                                        <button id="btn-report" class="btn btn-primary btn-lg"><i
                                                class="fa fa-search"></i> Buscar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php echo CHtml::endForm(); ?>
                        </div>

                        <fieldset>
                            <legend>Reporte de Asistencia</legend>
                            <div class="row">
                                <div class="col-md-10 col-lg-offset-1">
                                    <?php $this->renderPartial('listEmpleadosAsistencia', array('listaEmpleadosAsistencia' => $listaEmpleadosAsistencia)) ?>
                                </div>
                        </fieldset>
                        <div class="form-actions">

                            <?php $lista_enviar = serialize($listaEmpleadosAsistencia);
                            $lista_enviar = urlencode($lista_enviar);
                            echo CHtml::link("<i class=\"fa fa-file-pdf-o\"></i> Generar Reporte",
                                array('Registro/CreatePdfAsistencia',
                                    'data' => $lista_enviar),
                                array('target' => '_blank', 'class' => 'btn btn-primary')); ?>

                        </div>

                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!--Start Scripts-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/registro/reportAsistencia.js', CClientScript::POS_END); ?>
<!--End plugins-->
<!-- start plugins-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/bootstrap-daterangepicker/js/moment.min.js', CClientScript::POS_END); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/bootstrap-daterangepicker/js/daterangepicker.js', CClientScript::POS_END); ?>
<!--end plugins-->
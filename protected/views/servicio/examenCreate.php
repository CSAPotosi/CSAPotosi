<?php
/* @var $this UsuarioController */

$this->pageTitle = "Crear <span> > Servicio </span>";
$this->breadcrumbs = array(
    'Create',
);
?>
    <section id="widget-grid">
        <div class="row">
            <article class="col-md-12">
                <div class="jarviswidget" id="widget1">
                    <header>Formulario de Registro de Usuario</header>
                    <div>
                        <div class="widget-body">
                            <?php $this->renderPartial('_form_examen', array('servicio' => $servicio, 'categoria' => $categoria, 'entidad' => $entidad, 'dataUrl' => $dataUrl)); ?>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/select2/select2.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/servicio/createServicio.js', CClientScript::POS_END);
?>
<?php
/* @var $this PacienteController */
$this->pageTitle = "Medico <span> > Lista </span>";
$this->breadcrumbs = array(
    'Medico',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <div class="widget-body-toolbar">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        <input class="form-control" id="input-search-medicos" placeholder="Buscar..."
                                               type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <fieldset>
                            <legend>Lista de medicos</legend>
                            <div class="row" id="medico-list">
                                <!-- Lista de pmedicos (_medicoListView)-->
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-default" id="btn-load-patients" data-page="0"
                                            data-limit="<?php echo Yii::app()->params['itemListLimit']; ?>"
                                            data-url="<?php echo CHtml::normalizeUrl(['medico/getMedicoListAjax']) ?>">
                                        Ver mas
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/medico/index.js', CClientScript::POS_END);
?>
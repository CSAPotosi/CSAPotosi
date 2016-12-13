<?php
/* $this ServicioController */
$this->pageTitle = "Servicio <span> > Atencion Medica</span>";
$this->breadcrumbs = array(
    'AtencionMedica',
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
                            <div class="row">
                                <div class="col-xs-9 col-sm-5 col-md-5 col-lg-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                        <input class="form-control" id="searchMedico" placeholder="Nombre de Medico"
                                               type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <fieldset>
                            <legend>Lista De Atenciones Medicas</legend>
                            <div class="row">
                                <div class="col-md-6 col-lg-offset-3">
                                    <div class="dd" id="nestable3">
                                        <ol class="dd-list">
                                            <?php foreach ($listSpecialty as $item): ?>
                                                <li class="dd-item dd3-item" data-id="15">
                                                    <div class="dd-handle dd3-handle">
                                                        Drag
                                                    </div>
                                                    <div class="dd3-content">
                                                        <?php echo $item->nombre_especialidad ?>
                                                    </div>
                                                    <ol class="dd-list">
                                                        <?php foreach ($servicio->getMedicos($item->id_especialidad) as $var): ?>
                                                            <li class="dd-item val"
                                                                data-nombre="<?php echo $var->medico->persona->getNombreCompleto() ?>">

                                                                <div class="dd3-content" style="padding-left:10px">
                                                                    <div class="row">
                                                                        <div
                                                                            class="col-md-6"><?php echo $var->medico->persona->getNombreCompleto() ?></div>
                                                                        <div
                                                                            class="col-md-3"> <?php echo ($var->atencionMedica != null) ? "<span class='label label-info'>Precio de {$var->atencionMedica->servicio->precio->monto}</span>" :
                                                                                "<span class='label label-danger'>No brinda Atencion</span>" ?></div>
                                                                        <div class="col-md-2 col-md-offset-1">
                                                                            <?php if ($var->atencionMedica != null) { ?>
                                                                                <?php echo CHtml::link('Editar', ['servicio/update', 'grupo' => $dataUrl['grupo'], 'tipo' => $var->id_m_e, 'id' => $var->atencionMedica->id_serv], ['class' => 'btn btn-primary btn-xs']); ?>
                                                                            <?php } else { ?>
                                                                                <?php echo CHtml::link('Editar', ['servicio/create', 'grupo' => $dataUrl['grupo'], 'tipo' => $var->id_m_e], ['class' => "btn btn-primary btn-xs"]); ?>
                                                                            <?php } ?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ol>
                                                </li>
                                            <?php endforeach; ?>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!--Start Scripts-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/servicio/atencionMedicaIndex.js', CClientScript::POS_END); ?>
<!--End plugins-->
<!-- start plugins-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/jquery-nestable/jquery.nestable.min.js', CClientScript::POS_END); ?>

<!--end plugins-->
<script>

</script>

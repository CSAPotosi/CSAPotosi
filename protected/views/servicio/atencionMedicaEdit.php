<?php
/* $this ServicioController */
$this->pageTitle = "Servicio <span> > Editar Atencion Medica</span>";
$this->breadcrumbs = array(
    'atencionMedicaEdit',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Editar Atencion Medica</legend>
                            <div class="row">
                                <div class="col-md-6 col-lg-offset-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="product-content  ">

                                                <table class="table table-striped">
                                                    <tr>
                                                        <td><?php echo "Medico:"; ?></td>
                                                        <td><?php echo $MedicoEspecialidad->medico->persona->getNombreCompleto(); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo "Especialidad:"; ?></td>
                                                        <td><?php echo $MedicoEspecialidad->idEspecialidad->nombre_especialidad; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo CHtml::beginForm(); ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php echo CHtml::activeLabel($atencionMedica, 'activo'); ?>
                                                    <br>
                                                    <span class="onoffswitch">
                                                     <input type="checkbox" name="start_interval"
                                                            class="onoffswitch-checkbox" id="st3">
                                                     <label class="onoffswitch-label" for="st3">
                                                         <span class="onoffswitch-inner" data-swchon-text="YES"
                                                               data-swchoff-text="NO"
                                                               name="ServicioForm[activo]"></span>
                                                         <span class="onoffswitch-switch"></span>
                                                     </label>
                                                </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php echo CHtml::activeLabel($atencionMedica, 'Monto'); ?>
                                                    <?php echo CHtml::activeTextField($atencionMedica, 'monto', ['class' => 'form-control']); ?>
                                                    <?php echo CHtml::error($atencionMedica, 'id_entidad'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php echo CHtml::activeLabel($atencionMedica, 'Entidad'); ?>
                                                    <?php echo CHtml::activeDropDownList($atencionMedica, 'id_entidad', CHtml::listData(Entidad::model()->findAll(), 'id_entidad', 'razon_social'), ['class' => 'form-control']) ?>
                                                    <?php echo CHtml::error($atencionMedica, 'id_entidad'); ?>
                                                </div>
                                            </div>
                                            <input type="hidden" name="ServicioForm[nombre_serv]"
                                                   value="<?php echo $MedicoEspecialidad->idEspecialidad->nombre_especialidad; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <di class="col-md-4">
                                                <div class="form-group">
                                                    <?php echo CHtml::submitButton('Guardar', ['class' => 'btn btn-primary']); ?>
                                                </div>
                                            </di>
                                        </div>
                                    </div>
                                    <?php echo CHtml::endForm(); ?>
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

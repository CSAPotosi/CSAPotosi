<?php
/* @var $this PacienteController */
$this->pageTitle = "Horario <span> > Lista de Horarios </span>";
$this->breadcrumbs = array(
    'Horario',
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
                            <legend>Lista de Horarios</legend>
                            <div class="row">
                                <article class="col-md-8 col-lg-offset-2">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>Nombre de Hoario</th>
                                                <th>Descripcion</th>
                                                <th>Ciclo en dias</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($listHorario as $item): ?>
                                                <tr class="val">
                                                    <td><?php echo $item->nombre_horario; ?></td>
                                                    <td><?php echo $item->descripcion; ?></td>
                                                    <td><?php echo $item->ciclo_total; ?></td>
                                                    <td class="text-align-right">
                                                        <?php echo CHtml::link('Editar', array('horario/update', 'id' => $item->id_horario), array('class' => 'btn btn-info')); ?>
                                                        <span class="glyphicon glyphicon-eye-open"></span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                            <br>
                                        </table>
                                        <div class="form-group">
                                            <?php echo CHtml::link('Adicionar Horario', array('horario/create'), array('class' => 'btn btn-info')); ?>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="row">
                                <article class="col-md-10 col-lg-offset-1">
                                    <div class="well">
                                        <div class="alert alert-info fade in">
                                            <i class="fa-fw fa fa-info"></i>
                                            <strong>Informacion!</strong> .Seleccione Un Horario para ver su periodo
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </fieldset>
                     </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!--Start Scripts-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/servicio/index.js', CClientScript::POS_END); ?>
<!--End plugins-->
<!-- start plugins-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/jquery-nestable/jquery.nestable.min.js', CClientScript::POS_END); ?>

<!--end plugins-->
<script>

</script>

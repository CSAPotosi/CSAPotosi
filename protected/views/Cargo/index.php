<?php
/* @var $this PacienteController */
$this->pageTitle = "Unidad <span> > Lista de cargo </span>";
$this->breadcrumbs = array(
    'Cargo',
);
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <div class="row">
                            <article class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <caption class="text-align-center"><h5><b>Lista de Cargos
                                                    de <?php echo $modelUnidad->nombre_unidad ?></b></h5></caption>
                                        <tr>
                                            <th>Nombre de Cargo</th>
                                            <th>Descripcion</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($listCargo as $item): ?>
                                            <tr>
                                                <td><?php echo $item->nombre_cargo; ?></td>
                                                <td><?php echo $item->descripcion_cargo; ?></td>
                                                <td><input type="checkbox"
                                                           class="btnChangeState" <?php echo ($item->estado == 1) ? 'checked' : ''; ?>
                                                           data-toggle="toggle" data-size="mini" data-on="ACTIVO"
                                                           data-onstyle="primary" data-offstyle="danger"
                                                           data-off="INACTIVO"
                                                           data-url="<?php echo CHtml::normalizeUrl(['Cargo/ChangeStateCargo', 'id' => $item->id_cargo]); ?>">
                                                </td>
                                                <td class="text-align-right"><?php echo CHtml::link('Editar', array('cargo/update', 'id' => $item->id_cargo), array('class' => 'btn btn-info')); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="4"
                                                class="text-align-right"><?php echo CHtml::link('Adicionar cargo', array('cargo/create', 'id' => $id), array('class' => 'btn btn-info')); ?></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!-- start plugins-->
<!--plugin smartwizart
<!--end plugins-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/cargo/index.js', CClientScript::POS_END); ?>
<script>

</script>

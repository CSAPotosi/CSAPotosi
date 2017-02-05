<?php
$this->pageTitle = "PACIENTE";
$this->renderPartial('/layouts/_cardProfile', ['historialModel' => $paciente->historialMedico]); ?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body no-padding">
                        <legend class="padding-10">LISTA DE CONEVENIOS</legend>
                        <?php if ($listAsegurado != []) { ?>
                            <table class="table table-hovered table-bordered" id="groups-table">
                                <thead>
                                <tr>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="NOMBRE">
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="FECHA INICIO">
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="FECHA EDICION">
                                    </th>
                                    <th class="hasinput">
                                        <select class="form-control">
                                            <option value="">TODOS</option>
                                            <option value="TITULAR">TITULAR</option>
                                            <option value="BENEFICIARIO">BENEFICIARIO</option>
                                        </select>
                                    </th>
                                    <th class="hasinput">
                                        <input type="text" class="form-control" placeholder="PACIENTE TITULAR">
                                    </th>
                                    <th class="hasinput">
                                        <select class="form-control">
                                            <option value="">TODOS</option>
                                            <option value="ACTIVO">ACTIVO</option>
                                            <option value="INACTIVO">INACTIVO</option>
                                        </select>
                                    </th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <th width="20%" style="text-align: center">NOMBRE</th>
                                    <th width="15%" style="text-align: center">FECHA INICIO</th>
                                    <th width="15%" style="text-align: center">FECHA EDICION</th>
                                    <th width="10%" style="text-align: center">TIPO ASEGURADO</th>
                                    <th width="20%" style="text-align: center">PACIENTE TITULAR</th>
                                    <th width="10%" style="text-align: center">ACTIVO</th>
                                    <th width="10%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($listAsegurado as $item) : ?>
                                    <tr>
                                        <td><?php echo $item->pacienteConvenio->nombre_convenio ?></td>
                                        <td><?php echo $item->fecha_inicio ?></td>
                                        <td><?php echo ($item->fecha_edicion) ? $item->fecha_edicion : 'null' ?></td>
                                        <td><?php echo ($item->tipo_asegurado == 1) ? 'TITULAR' : 'BENEFICIARIO' ?></td>
                                        <td><?php echo $item->pacienteTitular->persona->getNombreCompleto() ?></td>
                                        <td style="text-align: center">
                                            <?php
                                            if ($item->activo)
                                                echo '<span class="label label-primary">ACTIVO</span>';
                                            else
                                                echo '<span class="label label-danger">INACTIVO</span>';
                                            ?>
                                        </td>
                                        <td style="text-align: center">
                                            <?php echo CHtml::link('<i class="fa fa-edit"></i> Editar', ['Paciente/EditConvenio', 'id' => $item->id_ase_con], ['class' => 'btn btn-primary btn-xs']); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php } else {
                            ?>
                            <div class="alert alert-info fade in">
                                <i class="fa-fw fa fa-info"></i>
                                <strong> Info.</strong> El Paciente no cuenta con un Seguro.
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!--Start Scripts-->
<?php
Yii::app()->clientScript
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/datatables/jquery.dataTables.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/datatables/dataTables.colVis.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/datatables/dataTables.tableTools.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/datatables/dataTables.bootstrap.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/plugin/datatable-responsive/datatables.responsive.min.js', CClientScript::POS_END)
    ->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/paciente/seguroPaciente.js', CClientScript::POS_END);
?>
<!--End plugins-->


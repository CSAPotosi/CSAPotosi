<?php
/* @var $this AuthenticacionController */

$this->breadcrumbs = array(
    'Authenticacion',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>


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
                                        <caption class="text-align-center"><h5>Listado de Roles</h5></caption>
                                        <tr>
                                            <th>Nombre del Rol</th>
                                            <th>Descripcion</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($roleList as $item): ?>
                                            <tr>
                                                <td><?php echo $item->name; ?></td>
                                                <td><?php echo $item->description; ?></td>
                                                <td class="text-align-right"><?php echo CHtml::link('Editar', array('authentication/edit', 'id' => $item->name), array('class' => 'btn btn-info')); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="3"
                                                class="text-align-right"><?php echo CHtml::link('Adicionar Rol Nuevo', array('authentication/create', 'type' => 2), array('class' => 'btn btn-info')); ?></td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </article>
                            <article class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <caption class="text-align-center"><h5>Listado de Tareas</h5></caption>
                                        <tr>
                                            <th>Nombre de la Tarea</th>
                                            <th>Descripcion</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($taskList as $item): ?>
                                            <tr>
                                                <td><?php echo $item->name; ?></td>
                                                <td><?php echo $item->description; ?></td>
                                                <td class="text-align-right"><?php echo CHtml::link('Editar', array('authentication/edit', 'id' => $item->name), array('class' => 'btn btn-info')); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="3"
                                                class="text-align-right"><?php echo CHtml::link('Adicionar Tarea Nueva', array('authentication/create', 'type' => 1), array('class' => 'btn btn-info')); ?></td>
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
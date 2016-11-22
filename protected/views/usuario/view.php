<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->pageTitle = 'USUARIO: ' . $model->nombre_usuario;
?>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue">
                <header></header>
                <div>
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <fieldset>
                                    <legend>INFORMACION DE USUARIO</legend>
                                </fieldset>
                                <table class="table table-bordered ">
                                    <tr>
                                        <td>NOMBRE COMPLETO</td>
                                        <td><?php echo $model->persona->getNombreCompleto(); ?></td>
                                    </tr>
                                    <tr>
                                        <td>NOMBRE DE USUARIO</td>
                                        <td><?php echo $model->nombre_usuario; ?></td>
                                    </tr>
                                    <tr>
                                        <td>ESTADO</td>
                                        <td><?php echo ($model->estado_usuario) ? 'ACTIVO' : 'INACTIVO' ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-10 col-md-offset-1">
                                <div class="jarviswidget" id="widget1" data-widget-togglebutton="false"
                                     data-widget-deletebutton="false" data-widget-fullscreenbutton="false"
                                     data-widget-custombutton="false">
                                    <header>
                                        <h2><strong>LISTADO DE ROLES ASIGNADOS</strong></h2>
                                    </header>
                                    <div>
                                        <div class="widget-body no-padding">
                                            <div class="table-responsive">
                                                <table class="table table-condensed table-striped table-bordered "
                                                       width="100%;">
                                                    <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Descripcion</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach ($roles as $item): ?>
                                                        <tr>
                                                            <td><?php echo $item->name; ?></td>
                                                            <td><?php echo $item->description; ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
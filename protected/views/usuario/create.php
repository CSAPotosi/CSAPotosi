<?php
/* @var $this UsuarioController */

$this->pageTitle = "Agregar <span> > Usuario </span>";
$this->breadcrumbs = array(
    'Create',
);
?>


    <section id="widget-grid">
        <div class="row">
            <article class="col-md-12">
                <div class="jarviswidget" id="widget1">
                    <header></header>
                    <div>
                        <div class="widget-body">
                            <form class="smart-form"
                                  action="<?php echo CHtml::normalizeUrl(array("usuario/create")); ?>" method="POST">
                                <header>
                                    Formulario de Registro de Usuario
                                </header>
                                <fieldset>
                                    <section>
                                        <?php echo CHtml::activeHiddenField($usuario, 'id_usuario', array('id' => 'id-persona')); ?>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" placeholder="Nombre Completo" id="nombre-completo"
                                                   data-toggle="modal" data-target="#modal-personas">
                                            <b class="tooltip tooltip-bottom-right">Necesita un medico o un empleado
                                                para registrarlo como usuario</b>
                                        </label>
                                        <?php echo CHtml::error($usuario, 'id_usuario'); ?>
                                    </section>
                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-smile-o"></i>
                                            <?php echo CHtml::activeTextField($usuario, 'nombre_usuario', array('size' => 60, 'maxlength' => 32, 'class' => 'documento-usuario', 'placeholder' => 'Usuario')); ?>
                                            <b class="tooltip tooltip-bottom-right">El nombre de usuario por defecto es
                                                el documento de identificacion, puede cambiar este valor.</b>
                                        </label>
                                        <?php echo CHtml::error($usuario, 'nombre_usuario'); ?>
                                    </section>
                                    <section>
                                        <label class="input"> <i class="icon-append fa fa-eye"></i>
                                            <?php echo CHtml::activePasswordField($usuario, 'clave', array('size' => 60, 'maxlength' => 32, 'class' => 'documento-usuario', 'placeholder' => 'Contraseña')); ?>
                                            <b class="tooltip tooltip-bottom-right">La Contraseña por defecto es el
                                                documento de identificacion, puede cambiar este valor. Tambien puede ver
                                                el valor manteniendo presionado el icono del ojo </b>
                                        </label>
                                        <?php echo CHtml::error($usuario, 'clave'); ?>
                                    </section>

                                    <footer>
                                        <button type="submit" class="btn btn-primary">
                                            Guardar
                                        </button>
                                    </footer>
                            </form>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>

    <div id="modal-personas" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Listado de Medicos y Empleados</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12"><p>Haga click sobre un médico o empleado</p></div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input class="form-control" id="input-search-pacients" placeholder="Buscar..." type="text">
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="btn-group">
                            <button class="btn btn-lg dropdown-toggle btn-primary btn-xs" data-toggle="dropdown">
                                Médicos
                                <i class="fa fa-caret-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" id="pick-status-pacient">
                                <li class="active">
                                    <a href="javascript:void(0);" status="1">Médicos</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" status="0">Empleados</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Primer Apellido</th>
                                    <th>Segundo Apellido</th>
                                    <th>Numero de Documento</th>
                                    <th>Tipo de Documento</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($personaList as $item): ?>
                                    <tr class="table-row" data-id-persona="<?php echo $item->id_persona; ?>"
                                        data-dismiss="modal">
                                        <td><?php echo $item->nombres; ?></td>
                                        <td><?php echo $item->primer_apellido; ?></td>
                                        <td><?php echo $item->segundo_apellido; ?></td>
                                        <td><?php echo $item->num_doc; ?></td>
                                        <td><?php echo $item->tipo_doc; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/usuario/create.js', CClientScript::POS_END);
?>
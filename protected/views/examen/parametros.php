<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <a href="<?php echo CHtml::normalizeUrl(['examen/createParametro']);?>" class="btn btn-primary margin-bottom-5 pull-right">
                            <i class="fa fa-plus"></i> Agregar
                        </a>
                        <table class="table-striped table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th width="40%">Nombre</th>
                                <th width="20%">Extension</th>
                                <th width="30%">Tipo</th>
                                <th>

                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach (Parametro::model()->findAll() as $param):?>
                                <tr>
                                    <td><?php echo $param->nombre_par;?></td>
                                    <td><?php echo $param->ext_par;?></td>
                                    <td><?php echo Parametro::model()->getTipo()[$param->tipo_par];?></td>
                                    <td>
                                        <a href="<?php echo CHtml::normalizeUrl(['examen/editParametro','id_p'=>$param->id_par])?>" class="btn btn-xs btn-primary">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
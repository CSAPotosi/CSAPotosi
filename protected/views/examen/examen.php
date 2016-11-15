<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Condiciones</th>
                                <th>Categoria</th>
                                <th width="15%"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($examenList as $examen):?>
                                <tr>
                                    <td><?php echo $examen->datosServicio->nombre_serv;?></td>
                                    <td><?php echo $examen->condiciones;?></td>
                                    <td><?php echo $examen->categoria->nombre_cat_ex;?></td>
                                    <td>
                                        <a href="<?php echo CHtml::normalizeUrl(['examen/adminExamenParams','id_ex' => $examen->id_serv])?>" class="btn btn-primary btn-xs">
                                            <i class="fa fa-list"></i>
                                            Adm. parametros
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
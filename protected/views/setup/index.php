<?php $this->pageTitle = 'CONFIGURACION DEL SISTEMA'; ?>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>DESCRIPCION</th>
                                    <th>VALOR</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach(Setup::model()->findAll() as $setup):?>
                                    <tr>
                                        <td><?= $setup->descripcion_se?></td>
                                        <td><?= $setup->valor_se?:'<i>No especificado</i>'?></td>
                                        <td><a href="<?= CHtml::normalizeUrl(['setup/edit','id'=>$setup->clave_se])?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a></td>
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
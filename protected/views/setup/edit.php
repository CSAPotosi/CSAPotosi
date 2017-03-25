<?php $this->pageTitle = 'CONFIGURACION DEL SISTEMA'; ?>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <?= CHtml::beginForm('','post',['class'=>'form-horizontal'])?>
                            <div class="form-group">
                                <?= CHtml::label($setup->descripcion_se,'Setup_valor_se',['class'=>'col-md-6 contorl-label text-align-right'])?>
                                <div class="col-md-6">
                                    <?= CHtml::activeTextField($setup,'valor_se',['class'=>'form-control'])?>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i>
                                    Guardar
                                </button>
                            </div>
                        <?= CHtml::endForm()?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
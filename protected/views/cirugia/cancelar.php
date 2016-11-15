
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1" data-widget-refreshbutton="false">
                <header>
                </header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Cancelar programacion de cirugia</legend>
                            <div class="alert alert-info">
                                <strong>Atencion!!! </strong>
                                Esta a punto de cancelar la cirugia, si esta seguro de hacerlo presione el boton <strong>Cancelar cirugia programada</strong>.
                            </div>
                            <?php echo CHtml::beginForm();?>
                            <?php echo CHtml::activeHiddenField($cirugia,'id_cir');?>
                            <div class="form-group text-align-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-close"></i> Cancelar cirugia programada
                                </button>
                            </div>
                            <?php echo CHtml::endForm();?>
                        </fieldset>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
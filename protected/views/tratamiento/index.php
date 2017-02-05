<?php $this->renderPartial('/layouts/_cardProfile',['historialModel'=>$dModel->historial]);?>

<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <?php $this->renderPartial('_tableTratamiento',['tList'=>$dModel->tratamientos]);?>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
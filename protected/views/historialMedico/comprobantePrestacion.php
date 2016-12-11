<?php
/* @var $this PacienteController */
$this->pageTitle = "Horario <span> > Lista de Horarios </span>";
$this->breadcrumbs = array(
    'Horario',
);
?>
<?php $this->renderPartial('/layouts/_cardProfile', ['historialModel' => $prestacion->historial]); ?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        <fieldset>
                            <legend>Detalle de Prestacion</legend>
                            <div class="row">
                                <article class="col-md-8 col-lg-offset-2">
                                    <table cellpadding="20px">
                                        <?php
                                        $servicio = DetallePrestacion::model()->findAll(array(
                                            'condition' => "id_prestacion ='{$prestacion->id_prestacion}'",
                                        ));
                                        ?>
                                        <?php
                                        $listalaboratorio = array();
                                        $listagabinete = array();
                                        $listaotros = array();

                                        ?>
                                        <?php foreach ($servicio as $ser): ?>
                                            <?php $det = Servicio::model()->findByPk($ser->id_servicio); ?>
                                            <?php
                                            if ($det->servExamen != null) {
                                                if ($det->servExamen->categoria->tipo_ex == 1)
                                                    $listalaboratorio[] = $det->servExamen;
                                                elseif ($det->servExamen->categoria->tipo_ex == 2)
                                                    $listagabinete[] = $det->servExamen;
                                            }
                                            if ($det->servClinico != null) {
                                                $listaotros[] = $det->servClinico;
                                            }
                                            ?>
                                        <?php endforeach; ?>

                                        <tr>
                                            <td><h4>NOMBRE DEL SERVICIO</h4></td>
                                            <td align="center"><h4>PRECIO</h4></td>
                                            <td align="center"><h4>CANTIDAD</h4></td>
                                            <td align="center"><h4>TOTAL</h4></td>
                                        </tr>
                                        <?php if ($listalaboratorio != null) { ?>
                                            <?php
                                            $cat1 = 0;
                                            function cmp($a, $b)
                                            {
                                                if ($a == $b) {
                                                    return 0;
                                                }
                                                return ($a < $b) ? -1 : 1;
                                            }

                                            ?>
                                            <?php uasort($listalaboratorio, 'cmp'); ?>
                                            <tr>
                                                <td><h3><i><u>LABORATORIO</u></i></h3></td>
                                            </tr>
                                            <?php foreach ($listalaboratorio as $lab): ?>
                                                <?php
                                                $cat2 = $lab->id_cat_ex;
                                                if ($cat1 != $cat2) {
                                                    ?>
                                                    <tr>
                                                        <td><h4><u><?php echo $lab->categoria->nombre_cat_ex; ?></u>
                                                            </h4></td>
                                                    </tr>
                                                    <?php $cat1 = $cat2; ?>
                                                <?php } else {
                                                    ?>
                                                    <?php $cat1 = $cat2;
                                                } ?>
                                                <tr>
                                                    <td><?php echo $lab->datosServicio->nombre_serv ?></td>
                                                    <td align="center"><?php echo $lab->datosServicio->precio->monto ?></td>
                                                    <?php $cantidad = DetallePrestacion::model()->find(array(
                                                        'condition' => "id_prestacion='{$prestacion->id_prestacion}' and id_servicio='{$lab->datosServicio->id_serv}'",
                                                    )) ?>
                                                    <td align="center"><?php echo $cantidad->cantidad ?></td>
                                                    <td align="center"><?php echo ($cantidad->cantidad) * ($lab->datosServicio->precio->monto) ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php } ?>
                                        <?php if ($listagabinete != null) { ?>
                                            <?php
                                            $cat1 = 0;
                                            function cmt($a, $b)
                                            {
                                                if ($a == $b) {
                                                    return 0;
                                                }
                                                return ($a < $b) ? -1 : 1;
                                            }

                                            ?>
                                            <?php uasort($listagabinete, 'cmt'); ?>
                                            <tr>
                                                <td><h3><i><u>EXAMENES DE GABINETE O COMPLEMENTARIOS</u></i></h3></td>
                                            </tr>
                                            <?php foreach ($listagabinete as $gab): ?>
                                                <?php
                                                $cat2 = $gab->id_cat_ex;
                                                if ($cat1 != $cat2) {
                                                    ?>
                                                    <tr>
                                                        <td><h4><u><?php echo $gab->categoria->nombre_cat_ex; ?></u>
                                                            </h4></td>
                                                    </tr>
                                                    <?php $cat1 = $cat2; ?>
                                                <?php } else {
                                                    ?>
                                                    <?php $cat1 = $cat2;
                                                } ?>
                                                <tr>
                                                    <td><?php echo $gab->datosServicio->nombre_serv ?></td>
                                                    <td align="center"><?php echo $gab->datosServicio->precio->monto ?></td>
                                                    <?php $cantidad = DetallePrestacion::model()->find(array(
                                                        'condition' => "id_prestacion='{$prestacion->id_prestacion}' and id_servicio='{$gab->datosServicio->id_serv}'",
                                                    )) ?>
                                                    <td align="center"><?php echo $cantidad->cantidad ?></td>
                                                    <td align="center"><?php echo ($cantidad->cantidad) * ($gab->datosServicio->precio->monto) ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php } ?>
                                        <?php if ($listaotros != null) { ?>
                                            <?php
                                            $cat1 = 0;
                                            function cml($a, $b)
                                            {
                                                if ($a == $b) {
                                                    return 0;
                                                }
                                                return ($a < $b) ? -1 : 1;
                                            }

                                            ?>
                                            <?php uasort($listaotros, 'cml'); ?>
                                            <tr>
                                                <td><h3><i><u>ENFERMERIA Y OTROS SERVICIOS</u></i></h3></td>
                                            </tr>
                                            <?php foreach ($listaotros as $cli): ?>
                                                <?php
                                                $cat2 = $cli->id_cat_cli;
                                                if ($cat1 != $cat2) {
                                                    ?>
                                                    <tr>
                                                        <td><h4><u><?php echo $cli->categoria->nombre_cat_cli; ?></u>
                                                            </h4></td>
                                                    </tr>
                                                    <?php $cat1 = $cat2; ?>
                                                <?php } else {
                                                    ?>
                                                    <?php $cat1 = $cat2;
                                                } ?>
                                                <tr>
                                                    <td><?php echo $cli->datosServicio->nombre_serv ?></td>
                                                    <td align="center"><?php echo $cli->datosServicio->precio->monto ?></td>
                                                    <?php $cantidad = DetallePrestacion::model()->find(array(
                                                        'condition' => "id_prestacion='{$prestacion->id_prestacion}' and id_servicio='{$cli->datosServicio->id_serv}'",
                                                    )) ?>
                                                    <td align="center"><?php echo $cantidad->cantidad ?></td>
                                                    <td align="center"><?php echo ($cantidad->cantidad) * ($cli->datosServicio->precio->monto) ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php } ?>

                                    </table>
                                </article>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!--Start Scripts-->
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/resources/js/system/servicio/index.js', CClientScript::POS_END); ?>
<script>

</script>

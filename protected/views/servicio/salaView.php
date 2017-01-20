<?php
    $this->pageTitle = 'Grupos de salas';//'Detalle de '.$tSala->servicio->nombre_serv;
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-md-12">
            <div class="jarviswidget jarviswidget-color-blue" id="widget1">
                <header></header>
                <div>
                    <div class="widget-body">
                        
                            <legend>Detalle de grupo</legend>
                            <table class="table table-bordered table-hovered" id="t-sala-detail" data-activo="<?php echo $tSala->servicio->activo;?>" >
                                <tr>
                                    <th style="text-align: right" width="20%">CODIGO</th>
                                    <td><?php echo CHtml::encode($tSala->servicio->cod_serv);?></td>
                                </tr>
                                <tr>
                                    <th style="text-align: right" width="20%">NOMBRE DE GRUPO</th>
                                    <td><?php echo CHtml::encode($tSala->servicio->nombre_serv);?></td>
                                </tr>
                                <tr>
                                    <th style="text-align: right" width="20%">PRECIO</th>
                                    <td><strong>Bs. </strong><?php echo CHtml::encode($tSala->servicio->precio->monto);?></td>
                                </tr>
                                <tr>
                                    <th style="text-align: right" width="20%">DESCRIPCION</th>
                                    <td><?php echo CHtml::encode($tSala->descripcion_t_sala);?></td>
                                </tr>
                                <tr>
                                    <th style="text-align: right" width="20%">DESCRIPCION</th>
                                    <td>
                                        <?php
                                        if($tSala->servicio->tipo_cobro == 2)
                                            echo '<span class="label label-info">INTERNACION</span>';
                                        else
                                            echo '<span class="label label-info">QUIROFANO</span>';
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="text-align: right" width="20%">ESTADO</th>
                                    <td>
                                        <?php
                                            if($tSala->servicio->activo)
                                                echo "<span class='label label-primary'>ACTIVO</span>";
                                            else
                                                echo "<span class='label label-danger'>INACTIVO</span>";
                                        ?>
                                    </td>
                                </tr>
                            </table>

                            <legend>Salas disponibles</legend>
                            <div class="row">
                                <div class="col-md-12 new-sala margin-top-10 margin-bottom-10">
                                    <div class="row item-sala-new-form">
                                        <div class="col-md-12 text-right">
                                            <div class="btn btn-primary btn-sm btn-new-item-sala"><i class="fa fa-plus"></i> Agregar</div>
                                        </div>
                                    </div>
                                    <div class="well well-sm item-sala-new-form hidden">
                                        <div class="row">
                                            <?php
                                            $form = $this->beginWidget('CActiveForm',[
                                                'action'=>['servicio/salaAddItem','id'=>$tSala->id_serv],
                                                'enableAjaxValidation'=>true,
                                                'clientOptions'=>[
                                                    'validateOnSubmit'=>true,
                                                    'validateOnChange'=>false
                                                ]
                                            ]);
                                            ?>
                                            <div class="col-md-2">
                                                <?php echo $form->textField($itemSalaModel,'cod_sala',['class'=>'form-control','placeholder'=>'CODIGO']);?>
                                                <?php echo $form->error($itemSalaModel,'cod_sala',['class'=>'label label-danger']);?>
                                            </div>
                                            <div class="col-md-6">
                                                <?php echo $form->textField($itemSalaModel,'ubicacion_sala',['class'=>'form-control','placeholder'=>'UBICACION']);?>
                                                <?php echo $form->error($itemSalaModel,'ubicacion_sala',['class'=>'label label-danger']);?>
                                            </div>
                                            <div class="col-md-1">
                                            <span class="onoffswitch">
                                                <?php echo $form->checkBox($itemSalaModel,'estado_sala',['class'=>'onoffswitch-checkbox']);?>
                                                <?php echo $form->label($itemSalaModel,'estado_sala',['class'=>'onoffswitch-label','label'=>'<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span><span class="onoffswitch-switch"></span>']);?>
                                            </span>
                                            </div>
                                            <div class="col-md-3 text-align-right">
                                                <button class="btn btn-sm btn-primary btn-submit-item-sala" type="submit">
                                                    <i class="fa fa-save"></i>
                                                    Guardar
                                                </button>
                                                <button class="btn btn-sm btn-danger btn-cancel-item-sala" type="reset">
                                                    <i class="fa fa-close"></i>
                                                    Cancelar
                                                </button>
                                            </div>
                                            <?php $this->endWidget(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <strong>CODIGO</strong>
                                                </div>
                                                <div class="col-md-6">
                                                    <strong>UBICACION</strong>
                                                </div>
                                                <div class="col-md-1">
                                                    <strong>ACTIVO</strong>
                                                </div>
                                                <div class="col-md-3">
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="list-group no-margin">
                                            <?php foreach ($tSala->salas as $itemSala): ?>
                                                <li class="list-group-item">
                                                    <div class="row item-sala-detail">
                                                        <div class="col-md-2">
                                                            <?php echo $itemSala->cod_sala; ?>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <?php echo $itemSala->ubicacion_sala; ?>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <?php if($itemSala->estado_sala < 2):?>
                                                                <span class="onoffswitch">
                                                            <input type="checkbox" name="nuevo" class="onoffswitch-checkbox update-state-item-sala" id="check<?php echo $itemSala->id_sala;?>" <?php echo ($itemSala->estado_sala==1)?'checked':''; ?>>
                                                            <label class="onoffswitch-label" for="check<?php echo $itemSala->id_sala;?>">
                                                                <span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span>
                                                                <span class="onoffswitch-switch"></span>
                                                            </label>
                                                        </span>
                                                            <?php else:?>
                                                                <?php if($itemSala->estado_sala == 2):?>
                                                                    <span class="label label-info">OCUPADO</span>
                                                                <?php else:?>
                                                                    <span class="label label-info">MANTENIMIENTO</span>
                                                                <?php endif;?>
                                                            <?php endif;?>
                                                        </div>
                                                        <div class="col-md-3 text-align-right">
                                                            <?php if($itemSala->estado_sala < 2):?>
                                                                <button type="button" class="btn btn-primary btn-xs btn-edit-item-sala">
                                                                    <i class="fa fa-edit"></i>
                                                                    Editar
                                                                </button>
                                                            <?php endif;?>
                                                        </div>
                                                    </div>
                                                    <div class="row hidden item-sala-form">
                                                        <?php
                                                        $form = $this->beginWidget('CActiveForm',[
                                                            'action'=>['servicio/salaEditItem','id'=>$itemSala->id_sala],
                                                            'enableAjaxValidation'=>true,
                                                            'clientOptions'=>[
                                                                'validateOnSubmit'=>true,
                                                                'validateOnChange'=>false
                                                            ]
                                                        ]);
                                                        ?>
                                                        <div class="col-md-2">
                                                            <?php echo $form->textField($itemSala,'cod_sala',['class'=>'form-control']);?>
                                                            <?php echo $form->error($itemSala,'cod_sala',['class'=>'label label-danger']);?>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <?php echo $form->textField($itemSala,'ubicacion_sala',['class'=>'form-control']);?>
                                                            <?php echo $form->error($itemSala,'ubicacion_sala',['class'=>'label label-danger']);?>
                                                        </div>
                                                        <div class="col-md-1">
													<span class="onoffswitch">
														<?php echo $form->checkBox($itemSala,'estado_sala',['class'=>'onoffswitch-checkbox', 'id'=>'activo_'.$itemSala->id_sala]);?>
                                                        <?php echo $form->label($itemSala,'estado_sala',['for'=>'activo_'.$itemSala->id_sala ,'class'=>'onoffswitch-label','label'=>'<span class="onoffswitch-inner" data-swchon-text="SI" data-swchoff-text="NO"></span><span class="onoffswitch-switch"></span>']);?>
													</span>
                                                        </div>
                                                        <div class="col-md-3 text-align-right">
                                                            <button class="btn btn-xs btn-primary btn-submit-item-sala" type="submit">
                                                                <i class="fa fa-save"></i>
                                                                Guardar
                                                            </button>
                                                            <button class="btn btn-xs btn-danger btn-cancel-item-sala" type="reset">
                                                                <i class="fa fa-close"></i>
                                                                Cancelar
                                                            </button>
                                                        </div>
                                                        <?php $this->endWidget(); ?>
                                                    </div>
                                                </li>
                                            <?php endforeach;?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/resources/js/system/servicio/salaView.js',CClientScript::POS_END);
?>
<!--todo-pacf: Agregar mas info-->
<?php
    $tipo = ['NORMAL','INTERNACION'];
?>
<style>
    .alt-text{
        border-bottom: dotted 1.5px #3276b1;
    }
    .sh-item{
        cursor: pointer;
    }
</style>
<?php if($dList):?>

    <table class="table table-bordered table-hover table-condensed">
        <thead>
        <tr>
            <th width="15%">FECHA Y HORA</th>
            <th width="40%">CONCLUSION</th>
            <th width="10%">TIPO</th>
            <th width="10%"></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dList as $dItem):?>
            <tr>
                <td><?php echo date('d/m/Y H:i',strtotime($dItem->fecha_diag));?></td>
                <td>
                    <span class="sh-item text-primary alt-text"><i> <i class="fa fa-eye"></i> </i></span>
                    <span class="sh-item main-text hide"><?php echo $dItem->conclusion;?></span>
                </td>
                <td><span class="label label-primary"><?php echo $tipo[$dItem->tipo];?></span></td>
                <td><?php echo CHtml::link('Ver',['diagnostico/view','d_id'=>$dItem->id_diag],['class'=>'btn btn-primary btn-xs']);?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
<?php else:?>
    <h4 class="alert alert-info">No se han encontrado resultados</h4>
<?php endif;?>

<?php
    Yii::app()->clientScript->
        registerScript('adicionales','
            $(".alt-text").on("mouseenter mouseleave",function(){
                $(this).closest("td").children("span.main-text").toggleClass("hide");
            });
        ');
?>
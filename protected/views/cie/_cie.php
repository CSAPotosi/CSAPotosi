<form class="smart-form">
    <section>
        <?php echo CHtml::label('CAPITULO','cie-cap-select',['class'=>'label']);?>
        <label class="select">
            <?php echo CHtml::dropDownList('cie-cap-select',null,CHtml::listData(CapituloCie::model()->findAll(),'num_cap','titulo_cap'),['data-url'=>CHtml::normalizeUrl(['cie/getCategoryAjax'])]); ?>
            <i></i>
        </label>
    </section>

    <section>
        <?php echo CHtml::label('CATEGORIA','cie-cat-select',['class'=>'label']);?>
        <label class="select">
            <?php echo CHtml::dropDownList('cie-cat-select',null,[],['data-url'=>CHtml::normalizeUrl(['cie/getGroupAjax'])]); ?>
            <i></i>
        </label>
    </section>

    <section>
        <?php echo CHtml::label('GRUPO','cie-group-select',['class'=>'label']);?>
        <label class="select">
            <?php echo CHtml::dropDownList('cie-group-select',null,[],['data-url'=>CHtml::normalizeUrl(['cie/getItemAjax'])]); ?>
            <i></i>
        </label>
    </section>
</form>

<label for="item-cie-table">ITEM</label>
<div class="table-responsive" id="cie-item-table">
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <td colspan="3">
                <div class="form-group has-feedback no-margin">
                    <input type="text" class="form-control" placeholder="Escriba Codigo, titulo o descripcion para buscar" id="search-item">
                    <span class="glyphicon glyphicon-search form-control-feedback" aria-hidden="true"></span>
                </div>
            </td>
        </tr>
        <tr>
            <th width="10%">Codigo</th>
            <th width="80%">Titulo</th>
            <th width="10%"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</div>
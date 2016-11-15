$("#modal-params").on('show.bs.modal',function () {
    $("#btn-select-param").prop("disabled",true);
    var url = $(this).data("url");
    $(this).find(".well").addClass("hide");
    $(this).find(".well").load(url,function () {
        $("#modal-params").find(".well").removeClass("hide");
        $("#table-selected-params tbody").find("tr").each(function(){
            var id = $(this).data("id");
            $("#params-table").find("tbody tr[data-id="+id+"]").remove();
        });

        $("#params-table tbody tr").off().on("click",rowClickEventHandler);
    });
});

function rowClickEventHandler(){
    $(this).toggleClass("selected-param");
    if($("#modal-params").find(".selected-param").length == 0)
        $("#btn-select-param").prop("disabled",true);
    else
        $("#btn-select-param").removeAttr("disabled");
}

$("#btn-select-param").on("click",function(){
    $(".selected-param").each(function(){
        var id = $(this).data("id");
        var nombre = $(this).data("nombre");
        var ext = $(this).data("ext");
        var $row = $('<tr data-id="'+id+'">'
                +'<td></td>'
                +'<td>'+nombre+'</td>'
                +'<td>'
                    +ext
                    +'<input type="hidden" name="ExamenParametro[][id_par]" value="'+id+'">'
                    +'<input type="hidden" name="ExamenParametro[][orden]" value="0">'
                +'</td>'
                +'</tr>');
        $("#table-selected-params tbody").append($row);
        $("#table-selected-params tbody tr").off().on("click",function () {
            $("#table-selected-params tbody tr").removeClass("selected-param");
            $(this).addClass("selected-param");
        });
        $("#modal-params").modal("hide");
    });
    renameRows();
});

$("#table-selected-params tbody tr").on("click",function () {
    $("#table-selected-params tbody tr").removeClass("selected-param");
    $(this).addClass("selected-param");
});

$("#btn-remove-row").on("click",function(){
    $("#table-selected-params tbody").find("tr.selected-param").remove();
    renameRows();
});

$("#btn-up-row").on("click",function(){
    var $currentRow = $("#table-selected-params tbody tr.selected-param").eq(0);
    var $prevRow = $currentRow.prev();
    if($prevRow){
        $currentRow.insertBefore($prevRow);
        renameRows();
    }
});

$("#btn-down-row").on("click",function(){
    var $currentRow = $("#table-selected-params tbody tr.selected-param").eq(0);
    var $nextRow = $currentRow.next();
    if($nextRow){
        $currentRow.insertAfter($nextRow);
        renameRows();
    }
});

function renameRows(){
    $("#table-selected-params tbody").find("tr").each(function(index){
        var ind = index+1;
        $(this).find("td").eq(0).text(ind);
        $(this).find("input[type=hidden][ name $= '[id_par]' ]").attr("name","ExamenParametro["+ind+"][id_par]");
        $(this).find("input[type=hidden][ name $= '[orden]' ]").val(ind).attr("name","ExamenParametro["+ind+"][orden]");
    });
}
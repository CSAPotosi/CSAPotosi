var timeout=undefined;
var code="";
var query="";

$("#modal-cie").on("show.bs.modal",getCie);

function getCie(){
    var url = $(this).data('url');
    $(this).find(".modal-body").eq(0).children(".well").eq(0).load(url,loadFunctionsModalCie);
}

function loadFunctionsModalCie(){
    $("#cie-cap-select").off().on('change',function(){
        $("#cie-cat-select").load($(this).attr("data-url"),{code:$(this).val()});
    });

    $("#cie-cat-select").off().on('change',function(){
        $("#cie-group-select").load($(this).attr("data-url"),{code:$(this).val()});
    });

    $("#cie-group-select").off().on('change',function(){
        code = $("#cie-group-select").val();
        query = "";
        loadItems();
    });

    $("#search-item").keyup(function(e){
        if((e.keyCode>=32&&e.keyCode<=126)||e.keyCode==13||e.keyCode==8){
            if(timeout!=undefined)
                clearTimeout(timeout);
            timeout=setTimeout(function () {
                code = "";
                query = $("#search-item").val();
                if(query.length>=3||query.length==0)
                    loadItems();
            },1000);
        }
    });
}

function loadItems(){
    $("#cie-item-table tbody").load($("#cie-group-select").attr("data-url"),{code:code,query:query,detail:false},loadRowFunctions);
}

function loadRowFunctions() {
    $(".btn-select-item").off().on("click",function(){
        var $fila = $(this).closest("tr");
        var code = $fila.find("td").first().text();

        if($("#table-consulta-cie tbody").find("input[value='"+code+"']").length == 0){
            var $btnR = $("<button type='button' class='btn btn-xs btn-primary btn-remove-item'><i class='fa fa-remove'></i> Quitar</button>");
            var $input = $("<input type='hidden' name='DiagnosticoCie[][codigo]'>").val(code);
            $fila.find("button").closest("td").html($btnR).append($input);
            $("#table-consulta-cie tbody tr th").closest("tr").remove();
            $("#table-consulta-cie tbody").append($fila);
        }
        return false;
    });
}

$(".btn-remove-item").on('click',function(){
    $(this).closest("tr").remove();
    if( $("#table-consulta-cie tbody tr").length == 0 ){
        $("#table-consulta-cie tbody").append($("<tr><th colspan='3' class='row-unique'>No se ha especificado ningun item CIE10.</th></tr>"));
    }
    return false;
});
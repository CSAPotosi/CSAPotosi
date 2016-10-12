var timeout=undefined;
var code="";
var query="";

$("#cie-cap-select").on('change',function(){
    $("#cie-cat-select").load($(this).attr("data-url"),{code:$(this).val()});
});

$("#cie-cat-select").on('change',function(){
    $("#cie-group-select").load($(this).attr("data-url"),{code:$(this).val()});
});

$("#cie-group-select").on('change',function(){
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

function loadItems(){
    $("#cie-item-table tbody").load($("#cie-group-select").attr("data-url"),{code:code,query:query,detail:true},function(){
        loadRowFunctions();
    });
}

function loadRowFunctions() {
    $(".btn-item-detail").off().on("click",function(){
        $("#modal-detail-cie .modal-title").html($(this).attr("data-code"));
        $.ajax({
            url:$(this).attr("data-url"),
            data:{code:$(this).attr("data-code")},
            method:"post",
            success:function(info){
                $("#modal-detail-cie .modal-body").html(info);
            },
            complete:function () {
                $("#CIEdescripcion").editable({
                    mode:'inline',
                    emptytext:'No especificado',
                    placeholder:'Escriba una descripcion'
                });
                $("#modal-detail-cie").modal('show');
            }
        });
        return false;
    });
}
$("#btn-add-item").on('click',function(){
    var $item = $("#templates #item-receta tr").clone(true);
    $(".table-receta tbody").append($item);
    renameInputItems();
});

$('.btn-remove-item').on('click',function () {
    $(this).closest('tr').remove();
    renameInputItems();
});

function renameInputItems(){
    $(".table-receta tbody tr").each(function(i,item){
        $(item).find("input[name ^= 'Receta['][name $= '][codigo_med]' ]").attr('name', 'Receta['+i+'][codigo_med]').removeAttr("id");
        $(item).find("input[name ^= 'Receta['][name $= '][cant_solicitada]' ]").attr('name', 'Receta['+i+'][cant_solicitada]').removeAttr("id");
        $(item).find("select[name ^= 'Receta['][name $= '][via]' ]").attr('name', 'Receta['+i+'][via]').removeAttr("id");
        $(item).find("textarea[name ^= 'Receta['][name $= '][pauta]' ]").attr('name', 'Receta['+i+'][pauta]').removeAttr("id");
    });
}

$("#modal-receta")
    .on('show.bs.modal',loadMediData)
    .on('hidden.bs.modal',function () {
        $(".select-med").removeClass('selected');
    });

$("#input-search-medi").keyup(loadMediData);

$(".select-med").on('click',function () {
    $(".select-med").removeClass('selected');
    $(this).addClass('selected');
});
function loadMediData(){
    var url = $("#modal-receta").data('url');
    var param = $("#input-search-medi").val();
    if(param.length >= 3 || param.length == 0)
        $("#modal-receta").find('.well').load(url,{param: param},function () {
            $(".btn-item-select").off().on("click",function(){
                var row = $(this).closest('tr');
                var code = row.find("td").eq(0).text();
                var title = row.find("td span.text-normal").eq(0).text();
                if($("input[name $= '[codigo_med]'][value = '"+code+"']").length == 0){
                    $(".select-med.selected").text(title);
                    $(".select-med.selected").closest("td").find("input").val(code);
                    $("#modal-receta").modal("hide");
                }
            });
        });
}
$('[data-toggle="tooltip"]').tooltip();

$("#tab-hr1").on('click',function(){
    $("#examenTipoList").removeClass('hidden');
});

$("#tab-hr2").on('click',function(){
    $("#examenTipoList").addClass('hidden');
});

$("#search-servicio").keyup(searchItem);
$("#examenTipoList").on("change",searchItem);

function searchItem(){
    var value = $("#search-servicio").val();//.toUpperCase();
    var type = $("#examenTipoList").val();

    $("fieldset.categoria").addClass("hidden");
    if(type == 0)
        $("fieldset.categoria").removeClass("hidden");
    else
        $("fieldset.categoria[data-tipo = "+ type +"]").removeClass("hidden");
    $(".service").addClass("hidden");
    $(".service:contains("+ value +")").removeClass("hidden");
}
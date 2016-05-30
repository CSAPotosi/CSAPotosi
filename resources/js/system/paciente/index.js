var timeout=undefined;

$(document).ready(function () {
    getPacientListAjax();
});

function preLoad(){
    $("#btn-load-pacients").attr("disabled",true)
        .html("<i class='fa fa-refresh fa-spin'></i> Cargando...");
}

function postLoad() {
    $("#btn-load-pacients").attr("disabled",false).html("Ver mas");
}

function error(){
    alert("Ha ocurrido un error al momento de solicitar datos, por favor vuelva a intentar...");
}

function getPacientListAjax(){
    var pageAttr =$("#btn-load-pacients").attr("page");
    var queryAttr =$("#input-search-pacients").val();
    var statusAttr =$("#pick-status-pacient>li.active>a").attr("status");
    $.ajax({
        url:$("#btn-load-pacients").attr("url"),
        data:{page:pageAttr, query:queryAttr, status:statusAttr },
        method:'post',
        success:function(info){
            var count_items = $("<div>"+info+"</div>").find(".col-md-4").length;

            $("#pacient-list").append(info);
            $("#btn-load-pacients").attr("page",1+parseInt( $("#btn-load-pacients").attr("page") ) );

            if( count_items < $("#btn-load-pacients").attr("limit") )
                $("#btn-load-pacients").hide();

        },
        beforeSend:preLoad,
        complete:postLoad,
        error:error
    });
}

function newAjaxRequest(){
    $("#pacient-list>.col-md-4").remove();
    $("#btn-load-pacients").attr("page","0").show();
    getPacientListAjax();
}


//disparadores
$("#btn-load-pacients").on("click",function () {
    getPacientListAjax();
});

$("#input-search-pacients").on("keyup",function (e) {
    if((e.keyCode>=32&&e.keyCode<=126)||e.keyCode==13||e.keyCode==8){
        if(timeout!=undefined)
            clearTimeout(timeout);
        timeout=setTimeout(function () {
            newAjaxRequest();
        },1000);
    }
});

$("#pick-status-pacient a").on("click",function () {
    var selText = $(this).text();
    var $this = $(this);
    $this.parents('.btn-group').find('.dropdown-toggle').html(selText + ' <span class="caret"></span>');
    $this.parents('.dropdown-menu').find('li').removeClass('active');
    $this.parent().addClass('active');
    newAjaxRequest();
});
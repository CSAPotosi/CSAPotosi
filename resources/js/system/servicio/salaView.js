$(document).ready(function () {
    var flag = $("#t-sala-detail").attr("data-activo");
    if(flag!=1){
        $.smallBox({
            title : "Este servicio esta inactivo",
            content : "Para activarlo regrese al menu anterior",
            color : "#a90329",
            iconSmall : "fa fa-warning bounce animated",
        });
    }
});
$(".list-group-item .btn-edit-item-sala, .list-group-item .btn-cancel-item-sala").on("click",function(){
    var $parent = $(this).parents('.list-group-item').eq(0);
    $parent.find('.item-sala-form').toggleClass('hidden');
    $parent.find('.item-sala-detail').toggleClass('hidden');
});

$(".item-sala-new-form .btn-cancel-item-sala, .item-sala-new-form .btn-new-item-sala").on("click",function () {
    var $parent = $(this).parents('.new-sala').eq(0);
    $parent.find('.item-sala-new-form').toggleClass('hidden');
});

$(".update-state-item-sala").click(function () {
    var $form = $(this).parents(".list-group-item").eq(0).find('form');
    $form.find(':checkbox').each(function () {
        var flag = $(this).prop('checked');
        $(this).prop('checked',!flag);
    });
    $form.submit();
});

$(".list-group-item .btn-edit-category, .list-group-item .btn-cancel-category").on("click",function () {
    var $parent = $(this).parents('.list-group-item').eq(0);
    $parent.find('.category-form').toggleClass('hidden');
    $parent.find('.category-detail').toggleClass('hidden');
});


$(".category-new-form .btn-cancel-category, .category-new-form .btn-new-category").on("click",function () {
    var $parent = $(this).parents('.widget-body-toolbar').eq(0);
    $parent.find('.category-new-form').toggleClass('hidden');
});

$(".onoffswitch-checkbox").click(function () {
    //alert($(this).prop("checked"));
});
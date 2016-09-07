/*var accordionIcons = {
 header: "fa fa-plus",    // custom icon class
 activeHeader: "fa fa-minus" // custom icon class
 };

 $("#accordion").accordion({
 autoHeight : false,
 heightStyle : "content",
 collapsible : true,
 animate : 300,
 icons: accordionIcons,
 header : "h4",
 })

 $("#searchMedico").on("keyup", filtro);
 function filtro() {
 var texto = $(this).val();
 if (texto.length > 0) {
 $(".val").addClass("hide");
 $(".val[data-nombre*='" + texto + "']").removeClass("hide");
 $(".val[data-nombre*='" + texto + "']").addClass("valor");
 var valor1=$(".valor");
 var item1,item2=0;
 valor1.each(function () {
 item1=$(this).attr('data-content');
 if(item1!=item2){
 $(".ui-accordion-content").filter("[data-content='" + item1 + "']").show();
 item2=item1;
 }
 else item2=item1;
 })
 }
 else{
 $(".val").removeClass("hide");
 var valor1=$(".valor");
 var item1,item2=0;
 valor1.each(function () {
 item1=$(this).attr('data-content');
 if(item1!=item2){

 $(".ui-accordion-content").filter("[data-content='" + item1 + "']").hide();
 item2=item1;
 }
 else item2=item1;
 item1=$(this).removeClass("valor");
 })
 }*/
$(document).ready(function () {

    pageSetUp();
    /*$('#nestable-menu').on('click', function(e) {
     var target = $(e.target), action = target.data('action');
     if (action === 'expand-all') {
     $('.dd').nestable('expandAll');
     }
     if (action === 'collapse-all') {
     $('.dd').nestable('collapseAll');
     }
     });*/
    $('#nestable3').nestable();
    $('.val').nestable('collapseAll');
    $("#searchMedico").on("keyup", filtro);
    function filtro() {
        var texto = $(this).val();
        if (texto.length > 0) {
            $(".val").addClass("hide");
            $(".val[data-nombre*='" + texto + "']").removeClass("hide");
            $(".val[data-nombre*='" + texto + "']").addClass("valor");
            var valor1 = $(".valor");
            var item1, item2 = 0;
            valor1.each(function () {
                item1 = $(this).attr('data-content');
                if (item1 != item2) {
                    $(".ui-accordion-content").filter("[data-content='" + item1 + "']").show();
                    item2 = item1;
                }
                else item2 = item1;
            })
        }
        else {
            $(".val").removeClass("hide");
            var valor1 = $(".valor");
            var item1, item2 = 0;
            valor1.each(function () {
                item1 = $(this).attr('data-content');
                if (item1 != item2) {

                    $(".ui-accordion-content").filter("[data-content='" + item1 + "']").hide();
                    item2 = item1;
                }
                else item2 = item1;
                item1 = $(this).removeClass("valor");
            })
        }
    }
})

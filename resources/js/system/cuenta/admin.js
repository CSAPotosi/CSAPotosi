$("#plan-contable").treetable({ expandable: true, initialState:"expanded", indent: 0 });
// Highlight selected row
$("#plan-contable tbody").on("mousedown", "tr", function() {
    $(".selected").not(this).removeClass("selected");
    //$(this).toggleClass("selected");
});

$(".branch a.borrado").addClass("hidden");

$(".btn-delete").on("click",function(e){
	if(!confirm("¿Esta seguro de eliminar el asiento?"))
		e.preventDefault();
});
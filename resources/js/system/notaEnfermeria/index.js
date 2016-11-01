$("#show-form, #hide-form").on("click",toogleHide);

function toogleHide(){
    $("#new-nota").toggleClass("hidden");
    $("#add-nota").toggleClass("hidden");
}
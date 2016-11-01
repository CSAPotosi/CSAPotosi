$('.btn-view-trat').on('click',function () {
    var url = $(this).data('url');
    $("#modal-tratamiento").find(".well").load(url);
    $("#modal-tratamiento").modal("show");
});
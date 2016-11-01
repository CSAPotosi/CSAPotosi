$(function () {
    $('input[name="daterange"]').daterangepicker({
        format: "DD/MM/YYYY"
    });
    $("#btn-report").on("click", function () {
        $("#form-report").submit();
    })
});


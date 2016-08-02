$(document).ready(function () {
    pageSetUp();
    $(".btnChangeState").on("change", function () {
        $.ajax({
            url: $(this).attr("data-url"),
            type: "get"
        });
    });
});

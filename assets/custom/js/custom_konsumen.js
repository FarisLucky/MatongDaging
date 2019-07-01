$(document).ready(function () {
    $(".overlay").remove();
    $("#tbl_konsumen,#follow_up_konsumen").DataTable({
        'responsive':true
    }); 
    $("#input_calon_konsumen").on("click",function (e) { 
        e.preventDefault();
        $("#modal_follow_konsumen").modal("show");
    });
});
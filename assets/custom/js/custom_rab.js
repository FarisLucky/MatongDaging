
function swallQuestion(titles, texts, types, confirm, success) {
    Swal({
        title: titles,
        text: texts,
        type: types,
        showCancelButton: true,
        confirmButtonColor: '#00ce68',
        cancelButtonColor: '#e65251',
        confirmButtonText: confirm
    }).then((result) => {
        if (result.value) {
            if (typeof success == 'function') {
                success();
            };
        }
    })
}
function swallSuccess(titles, texts, types, success) {
    Swal({
        title: titles,
        text: texts,
        type: types
    }).then((result) => {
        if (result.value) {
            if (typeof success == 'function') {
                success();
            };
        }
    })
}
$(document).ready(function () {
    const base = $('body').attr('data-base'); 
    $("#tbl_rab_properti,#tbl_rab_unit").DataTable({
        "responsive":true
    });
    $("table#tbl_rab_properti").on("click","#rm_detail", function (e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        swallQuestion("Yakin ?", "Apakah ingin di Hapus ?", "question", 'Hapus', function () {
            $.ajax({
                type: "post",
                url: base+"rab/hapus/"+id,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if (response.success == true) {   
                        swallSuccess("Berhasil", "Data Disimpan", "success", function () {
                            location.reload();
                        })
                    }
                }
            });
        })
    });
    $("table#tbl_rab_unit").on("click","#detail_hapus", function (e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        swallQuestion("Yakin ?", "Apakah ingin di Hapus ?", "question", 'Hapus', function () {
            $.ajax({
                type: "post",
                url: base+"rab/hapusunit/"+id,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if (response.success == true) {   
                        swallSuccess("Berhasil", "Data Disimpan", "success", function () {
                            location.reload();
                        });
                    }
                }
            });
        })
    });
    $("#tambah_rab").on("click",function(e) {
        e.preventDefault();
        let href = $(this).attr("href");
        let id = $(this).attr("data-id");
        $("#kembali").attr("href",base+id);
        location.href= href;
    })
});
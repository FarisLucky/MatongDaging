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

$(document).ready(function () {
    $(".overlay").remove();
    const js = $("#tbl_pemasukan").DataTable({
        responsive:true
    })

    $("table#tbl_pemasukan").on("click",".btn-hapus", function (e) {
        e.preventDefault();
        let params = $(this).attr("data-id");
        swallQuestion("Konfirmasi ?", "Ingin di Konfirmasi ?", "question", 'Konfirm', function () {
            $.ajax({
                type: "get",
                url: "pemasukan/hapus",
                data: {
                    params
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.success == true) {
                        swallSuccess("Sukses", "data berhasil dihapus", "success", function () {
                            location.reload();
                        })
                    }
                }
            });
        });
    });
    
    $("table#tbl_item").on("click",".btn-aktif", function (e) {
        e.preventDefault();
        let params = $(this).attr("data-id");
        swallQuestion("Aktifkan ?", "Ingin di Aktifkan ?", "question", 'confirm', function () {
            $.ajax({
                type: "post",
                url: "item/status",
                data: {
                    params
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.success == true) {
                        swallSuccess("Sukses", "Berhasil ditambahkan", "success", function () {
                            location.reload();
                        })
                    }
                }
            });
        });
    });
    $("table#tbl_item").on("click",".btn-nonaktif", function (e) {
        e.preventDefault();
        let params1 = $(this).attr("data-id");
        swallQuestion("Nonaktifkan ?", "Ingin di Nonaktifkan ?", "question", 'confirm', function () {
            $.ajax({
                type: "post",
                url: "item/status",
                data: {
                    params1
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.success == true) {
                        swallSuccess("Sukses", "Berhasil ditambahkan", "success", function () {
                            location.reload();
                        })
                    }
                }
            });
        });
    });
});
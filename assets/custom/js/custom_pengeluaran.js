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
    const js = $("#tbl_pengeluaran,#tbl_item").DataTable({
        responsive:true
    })

    $("table#tbl_pengeluaran").on("click",".btn-hapus", function (e) {
        e.preventDefault();
        let params = $(this).attr("data-id");
        Swal({
            title: "Hapus ?",
            text: "Apakah ingin dihapus ?",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: '#a55eea',
            cancelButtonColor: '#fed330',
            confirmButtonText: 'Hapus !'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "get",
                    url: "pengeluaran/hapus",
                    data: {
                        params
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if (response.success == true) {
                            swallSuccess(response.title, response.text, response.type, function () {
                                location.reload();
                            })
                        }
                    }
                });
            }
        })
    });
});
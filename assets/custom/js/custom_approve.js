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
    const approve = $("#tbl_approve_pembayaran,#tbl_approve_transaksi,#tbl_app_detail").DataTable({
        "responsive":true
    }); 
    $("table#tbl_approve_pembayaran").on("click",".btn-detail",function (e) { 
        e.preventDefault();
        let id = $(this).attr('data-id');
        $.ajax({
            type: "post",
            url: "data_approve",
            data: {id_approve:id},
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                if ((response.success == true) && (response.approve)) {
                    $("input[name='properti']").val(response.approve.nama_properti);
                    $("input[name='unit']").val(response.approve.nama_unit);
                    $("input[name='tgl_tempo']").val(response.approve.tgl_jatuh_tempo);
                    $("input[name='tgl_bayar']").val(response.approve.tgl_bayar);
                    $("input[name='tagihan']").val(response.approve.total_tagihan);
                    $("input[name='bayar']").val(response.approve.jumlah_bayar);
                    $("input[name='hutang']").val(response.approve.hutang);
                    $(".gambar_bukti").attr('src',response.image);
                }
                $('#modal_approve_pembayaran').modal('show');
            }
        });
    });
    $('table#tbl_approve_pembayaran').on('click','.btn-confirm',function (e) { 
        e.preventDefault();
        let id = $(this).attr('data-id');
        swallQuestion("Konfirmasi ?", "Ingin di Konfirmasi ?", "question", 'confirm', function () {
            console.log(id);
            $.ajax({
                type: "post",
                url: "confirm",
                data: {id_confirm:id},
                dataType: "JSON",
                success: function (response) {
                    if (response.success == true) {
                        swallSuccess("Berhasi", "berhasil di konfirmasi", "success", function () {
                            location.reload();
                        });
                    }else{
                        swallSuccess("Gagal", 'gagal di konfirmasi', 'error', '');
                    }
                }
            });
        });
    });
});
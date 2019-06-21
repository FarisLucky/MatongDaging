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
    const approve = $("#tbl_approve_pembayaran,#tbl_approve_transaksi,#tbl_app_detail,#tbl_approve_manager,#tbl_list_approve").DataTable({
        "responsive":true
    }); 
    const base = $("body").attr("data-base");
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

    $('table#tbl_approve_pembayaran').on('click','.btn_accept',function (e) { 
        e.preventDefault();
        let params = $(this).attr('data-id');
        swallQuestion("Accept ?", "Ingin diterima ?", "question", 'Accept', function () {
            $.ajax({
                type: "GET",
                url: "accept",
                data: {params},
                dataType: "JSON",
                success: function (response) {
                    if (response.success == true) {
                        swallSuccess("Berhasil", "berhasil di konfirmasi", "success", function () {
                            location.reload();
                        });
                    }else{
                        swallSuccess("Gagal", 'gagal di konfirmasi', 'error', '');
                    }
                }
            });
        });
    });
    $('table#tbl_approve_pembayaran').on('click','.btn_reject',function (e) { 
        e.preventDefault();
        let params = $(this).attr('data-id');
        swallQuestion("Reject ?", "Ingin diterima ?", "question", 'Reject', function () {
            $.ajax({
                type: "GET",
                url: "reject",
                data: {params},
                dataType: "JSON",
                success: function (response) {
                    if (response.success == true) {
                        swallSuccess("Berhasil", "berhasil disimpan", "success", function () {
                            location.reload();
                        });
                    }else{
                        swallSuccess("Gagal", 'gagal di konfirmasi', 'error', '');
                    }
                }
            });
        });
    });

    $("table#tbl_app_detail").on("click",".btn-transaksi", function (e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        let src ;
        $.ajax({
            type: "post",
            url: "modal",
            data: {id},
            dataType: "JSON",
            success: function (response) {
                if (response.success == true) {
                    if (response.pembayaran.id_jenis == 1) {
                        src = base+"assets/uploads/images/pembayaran/tanda_jadi/"+response.pembayaran.bukti_bayar;
                    }
                    else if(response.pembayaran.id_jenis == 2){
                        src = base+"assets/uploads/images/pembayaran/uang_muka/"+response.pembayaran.bukti_bayar;
                    }else{
                        src = base+"assets/uploads/images/pembayaran/cicilan/"+response.pembayaran.bukti_bayar;
                    }
                    $("#modal_transaksi .user").text("User : "+response.pembayaran.pembuat);
                    $("#modal_transaksi .tgl_bayar").text("Tanggal Bayar : "+response.pembayaran.tgl_bayar);
                    $("#modal_transaksi .tgl_tempo").text("Tanggal Tempo : "+response.pembayaran.tgl_jatuh_tempo);
                    $("#modal_transaksi .jenis").text("Jenis Pembayaran : "+response.pembayaran.jenis_pembayaran);
                    $("#modal_transaksi .type_modal").text("Type Pembayaran : "+response.pembayaran.type_bayar);
                    $("#modal_transaksi .status").text(response.pembayaran.status);
                    $("#modal_transaksi .img-base").attr("src",src);
                    $("#modal_transaksi").modal("show");
                }
            }
        });
    });
    $("#tbl_list_approve").on("click",".btn-confirm", function (e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        swallQuestion("Konfirmasi ?", "Ingin di Konfirmasi ?", "question", 'confirm', function () {
            $.ajax({
                type: "post",
                url: "approvelist/confirm",
                data: {id_confirm:id},
                dataType: "JSON",
                success: function (response) {
                    if (response.success == true) {
                        swallSuccess("Berhasil", "berhasil di konfirmasi", "success", function () {
                            location.reload();
                        });
                    }else{
                        swallSuccess("Gagal", 'gagal di konfirmasi', 'error', '');
                    }
                }
            });
        });
    });
    $("#tbl_list_approve").on("click",".btn-detail", function (e) {
        e.preventDefault();
        let params = $(this).attr("data-id");
        $.ajax({
            type: "post",
            url: "approvelist/getModal",
            data: {params},
            dataType: "JSON",
            success: function (response) {
                $("#modal_approve_list .ttl_gambar").remove();
                if (response.success == true) {
                    if (response.img == "gambar_kosong") {
                        $("#img_file").after("<h5 class='ttl_gambar'>Gambar Bukti Kosong</h5>")
                    }else if(response.img == "belum_upload"){
                        $("#img_file").after("<h5 class='ttl_gambar'>Belum Upload bukti</h5>")
                    }else{
                        $("#img_file").attr("src",response.bukti_kwitansi);
                    }
                    $("#modal_approve_list").modal("show");
                }
            }
        });
    });
});
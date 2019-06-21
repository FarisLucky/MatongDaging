function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
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
function dataTables(selector,url,datas) {
    $(selector).DataTable ({
        "processing": true,
        "responsive": true,
        "fixColumns": false,
        "serverSide": true,
        "searching":false,
        "order": [],
        "ajax": {
            url: url,
            type: "POST",
            data: datas
        },
        "columnDefs": [{
            "orderable": false,
            "targets": '_all'
        }]
    });
}
    function readURL(input,selector) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(selector).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
$(document).ready(function () {
    const tanda_jadi = dataTables("#tbl_tanda_jadi","datatj","");
    const uang_muka = dataTables("#tbl_uang_muka","dataum","");
    const transaksi = dataTables("#tbl_transaksi","datatransaksi","");
    const tbl_kelola_um = $("#tbl_kelola_um,#tbl_cicilan").DataTable({
        "responsive":true
    });
    
    $("#modal_tanda_jadi input[name='upload']").change(function () {
        readURL(this,"#modal_tanda_jadi img");
    });
    $("#modal_uang_muka input[name='upload']").change(function () {
        readURL(this,"#modal_uang_muka img");
    });
    $("#modal_cicilan input[name='upload']").change(function () {
        readURL(this,"#modal_cicilan img");
    });
    
    let input_bayar = document.getElementsByName('bayar')[0];
    if (input_bayar != null) {
        
        input_bayar.addEventListener('keyup', function(e){
            input_bayar.value = formatRupiah(this.value, 'Rp. ');
        });
    }
    $("#modal_tanda_jadi #bayar").change(function (e) { 
        e.preventDefault();
        let bayar = $(this).val();
        let ttl_tj = parseInt($("#modal_tanda_jadi input[name='hutang']").val());
        let val_bayar = parseInt(bayar.split('.').join(''));
        toastr.remove();
        if (val_bayar > ttl_tj) {
            $(this).val('');
            toastr.error("Jumlah bayar terlalu besar");
            return;
        }
    });
    $("#modal_uang_muka .nominal_um").change(function (e) { 
        e.preventDefault();
        let bayar = $(this).val();
        let ttl_um = parseInt($("#modal_uang_muka input[name='hutang']").val());
        let val_bayar = parseInt(bayar.split('.').join(''));
        toastr.remove();
        if (val_bayar > ttl_um) {
            $(this).val('');
            toastr.error("Jumlah bayar terlalu besar");
            return;
        }
    });
    $("#modal_cicilan .nominal_cicilan").change(function (e) { 
        e.preventDefault();
        let bayar = $(this).val();
        let ttl_tj = parseInt($("modal_cicilan input[name='hutang']").val());
        let val_bayar = parseInt(bayar.split('.').join(''));
        toastr.remove();
        if (val_bayar > ttl_tj) {
            $(this).val('');
            toastr.error("Jumlah Bayar terlalu besar");
            return;
        }
    });
    // Filter Pembayaran
    // FIlter Uang Muka
    $("#filter_bayar_um").click(function (e) { 
        e.preventDefault();
        let id_unit = $("#id_unit").val();
        if (id_unit == "") {
            $data = "";
        }else{
            $data = {id_unit};
        }
        $("#tbl_uang_muka").DataTable().destroy();
        dataTables("#tbl_uang_muka","dataum",$data);
    });
    // Filter Cicilan
    $("#view_transaksi #filter_bayar_cicilan").click(function (e) { 
        e.preventDefault();
        let id_unit = $("#view_transaksi #id_unit").val();
        if (id_unit == "") {
            $data = "";
        }else{
            $data = {id_unit};
        }
        $("#view_transaksi #tbl_transaksi").DataTable().destroy();
        dataTables("#view_transaksi #tbl_transaksi","datatransaksi",$data);
    });

    $("#tbl_tanda_jadi").on("click",".bayar_tj",function (e) { 
        e.preventDefault();
        let params = $(this).attr("data-id");
        $.ajax({
            type: "GET",
            url: "getmodal",
            data: {
                params
            },
            dataType: "JSON",
            success: function (response) {
                $("#modal_tanda_jadi").modal("show");
                $("#modal_tanda_jadi .tanda_jadi").val(response.total_tagihan);
                $("#modal_tanda_jadi input[name='hutang']").val(response.hutang);
                $("#modal_tanda_jadi input[name='input_hidden']").val(response.id_pembayaran);
            }
        });
    });
    
    $("#tbl_tanda_jadi").on("click",".lock_bayar",function (e) { 
        e.preventDefault();
        let params = $(this).attr("data-id");
        let base = $("body").attr("data-base");
        Swal.fire({
            title: "Lock ?",
            text: "Apakah ingin dilock ?",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: '#00ce68',
            cancelButtonColor: '#e65251',
            confirmButtonText: 'Lock !'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "paylock",
                    data:{params},
                    dataType: "JSON",
                    success: function (success) {
                        if (success.success == false) {
                            swallSuccess("Gagal", "Gagal dilock", "error", null);
                        } else {
                            swallSuccess("Berhasil", "Berhasil Dilock", "success", function () {
                                location.reload();
                            });
                        }
                    }
                });
            }
        })
    });
    $("#tbl_tanda_jadi").on("click",".edit_bayar",function (e) { 
        e.preventDefault();
        let params = $(this).attr("data-id");
        let base = $("body").attr("data-base");
        $.ajax({
            type: "GET",
            url: "getmodal",
            data: {
                params
            },
            dataType: "JSON",
            success: function (response) {
                $("#modal_tanda_jadi").modal("show");
                $("#modal_tanda_jadi .tanda_jadi").val(response.total_tagihan);
                $("#modal_tanda_jadi input[name='hutang']").val(response.hutang);
                $("#modal_tanda_jadi input[name='bayar']").val(response.jumlah_bayar);
                $("#modal_tanda_jadi input[name='tgl']").val(response.tgl_bayar);
                $("#modal_tanda_jadi img").attr("src",base+"assets/uploads/images/pembayaran/tanda_jadi/"+response.bukti_bayar);
                $("#modal_tanda_jadi input[name='input_hidden']").val(response.id_pembayaran);
            }
        });
    });

    $(".form_tanda_jadi").submit(function (e) { 
        e.preventDefault();
        let form = new FormData($(this)[0]);
        $.ajax({
            type: "post",
            url: "core_tanda_jadi",
            data: form,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success == true) {
                    $('input.form-group').removeClass('is-invalid').removeClass('is-valid');
                    swallSuccess("Sukses", "Berhasil disimpan", "success", function () {
                        $("#modal_tanda_jadi").modal("hide");
                        location.reload();
                    })
                } else if ((response.success == false) && (response.error)) {
                    toastr.error(response.error);
                } else {
                    $.each(response.msg, function (key, val) {
                        let el = $('input[name=' + key +']')
                        el.removeClass('is-invalid')
                            .addClass(val.length > 0 ? 'is-invalid' : 'is-valid')
                            .next('.invalid-feedback').remove();
                        el.after(val);
                    });
                }
            }
        });
    });
    
    $("#tbl_kelola_um").on("click",".bayar_um",function (e) { 
        e.preventDefault();
        let base = $("body").attr("data-base");
        let params = $(this).attr("data-id");
        $.ajax({
            type: "GET",
            url: base+"pembayaran/getmodal",
            data: {params},
            dataType: "JSON",
            success: function (response) {
                $("#modal_uang_muka").modal("show");
                $("#modal_uang_muka .uang_muka").val(response.total_tagihan);
                $("#modal_uang_muka input[name='hutang']").val(response.hutang);
                $("#modal_uang_muka input[name='input_hidden']").val(response.id_pembayaran);
            }
        });
    });
    $("#tbl_kelola_um").on("click",".lock_bayar",function (e) { 
        e.preventDefault();
        let params = $(this).attr("data-id");
        let base = $("body").attr("data-base");
        Swal.fire({
            title: "Lock ?",
            text: "Apakah ingin dilock ?",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: '#00ce68',
            cancelButtonColor: '#e65251',
            confirmButtonText: 'Lock !'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: base+"pembayaran/paylock",
                    data:{params},
                    dataType: "JSON",
                    success: function (success) {
                        if (success.success == false) {
                            swallSuccess("Gagal", "Gagal dilock", "error", null);
                        } else {
                            swallSuccess("Berhasil", "Berhasil Dilock", "success", function () {
                                location.reload();
                            });
                        }
                    }
                });
            }
        })
    });
    $("#tbl_kelola_um").on("click",".edit_bayar",function (e) { 
        e.preventDefault();
        let params = $(this).attr("data-id");
        let base = $("body").attr("data-base");
        $.ajax({
            type: "GET",
            url: base+"pembayaran/getmodal",
            data: {
                params
            },
            dataType: "JSON",
            success: function (response) {
                $("#modal_uang_muka").modal("show");
                $("#modal_uang_muka .uang_muka").val(response.total_tagihan);
                $("#modal_uang_muka input[name='hutang']").val(response.hutang);
                $("#modal_uang_muka input[name='bayar']").val(response.jumlah_bayar);
                $("#modal_uang_muka input[name='tgl']").val(response.tgl_bayar);
                $("#modal_uang_muka img").attr("src",base+"assets/uploads/images/pembayaran/uang_muka/"+response.bukti_bayar);
                $("#modal_uang_muka input[name='input_hidden']").val(response.id_pembayaran);
            }
        });
    });
    $(".form_uang_muka").submit(function (e) { 
        e.preventDefault();
        let form = new FormData($(this)[0]);
        let act = $(this).attr('action');
        $.ajax({
            type: "post",
            url: act,
            data: form,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success == true) {
                    $('input.form-group').removeClass('is-invalid').removeClass('is-valid');
                    swallSuccess("Sukses", "Berhasil disimpan", "success", function () {
                        $("#modal_uang_muka").modal("hide");
                        location.reload();
                    })
                } else if ((response.success == false) && (response.error)) {
                    toastr.error(response.error);
                } else {
                    $.each(response.msg, function (key, val) {
                        let el = $('input[name=' + key +']')
                        el.removeClass('is-invalid')
                            .addClass(val.length > 0 ? 'is-invalid' : 'is-valid')
                            .next('.invalid-feedback').remove();
                        el.after(val);
                    });
                }
            }
        });
    });
    $("#tbl_cicilan").on("click",".bayar_cicilan",function (e) { 
        e.preventDefault();
        let params = $(this).attr("data-id");
        let base = $("body").attr("data-base");
        $.ajax({
            type: "GET",
            url: base+"pembayaran/getModal",
            data: {params},
            dataType: "JSON",
            success: function (response) {
                $("#modal_cicilan").modal("show");
                $("#modal_cicilan .cicilan").val(response.total_tagihan);
                $("#modal_cicilan input[name='hutang']").val(response.hutang);
                $("#modal_cicilan input[name='input_hidden']").val(response.id_pembayaran);
            }
        });
    });
    $("#tbl_cicilan").on("click",".edit_bayar",function (e) { 
        e.preventDefault();
        let params = $(this).attr("data-id");
        let base = $("body").attr("data-base");
        $.ajax({
            type: "GET",
            url: base+"pembayaran/getmodal",
            data: {
                params
            },
            dataType: "JSON",
            success: function (response) {
                $("#modal_cicilan").modal("show");
                $("#modal_cicilan .cicilan").val(response.total_tagihan);
                $("#modal_cicilan input[name='hutang']").val(response.hutang);
                $("#modal_cicilan input[name='bayar']").val(response.jumlah_bayar);
                $("#modal_cicilan input[name='tgl']").val(response.tgl_bayar);
                $("#modal_cicilan img").attr("src",base+"assets/uploads/images/pembayaran/cicilan/"+response.bukti_bayar);
                $("#modal_cicilan input[name='input_hidden']").val(response.id_pembayaran);
            }
        });
    });
    $("#tbl_cicilan").on("click",".lock_bayar",function (e) { 
        e.preventDefault();
        let params = $(this).attr("data-id");
        let base = $("body").attr("data-base");
        Swal.fire({
            title: "Lock ?",
            text: "Apakah ingin dilock ?",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: '#00ce68',
            cancelButtonColor: '#e65251',
            confirmButtonText: 'Lock !'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: base+"pembayaran/paylock",
                    data:{params},
                    dataType: "JSON",
                    success: function (success) {
                        if (success.success == false) {
                            swallSuccess("Gagal", "Gagal dilock", "error", null);
                        } else {
                            swallSuccess("Berhasil", "Berhasil Dilock", "success", function () {
                                location.reload();
                            });
                        }
                    }
                });
            }
        })
    });
    $(".form_cicilan").submit(function (e) { 
        e.preventDefault();
        let form = new FormData($(this)[0]);
        let base = $("body").attr("data-base");
        $.ajax({
            type: "post",
            url: base+"pembayaran/core_cicilan",
            data: form,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success == true) {
                    $('input.form-group').removeClass('is-invalid').removeClass('is-valid');
                    swallSuccess("Sukses", "Berhasil disimpan", "success", function () {
                        $("#modal_uang_muka").modal("hide");
                        location.reload();
                    })
                } else if ((response.success == false) && (response.error)) {
                    toastr.error(response.error);
                } else {
                    $.each(response.msg, function (key, val) {
                        let el = $('input[name=' + key +']')
                        el.removeClass('is-invalid')
                            .addClass(val.length > 0 ? 'is-invalid' : 'is-valid')
                            .next('.invalid-feedback').remove();
                        el.after(val);
                    });
                }
            }
        });
    });
});
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
$(document).ready(function () {
    const tanda_jadi = $('#tbl_tanda_jadi').DataTable ({
        "processing": true,
        "responsive": true,
        "scrollX": true,
        "fixColumns": false,
        "autoWidth": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: 'datatj',
            type: "POST"
        },
        "columnDefs": [{
            "orderable": false,
            "targets": '_all'
        }],
        "bDestroy": true
    });
    const uang_muka = $('#tbl_uang_muka').DataTable ({
        "processing": true,
        "responsive": true,
        "scrollX": true,
        "fixColumns": false,
        "autoWidth": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: 'dataum',
            type: "POST"
        },
        "columnDefs": [{
            "orderable": false,
            "targets": '_all'
        }],
        "bDestroy": true
    });
    const transaksi = $('#tbl_transaksi').DataTable ({
        "processing": true,
        "responsive": true,
        "scrollX": true,
        "fixColumns": false,
        "autoWidth": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: 'datac',
            type: "POST"
        },
        "columnDefs": [{
            "orderable": false,
            "targets": '_all'
        }],
        "bDestroy": true
    });
    const tbl_kelola_um = $("#tbl_kelola_um,#tbl_cicilan").DataTable({
        "responsive":true
    });
    $("#tbl_tanda_jadi").on("click",".bayar_tj",function (e) { 
        e.preventDefault();
        let id = $(this).attr("data-id");
        $.ajax({
            type: "post",
            url: "tanda_jadi",
            data: {
                id
            },
            dataType: "JSON",
            success: function (response) {
                $("#modal_tanda_jadi").modal("show");
                $(".tanda_jadi").val(response.tj);
                $("input[name='input_hidden']").val(response.id);
            }
        });
    });

    let input_bayar = document.getElementsByName('bayar')[0];
    if (input_bayar != null) {
        
        input_bayar.addEventListener('keyup', function(e){
            input_bayar.value = formatRupiah(this.value, 'Rp. ');
        });
    }
    $("#bayar").change(function (e) { 
        e.preventDefault();
        let bayar = $(this).val();
        let ttl_tj = $(".tanda_jadi").val();
        let val_bayar = bayar.split('.').join('');
        toastr.remove();
        if (val_bayar != ttl_tj) {
            $(this).val('');
            toastr.error("Jumlah Bayar tidak sama");
            return;
        }
    });
    $(".nominal_um").change(function (e) { 
        e.preventDefault();
        let bayar = $(this).val();
        let ttl_tj = $(".uang_muka").val();
        let val_bayar = bayar.split('.').join('');
        toastr.remove();
        if (val_bayar != ttl_tj) {
            $(this).val('');
            toastr.error("Jumlah Bayar tidak sama");
            return;
        }
    });
    $(".nominal_cicilan").change(function (e) { 
        e.preventDefault();
        let bayar = $(this).val();
        let ttl_tj = $(".cicilan").val();
        let val_bayar = bayar.split('.').join('');
        toastr.remove();
        if (val_bayar != ttl_tj) {
            $(this).val('');
            toastr.error("Jumlah Bayar tidak sama");
            return;
        }
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
                    swallSuccess("Sukses", "Berhasil ditambahkan", "success", function () {
                        tanda_jadi.ajax.reload();
                        $("#modal_tanda_jadi").modal("hide");
                    })
                } else if ((response.success == false) && (response.error)) {
                    toastr.error(error);
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
    
    $("#tbl_kelola_um").on("click",".bayar_Um",function (e) { 
        e.preventDefault();
        let id = $(this).attr("data-id");
        let link = $(this).attr("href");
        $.ajax({
            type: "post",
            url: link,
            data: {id},
            dataType: "JSON",
            success: function (response) {
                $("#modal_uang_muka").modal("show");
                $("input[name='uang_muka']").val(response.um);
                $("input[name='input_hidden']").val(response.id);
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
                    swallSuccess("Sukses", "Berhasil ditambahkan", "success", function () {
                        tbl_kelola_um.ajax.reload();
                        $("#modal_uang_muka").modal("hide");
                    })
                } else if ((response.success == false) && (response.error)) {
                    toastr.error(error);
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
    $("#tbl_cicilan").on("click",".btn-transaksi",function (e) { 
        e.preventDefault();
        let id = $(this).attr("data-id");
        let link = $(this).attr("href");
        $.ajax({
            type: "post",
            url: link,
            data: {id},
            dataType: "JSON",
            success: function (response) {
                $("#modal_transaksi").modal("show");
                $("input[name='cicilan']").val(response.um);
                $("input[name='input_hidden']").val(response.id);
            }
        });
    });
});
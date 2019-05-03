function reload() {
    location.reload()
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

function swallQuestion(titles, texts, types, success) {
    Swal({
        title: titles,
        text: texts,
        type: types,
        showCancelButton: true,
        confirmButtonColor: '#a55eea',
        cancelButtonColor: '#fed330',
        confirmButtonText: 'Hapus !'
    }).then((result) => {
        if (result.value) {
            if (typeof success == 'function') {
                success();
            };
        }
    })
}

function notifToastr(types, text) {
    toastr[types](text);
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "500",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
}

$(document).ready(function () {

    if ($("#tambah_properti").length > 0) {
        CKEDITOR.replace('txt_spr');
    }
    const properti = $('#tbl_properti').DataTable({
        "processing": true,
        "responsive": true,
        "fixColumns": false,
        "autoWidth": false,
        "scrollX": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: 'properti/dataproperti',
            type: "POST"
        },
        "columnDefs": [{
            "orderable": false,
            "targets": '_all'
        }, {
            "responsivePriority": 1,
            "targets": 0
        }, ],
    });

    $("#btn_ubah_properti").click(function (e) {
        e.preventDefault();
        $("#form_detail input[name='txt_nama']").attr('disabled', false);
        $("#form_detail input[name='txt_jumlah']").attr('disabled', false);
        $("#form_detail input[name='txt_luas']").attr('disabled', false);
        $("#form_detail input[name='txt_rekening']").attr('disabled', false);
        $("#form_detail textarea#txt_spr").attr('disabled', false);
        $("#form_detail textarea#txt_alamat").attr('disabled', false);
        $("#form_detail #txt_status").attr('disabled', false);
        $("#form_detail #logo_properti").after('<input type="file" name="img[logo]" multiple id="txt_logo" class="form-control col-sm-4">');
        $("#form_detail #foto_properti").after('<input type="file" name="img[foto]" multiple id="txt_foto" class="form-control col-sm-4">');
        $(this).after(' <button type="submit" class="btn btn-sm btn-primary mr-2">Simpan</button><button type="button" onClick="reload()" id="batal_ubahs" class="btn btn-sm btn-dark mr-2">Batal</button>');
        $(this).remove();
    });

    $("#form_detail").on("submit", function (e) {
        e.preventDefault();
        let form = new FormData($(this)[0]);
        let url = $(this).attr('action');
        console.log(form);
        $.ajax({
            type: "post",
            url: url,
            data: form,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function (success) {
                console.log(success);
                if (success.success === true) {
                    $('input.form-group').removeClass('is-invalid').removeClass('is-valid')
                        .next().remove();
                    swallSuccess("Berhasil", "Data Disimpan", "success", function () {
                        location.reload();
                    });
                } else {
                    if (success.error != "") {
                        swallSuccess("Kesalahan", "Kesalahan !", "error");
                        return;
                    }
                    $.each(success.msg, function (key, val) {
                        let el = $('#' + key)
                        el.removeClass('is-invalid')
                            .addClass(val.length > 0 ? 'is-invalid' : 'is-valid')
                            .next().remove();
                        el.after(val);
                        return;
                    });
                }
            }
        });
    });
});
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

function setDataMethod(id, ajaxAttr, data, ajaxSuccess) {
    // Get data with async
    $.ajax({
        url: ajaxAttr[0] + id,
        type: ajaxAttr[1],
        data: data,
        dataType: "JSON",
        success: function (getKategori) {
            if (typeof ajaxSuccess == 'function') {
                ajaxSuccess(getKategori);
            }
        }
    });
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
    const user = $('#tbl_users').DataTable({
        "processing": true,
        "responsive": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: 'kelolausers/datausers',
            type: "POST"
        },
        "columnDefs": [{
            "orderable": false,
            "targets": '_all'
        }],
        "bDestroy": true
    });

    $("table#tbl_users").on("click", "#aktif_data_user", function (e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        let btn_status = "aktif";
        let ajax = ['kelolausers/userstatus', 'post'];
        swallQuestion("Yakin ?", "Apakah ingin di Aktifkan ?", "question", 'Aktifkan', function () {
            setDataMethod("", ajax, {
                id_user: id,
                status: btn_status
            }, function (Parameters) {
                if (Parameters.success == "sukses") {
                    swallSuccess("Berhasil", "Data Disimpan", "success", user.ajax.reload())
                } else {
                    swallSuccess("Gagal", "Proses gagal", "error", user.ajax.reload())
                }
            })
        })
    });

    $("table#tbl_users").on("click", "#nonaktif_data_user", function (e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        let status = "nonaktif";
        let ajax = ['kelolausers/userstatus', 'post'];
        swallQuestion("Yakin ?", "Apakah ingin Nonaktifkan ?", "question", 'Nonaktifkan', function () {
            setDataMethod("", ajax, {
                id_user: id,
                status: status
            }, function (Parameters) {
                if (Parameters.success == "sukses") {
                    swallSuccess("Berhasil", "Data Disimpan", "success", user.ajax.reload())
                } else {
                    swallSuccess("Gagal", "Proses gagal", "error", user.ajax.reload())
                }
            })
        })
    });

    $("#detail_user_content #form_user_properti").submit(function (e) {
        e.preventDefault();
        // if (!$("#properti").is(':checked')) {
        //     toastr.remove();
        //     notifToastr("error", "Pilih Perumahan");
        //     return;
        // }
        let form = $(this).serialize();
        let ajax = [$(this).attr("action"), "post"];
        console.log(form);
        setDataMethod("", ajax, form, function (success) {
            if (success.success == true) {
                swallSuccess("Berhasil", "Data Disimpan", "success", function () {
                    location.reload();
                });
            } else {
                swallSuccess("Gagal", "Gagal Disimpan", "error", function () {
                    location.reload();
                });
            }
        });
    });

    $("table#tbl_users").on("click", "#hapus_data_user", function (e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        let ajax = ['kelolausers/hapus/', 'get'];
        swallQuestion("Yakin ?", "Apakah ingin di hapus ?", "question", 'Hapus', function () {
            setDataMethod(id, ajax, null, function (Parameters) {
                if (Parameters.success == true) {
                    swallSuccess("Berhasil", "Data Disimpan", "success", user.ajax.reload())
                } else {
                    swallSuccess("Gagal", "Gagal dihapus", "error", user.ajax.reload())
                }
            });
        })
    });

    $("#form_user").submit(function (e) {
        e.preventDefault();
        let form = new FormData($(this)[0]);
        let batal = $("#batal").attr("href");
        if ($("input[name='radio_jk']:checked").length == 0) {
            toastr.remove();
            notifToastr("error", "Pilih Jenis Kelamin");
            return;
        }
        $.ajax({
            type: "post",
            url: "core_tambah",
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
                        window.location.href = batal;
                    });
                }else if((success.success == false) && (success.error)){
                    toastr.remove();
                    notifToastr("error", "Type foto harus jpg | jpeg | png");
                    return;
                } 
                else {
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

    $("#show_pw").click(function (e) {
        if ($(this).is(":checked")) {
            $("#txt_password_user").attr("type", "text");
        } else {
            $("#txt_password_user").attr("type", "password");
        }
    });
    $("#show_pw2").click(function (e) {
        if ($(this).is(":checked")) {
            $("#txt_retype_password").attr("type", "text");
        } else {
            $("#txt_retype_password").attr("type", "password");
        }
    });

});
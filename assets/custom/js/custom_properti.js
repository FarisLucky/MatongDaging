function reload() {
    location.reload()
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

function readURL(input,selector) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(selector).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
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
    $(".overlay").remove();
    const properti = $('#tbl_properti').DataTable({
        "processing": true,
        "responsive": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: 'properti/dataproperti',
            type: "POST"
        },
        "columnDefs": [{
            "orderable": false,
            "targets": '_all'
        }],
    });

    
    $(document).on("change","#detail_property #txt_foto",function (e) {
        e.preventDefault();
        readURL(this,"#detail_property img#foto_properti");
    });
    $(document).on("change","#detail_property #txt_logo",function (e) {
        e.preventDefault();
        readURL(this,"#detail_property img#logo_properti");
    });
    $(document).on("change","#tambah_property #txt_foto",function (e) {
        e.preventDefault();
        readURL(this,"#tambah_property img#foto_properti");
    });
    $(document).on("change","#tambah_property #txt_logo",function (e) {
        e.preventDefault();
        readURL(this,"#tambah_property img#logo_properti");
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
        let base = $("body").attr("data-base");
        let url = base+"properti/update";
        $.ajax({
            type: "post",
            url: url,
            data: form,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function (success) {
                if (success.success === true) {
                    $('input.form-group').removeClass('is-invalid').removeClass('is-valid')
                        .next().remove();
                    swallSuccess("Berhasil", "Data Disimpan", "success", function () {
                        location.reload();
                    });
                } else if ((success.success == false) && (success.error)) {
                    swallSuccess("Gagal Update", success.error, "error", null);
                } else {
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
    $("#form_tambah").on("submit", function (e) {
        e.preventDefault();
        let form = new FormData($(this)[0]);
        let url = $(this).attr('action');
        // console.log(form);
        $.ajax({
            type: "post",
            url: "core_tambah",
            data: form,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function (success) {
                // console.log(success);
                if (success.success === true) {
                    $('input.form-group').removeClass('is-invalid').removeClass('is-valid')
                        .next().remove();
                    swallSuccess("Berhasil", "Data Disimpan", "success", function () {
                        window.location.href = url;
                    });
                } else if ((success.success == false) && (success.error)) {
                    swallSuccess("Gagal Update", success.error, "error", null);
                } else {
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
    $("table#tbl_properti").on("click", "#hapus_data_properti", function (e) {
        e.preventDefault();
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
                let id = $(this).attr('data-id');
                $.ajax({
                    type: "post",
                    url: "properti/hapus",
                    data: {
                        id_properti: id
                    },
                    dataType: "JSON",
                    success: function (success) {
                        if (success.success == "false") {
                            swallSuccess("Gagal Dihapus", success.error, "error", null);
                        } else {
                            swallSuccess("Berhasil", "Berhasil Dihapus", "success", function () {
                                properti.ajax.reload();
                            });
                        }
                    }
                });
            }
        })
    });

    $("table#tbl_properti").on("click", "#publish_data_properti", function (e) {
        e.preventDefault();
        Swal({
            title: "Publish ?",
            text: "Apakah ingin dipublish ?",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: '#a55eea',
            cancelButtonColor: '#fed330',
            confirmButtonText: 'publish !'
        }).then((result) => {
            if (result.value) {
                let id = $(this).attr('data-id');
                $.ajax({
                    type: "post",
                    url: "properti/publish",
                    data: {
                        id_properti: id
                    },
                    dataType: "JSON",
                    success: function (success) {
                        if (success.success == "false") {
                            swallSuccess("Gagal Dipublish", success.error, "error", null);
                        } else {
                            swallSuccess("Berhasil", "Berhasil Dipublish", "success", function () {
                                properti.ajax.reload();
                            });
                        }
                    }
                });
            }
        })
    })
    $("table#tbl_properti").on("click","#tambah_rab_properti",function (e) { 
        e.preventDefault();
        let id = $(this).attr("data-id");
        $("#modal_dialog").modal("show");
        $("#form_modal").find("button").attr({"id":"rab_properti","data-id":id});
    });
    $("table#tbl_properti").on("click","#tambah_rab_unit",function (e) { 
        e.preventDefault();
        let id = $(this).attr("data-id");
        $("#modal_dialog").modal("show");
        $("#form_modal").find("button").attr({"id":"rab_unit","data-id":id});
    });
    $(document).on("click","#rab_properti",function(e) {
        e.preventDefault();
        let id_properti = $(this).attr("data-id");
        let nama = $("input[name='txt_name']").val();
        $.ajax({
            type: "post",
            url: "properti/rab",
            data: {id_properti,nama},
            dataType: "JSON",
            success: function (response) {
                if (response.success) {
                    window.location.href = response.redirect;
                }
            }
        });
    })
    $(document).on("click","#rab_unit",function(e) {
        e.preventDefault();
        let id_unit = $(this).attr("data-id");
        let nama = $("input[name='txt_name']").val();
        $.ajax({
            type: "post",
            url: "properti/rab",
            data: {id_unit,nama},
            dataType: "JSON",
            success: function (response) {
                if (response.success) {
                    window.location.href = response.redirect;
                }
            }
        });
    })
    let view = $("#tambah_property");
    let view_detail = $("#detail_property");
    if (view.length != 0) {
        CKEDITOR.replace("txt_spr");
    }
    if (view_detail.length != 0) {
        CKEDITOR.replace("txt_edit_spr");
    }
});

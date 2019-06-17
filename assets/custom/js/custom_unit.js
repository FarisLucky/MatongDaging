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
    // Datatable Unit
    const unit = $('#tbl_unit').DataTable ({
        "processing": true,
        "responsive": true,
        "fixColumns": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: 'unit_properti/dataunit',
            type: "POST"
        },
        "columnDefs": [{
            "orderable": false,
            "targets": '_all'
        }],
        "bDestroy": true
    });

    $("#btn_ubah_unit").click(function (e) {
        e.preventDefault();
        $("#form_detail_unit input[name='txt_nama']").attr('disabled', false);
        $("#form_detail_unit input[name='txt_type']").attr('disabled', false);
        $("#form_detail_unit input[name='txt_tanah']").attr('disabled', false);
        $("#form_detail_unit input[name='txt_bangunan']").attr('disabled', false);
        $("#form_detail_unit input[name='txt_harga']").attr('disabled', false);
        $("#form_detail_unit textarea#txt_desc").attr('disabled', false);
        $("#form_detail_unit textarea#txt_alamat").attr('disabled', false);
        $("#form_detail_unit #foto_unit").after('<input type="file" name="foto" multiple id="txt_logo" class="form-control col-sm-3">');
        $(this).after(' <button type="submit" class="btn btn-sm btn-primary mr-2">Simpan</button>');
        $(this).remove();
    });

    $("#form_tambah_unit").submit(function (e) {
        e.preventDefault();
        let urls = "core_tambah_unit";
        let url = $(this).attr("action");
        let types = "post";
        let datas = new FormData($(this)[0]);
        $.ajax({
            type: types,
            url: urls,
            data: datas,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success == true) {
                    $('input.form-group').removeClass('is-invalid').removeClass('is-valid')
                        .next().remove();
                    swallSuccess(response.title, response.text, response.type, function () {
                        window.location.href = url;
                    })
                } else if ((response.success == false) && (response.error)) {
                    swallSuccess(response.title, response.error, response.type, null)
                } else {
                    $.each(response.msg, function (key, val) {
                        let el = $('#' + key)
                        el.removeClass('is-invalid')
                            .addClass(val.length > 0 ? 'is-invalid' : 'is-valid')
                            .next('.invalid-feedback').remove();
                        el.after(val);
                        return;
                    });
                }
            }
        });
    });

    $("#form_detail_unit").submit(function (e) {
        e.preventDefault();
        let id = $(this).val();
        let urls = $(this).attr("action");
        let types = "post";
        let datas = new FormData($(this)[0]);
        // console.log(urls);   
        $.ajax({
            type: types,
            url: urls,
            data: datas,
            dataType: "JSON",
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success == true) {
                    $('input.form-group').removeClass('is-invalid').removeClass('is-valid');
                    swallSuccess("Berhasil", "Berhasil Diubah", "success", function () {
                        location.reload();
                    })
                } else {
                    $.each(response.msg, function (key, val) {
                        let el = $('#' + key)
                        el.removeClass('is-invalid')
                            .addClass(val.length > 0 ? 'is-invalid' : 'is-valid')
                            .next('.invalid-feedback').remove();
                        el.after(val);
                        return;
                    });
                }
            }
        });
    });

    $("table#tbl_unit").on("click", "#hapus_data_unit", function (e) {
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
                    url: "unit_properti/core_hapus",
                    data: {
                        id_unit: id
                    },
                    dataType: "JSON",
                    success: function (success) {
                        if (success.success == "false") {
                            swallSuccess("Gagal", "Gagal dihapus", "error", null);
                        } else {
                            swallSuccess("Berhasil", "Berhasil Dihapus", "success", function () {
                                unit.ajax.reload();
                            });
                        }
                    }
                });
            }
        })
    });

});
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
$(document).ready(function () {
    // Datatable Unit
    const unit = $('#tbl_unit').DataTable({
        "processing": true,
        "responsive": true,
        "scrollX": true,
        "fixColumns": false,
        "autoWidth": false,
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

    // Blok Unit Table
    const blok = $("#tbl_blok").DataTable();
    let select;
    $("table#tbl_blok").on("click", "#ubah_blok", function (e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        $.ajax({
            type: "post",
            url: "setData",
            data: {
                data_id: id
            },
            dataType: "JSON",
            success: function (response) {
                $("#txt_id").val(response.id_blok);
                $("#txt_blok").val(response.nama_blok);
                select = "ubah";
            }
        });
    });
    $("#form_tambah").submit(function (e) {
        e.preventDefault();
        let urls, types, datas;
        if (select == "ubah") {
            urls = "core_ubah";
            types = "post";
            datas = $(this).serialize();
        } else {
            urls = "core_tambah";
            types = "post";
            datas = $(this).serialize();
        }
        $.ajax({
            type: types,
            url: urls,
            data: datas,
            dataType: "JSON",
            success: function (response) {
                if (response.success == true) {
                    $('input.form-group').removeClass('is-invalid').removeClass('is-valid')
                        .next().remove();
                    swallSuccess(response.title, response.text, response.type, function () {
                        location.reload();
                    })
                } else {
                    $.each(response.msg, function (key, val) {
                        let el = $('#' + key)
                        el.removeClass('is-invalid')
                            .addClass(val.length > 0 ? 'is-invalid' : 'is-valid')
                            .next();
                        el.after(val);
                        return;
                    });
                }
            }
        });
    });
    $("#form_tambah_unit").submit(function (e) {
        e.preventDefault();
        let urls = "core_tambah_unit";
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
                        location.reload();
                    })
                } else {
                    $.each(response.msg, function (key, val) {
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
    // 
    $("table#tbl_blok").on("click", "#hapus_blok", function (e) {
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
                    url: "hapus",
                    data: {
                        txt_id: id
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
    $("#form_tambah_unit input[name='foto']").change(function (e) {
        e.preventDefault();
        readURL(this,"#tambah_unit img#foto_unit");
    });
});
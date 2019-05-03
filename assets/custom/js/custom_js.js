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

    $("#btn_ubah_profil").click(function (e) {
        e.preventDefault();
        $("#form_perusahaan input[type='text']").attr('disabled', false);
        $("#form_perusahaan input[type='email']").attr('disabled', false);
        $("#form_perusahaan input[type='number']").attr('disabled', false);
        $("#form_perusahaan textarea").attr('disabled', false);
        $("#form_perusahaan #logo_perusahaan").after('<input type="file" name="image" id="txt_img" class="form-control">');
        $(this).after('<button type="submit" id="btn_simpan_profil" class="btn btn-success mr-2">Submit</button>');
        $(this).remove();
    });
    $('#form_perusahaan').on('submit', function (e) {
        e.preventDefault();
        let form = new FormData($(this)[0]);
        let url = $(this).attr('action');
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
                        location.reload()
                    });
                } else if ((success.success == false) && (success.error.length > 0)) {
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

    $("#logo_perusahaan").click(function (e) {
        e.preventDefault();
        alert('hello');
        document.getElementById('logo_perusahaan').src = window.URL.createObjectURL(this.files[0])
    });
});
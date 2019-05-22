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
    $("#form_login").submit(function (e) {
        e.preventDefault();
        let datas = $(this).serialize();
        $.ajax({
            type: "post",
            url: "auth/core_login",
            data: datas,
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                if (response.success === true) {
                    window.location.href = response.redirect;
                } else {
                    toastr.remove();
                    $.each(response.msg, function (key, val) {
                        if (val != "") {
                            toastr.error(val);
                        }
                    });
                    if (response.auth.length != 0) {
                        toastr.error(response.auth);
                    }
                }
            }
        });
    });
    $('a#pilih_properti').click(function (e) { 
        e.preventDefault();
        let pilih = $("input[name='check_properti']:checked");
        if (pilih.length == 0) {
            toastr.remove();
            toastr.error('Pilih Properti')
            return;
        }
        let value = pilih.val();
        $.ajax({
            type: "post",
            url: "core_auth_properti",
            data: {value},
            dataType: "JSON",
            success: function (response) {
                if (response.success == true) {
                    window.location.reload();
                }
            }
        });
        // if ( < 1) {
        //     toastr.error('Pilih Perumahan');
        // }
    });
});
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
});
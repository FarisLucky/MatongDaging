
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
$(document).ready(function () {
    const base = $('body').attr('data-base'); 
    $("#tbl_rab_properti,#tbl_rab_unit").DataTable({
        "responsive":true
    });
    $("table#tbl_rab_properti").on("click","#rm_detail", function (e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        swallQuestion("Yakin ?", "Apakah ingin di Hapus ?", "question", 'Hapus', function () {
            $(".overlay").show();
            $.ajax({
                type: "post",
                url: base+"rab/hapus/"+id,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if (response.success == true) {   
                        swallSuccess("Berhasil", "Data Disimpan", "success", function () {
                            location.reload();
                        })
                    }
                },
                complete: function(){
                    $('.overlay').hide();
                }
            });
        })
    });
    $("table#tbl_rab_unit").on("click","#detail_hapus", function (e) {
        e.preventDefault();
        let id = $(this).attr("data-id");
        swallQuestion("Yakin ?", "Apakah ingin di Hapus ?", "question", 'Hapus', function () {
            $(".overlay").show();
            $.ajax({
                type: "post",
                url: base+"rab/hapusunit/"+id,
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    if (response.success == true) {   
                        swallSuccess("Berhasil", "Data Disimpan", "success", function () {
                            location.reload();
                        });
                    }
                },
                complete: function(){
                    $('.overlay').hide();
                }
            });
        })
    });
    $("#view_rab_properti #form_modal").submit(function (e) {
        e.preventDefault();
        let form = $(this).serialize();
        let base = $("body").attr("data-base");
        $(".overlay").show();
        $.ajax({
            type: "post",
            url: base+"rab/ubahrab",
            data: form,
            dataType: "JSON",
            success: function (response) {
                if (response.success == true) {
                    swallSuccess("Berhasil", "Data Disimpan", "success", function () {
                        location.reload();
                    });
                }else {
                    $.each(response.msg, function (key, val) {
                        let el = $('#' + key)
                        el.removeClass('is-invalid')
                            .addClass(val.length > 0 ? 'is-invalid' : 'is-valid')
                            .next('.invalid-feedback').remove();
                        el.after(val);
                    });
                }
            },
            complete: function(){
                $('.overlay').hide();
            }
        })
    })
    $("#tambah_rab").on("click",function(e) {
        e.preventDefault();
        let href = $(this).attr("href");
        let id = $(this).attr("data-id");
        $("#kembali").attr("href",base+id);
        location.href= href;
    })
    $("#view_rab_properti .ubah_rab").on("click",function (e) {
        e.preventDefault();
        $("#view_rab_properti #modal_dialog").modal("show");
    })
});
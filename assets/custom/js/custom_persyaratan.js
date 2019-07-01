function setAjax(ajaxAttr, data, ajaxSuccess) {
    // Get data with async
    $.ajax({
        type: ajaxAttr[0],
        url: ajaxAttr[1],
        data: data,
        dataType: "JSON",
        success: function (getKategori) {
            if (typeof ajaxSuccess == 'function') {
                ajaxSuccess(getKategori);
            }
        }
    });
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
function dataTables(selector,url,datas) {
    $(selector).DataTable ({
        "processing": true,
        "responsive": true,
        "fixColumns": false,
        "serverSide": true,
        "searching":false,
        "order": [],
        "ajax": {
            url: url,
            type: "POST",
            data: datas
        },
        "columnDefs": [{
            "orderable": false,
            "targets": '_all'
        }]
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
    $(".overlay").remove();
    let base = $("body").attr("data-base");
    $("#tbl_syarat,#tbl_syarat_unit").DataTable({
        "responsive":true
    });

    $("table#tbl_syarat").on("click",".hapus_syarat",function (e) { 
        e.preventDefault();
        let params = $(this).attr("data-id");
        let ajax = ["GET","persyaratankonsumen/hapus"];
        swallQuestion("Tanyakan ","Apakah ingin dihapus ?","question","Hapus",function(){
            setAjax(ajax,{params},function (params) {
                if (params.success == true) {
                    swallSuccess("Berhasil","Data disimpan","success",function () {
                        location.reload();
                    })
                }
            })
        })
    });
    $("table#tbl_syarat_unit").on("click",".hapus_syarat",function (e) { 
        e.preventDefault();
        let params = $(this).attr("data-id");
        let ajax = ["GET","persyaratankonsumen/hapus"];
        swallQuestion("Tanyakan ","Apakah ingin dihapus ?","question","Hapus",function(){
            setAjax(ajax,{params},function (params) {
                if (params.success == true) {
                    swallSuccess("Berhasil","Data disimpan","success",function () {
                        location.reload();
                    })
                }
            })
        })
    });

});
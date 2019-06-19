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
    let base = $("body").attr("data-base");
    $("#tbl_laporan_unit,#tbl_detail_kontrol").DataTable({
        "responsive":true
    });
    const calon_konsumen =  $('#tbl_laporan_calon').DataTable ({
        "processing": true,
        "responsive": true,
        "fixColumns": false,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: 'datacalon',
            type: "POST"
        },
        "columnDefs": [{
            "orderable": false,
            "targets": '_all'
        }],
        "bDestroy": true
    });
    const konsumen =  $('#tbl_laporan_konsumen').DataTable ({
        "processing": true,
        "responsive": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: 'datakonsumen',
            type: "POST"
        },
        "columnDefs": [{
            "orderable": false,
            "targets": '_all'
        }],
        "bDestroy": true
    });
    const kontrol =  dataTables("#tbl_kontrol","kartukontrol/datakontrol","");
    const pengeluaran =  dataTables("#tbl_laporan_pengeluaran","laporanpengeluaran/data","");
    const transaksi_unit =  dataTables("#tbl_transaksi_unit","laporantransaksi/data","");

    // Js For Konsumen and calon konsumen
    $("#tbl_laporan_konsumen").on("click",".btn-detail", function (e) {
        e.preventDefault();
        let id_konsumen = $(this).attr("data-id");
        let array = ["POST","modalkonsumen"];
        setAjax(array,{id_konsumen},function (response) {
            $("#modal_laporan_konsumen").modal("show");
            $.each(response.detail_kons, function (ix, value) { 
                if (value == null) {
                    value = "Kosong";
                }
                $("input[name='"+ix+"_detail']").val(value).attr("readonly",true);
            });
            if (response.sasaran != null) {
                $.each(response.sasaran, function (i, val) { 
                    $("input[name='detail"+val.id_sasaran+"']").attr("checked",true);
                });
            }
        });
    });
    $("#tbl_laporan_calon").on("click",".btn-detail", function (e) {
        e.preventDefault();
        let id_calon = $(this).attr("data-id");
        let array = ["POST","modalkonsumen"];
        setAjax(array,{id_calon},function (response) {
            $("#modal_laporan_calon").modal("show");
            $.each(response.detail_kons, function (ix, value) { 
                if (value == null) {
                    value = "Kosong";
                }
                $("input[name='"+ix+"_detail']").val(value).attr("readonly",true);
            });
        });
    });
    $("#tbl_laporan_konsumen").on("click","#prasyarat", function (e) {
        e.preventDefault();
        let params = $(this).attr("data-id");
        let array = ["GET","syaratkonsumen"];
        setAjax(array,{params},function (params) {
            let modal = $("#modal_laporan_konsumen #body_konsumen").html();
        })
    });
    // Lasst Js for Konsumen;

    // Js for Kartu Kontroll
    $("#detail_kontrol #tbl_detail_kontrol").on("click",".btn-detail",function (e) { 
        e.preventDefault();
        let id = $(this).attr("data-id");
        let array = ["post","datamodal"];
        let src;
        setAjax(array,{id},function (response) {
            if (response.success == true) {
                if (response.modal.id_jenis == 1) {
                    src = base+"assets/uploads/images/pembayaran/tanda_jadi/"+response.modal.bukti_bayar;
                }
                else if(response.modal.id_jenis == 2){
                    src = base+"assets/uploads/images/pembayaran/uang_muka/"+response.modal.bukti_bayar;
                }else{
                    src = base+"assets/uploads/images/pembayaran/cicilan/"+response.modal.bukti_bayar;
                }
                $("#modal_detail_kontrol").modal("show");
                $("#modal_detail_kontrol .user").text("Pembuat Bayar "+response.modal.tgl_bayar);
                $("#modal_detail_kontrol .tgl_bayar").text("Tanggal Bayar "+response.modal.tgl_bayar);
                $("#modal_detail_kontrol .tgl_tempo").text("Tanggal Tempo "+response.modal.tgl_jatuh_tempo);
                $("#modal_detail_kontrol .tgl_tempo").text("Tanggal Tempo "+response.modal.tgl_jatuh_tempo);
                $("#modal_detail_kontrol img").attr("src",src);
            }
        });
    });

    $("#view_kontrol #id_properti").change(function (e) { 
        e.preventDefault();
        let id_properti = $(this).val();
        let array = ["post","kartukontrol/getunit"]
        setAjax(array,{id_properti},function (response) {
            $("#id_unit").html(response.html);
        });
    });

    $("#view_kontrol #search_kontrol").on("click", function (e) {
        e.preventDefault();
        let id_properti = $("#view_kontrol #id_properti").val();
        let id_unit = $("#view_kontrol #id_unit").val();
        let tgl_mulai = $("#view_kontrol #id_mulai").val();
        let tgl_akhir = $("#view_kontrol #id_akhir").val();
        $("#view_kontrol #tbl_kontrol").DataTable().destroy();
        dataTables("#view_kontrol #tbl_kontrol","kartukontrol/datakontrol",{id_properti,id_unit,tgl_mulai,tgl_akhir});
    });
    // Last js for kartu kontrol

    // Js for Unit transaction report
    $("#laporan_transaksi #id_properti").change(function (e) { 
        e.preventDefault();
        let id_properti = $(this).val();
        let array = ["post","laporantransaksi/getunit"]
        setAjax(array,{id_properti},function (response) {
            $("#laporan_transaksi #id_unit").html(response.html);
        });
    });

    $("#laporan_transaksi #search_kontrol").on("click", function (e) {
        e.preventDefault();
        let id_properti = $("#laporan_transaksi #id_properti").val();
        let id_unit = $("#laporan_transaksi #id_unit").val();
        let tgl_mulai = $("#laporan_transaksi #id_mulai").val();
        let tgl_akhir = $("#laporan_transaksi #id_akhir").val();
        console.log(id_properti+"/"+id_unit);
        $("#laporan_transaksi #tbl_transaksi_unit").DataTable().destroy();
        dataTables("#laporan_transaksi #tbl_transaksi_unit","laporantransaksi/data",{id_properti,id_unit,tgl_mulai,tgl_akhir});
    });

    $("table#tbl_transaksi_unit").on("click",".btn-unlock",function (e) { 
        e.preventDefault();
        let id = $(this).attr("data-id");
        let ajax = ["POST","laporantransaksi/unlock"];
        swallQuestion("Tanyakan ","Apakah ingin di unlock ?","question","Unlock",function(){
            setAjax(ajax,{id},function (params) {
                if (params.success == true) {
                    swallSuccess("Berhasil","Data disimpan","success",function () {
                        location.reload();
                    })
                }
            })
        })
    });

    $("#laporan_view_unit #id_properti").change(function (e) { 
        e.preventDefault();
        let params1 = $(this).val();
        let array = ["get","getunit"]
        setAjax(array,{params1},function (response) {
            $("#laporan_view_unit #id_unit").html(response.html);
        });
    });

    $("#tbl_laporan_unit").on("click","#btn-edit", function (e) {
        e.preventDefault();
        let params = $(this).attr("data-id");
        let array = ["GET","laporanunit/getmodal"];
        setAjax(array,{params},function (response) {
            $.each(response.persyaratan, function (ix, value) { 
                $("#modal_laporan_unit #sasaran_"+value.id_sasaran+"").attr("checked",true);
            });
            $("input[name = 'input_hidden']").val(params);
            $("#modal_laporan_unit").modal("show");
        });
    });
    // End Js for unit transaksi
    // Js For Konsumen Report
    // End Js for Konsumen

    // Js for Laporan Pengeluaran
    $("#view_pengeluaran #search_kontrol").on("click", function (e) {
        e.preventDefault();
        let id_kelompok = $("#view_pengeluaran #id_kelompok").val();
        let tgl_mulai = $("#view_pengeluaran #id_mulai").val();
        let tgl_akhir = $("#view_pengeluaran #id_akhir").val();
        $("#view_pengeluaran #tbl_laporan_pengeluaran").DataTable().destroy();
        dataTables("#view_pengeluaran #tbl_laporan_pengeluaran","laporanpengeluaran/data",{id_kelompok,tgl_mulai,tgl_akhir});
    });
    // End Js For Laporan Konsumen
});
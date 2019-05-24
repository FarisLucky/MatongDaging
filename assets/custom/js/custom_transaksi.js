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
function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? rupiah : '');
}
$(document).ready(function () {
    // const konsumen = $('#select_konsumen').select2({
    //     placeholder: 'Pilih Konsumen',
    //     theme: "bootstrap"
    // });
    // const unit = $('#select_unit').select2({
    //     placeholder: 'Pilih Unit',
    //     theme: "bootstrap"
    // });
    $("#tbl_list_transaksi").DataTable();
    let tambah_form = 1;
    $("#tambah_form").click(function (e) { 
        e.preventDefault();
        let clone = $(".form-tambah:last").clone();
        $(clone).insertAfter(".form-tambah:last");
        return;
    });
    $(".form-clone").on("click","#hapus_form",function (e) { 
        e.preventDefault();
        if ($(".form-tambah").length > 1) {
            let total = 0;
            $(this).closest(".form-tambah").remove();
            $("input[name='txt_harga_tambah[]']").each(function() {
                total += Number($(this).val().split('.').join('')); 
            })
            $("#txt_total_tambahan").val(formatRupiah(String(total), 'Rp. '));
        }else{
            swallSuccess("Gagal", "Tidak dapat dihapus", "error","")
        }
        return;
    });
    $("#select_konsumen").change(function (e) { 
        e.preventDefault();
        let id = $(this).val();
        if (id == "") {
            $("#txt_card").val("");
            $("#txt_telp").val("");
            $("#txt_email").val("");
            $("#txt_alamat").val("");
        }else{
            $.ajax({
                type: "post",
                url: "datakonsumen",
                data: {
                    id_kons:id
                },
                dataType: "JSON",
                success: function (response) {
                    if (response.success == true) {
                        $("#txt_card").val(response.obj.id_card);
                        $("#txt_telp").val(response.obj.telp);
                        $("#txt_email").val(response.obj.email);
                        $("#txt_alamat").val(response.obj.alamat);
                    }
                }
            });
        }
    });
    $("#select_unit").change(function (e) { 
        e.preventDefault();
        let id = $(this).val(); 
        if (id == "") {
            $("#txt_properti").val("");
            $("#txt_type").val("");
            $("#txt_tanah").val("");
            $("#txt_bangunan").val("");
            $("#txt_harga").val("");
        }else{
            $.ajax({
                type: "post",
                url: "dataunit",
                data: {
                    id_unit:id
                },
                dataType: "JSON",
                success: function (response) {
                    $("#txt_properti").val(response.obj.nama_properti);
                    $("#txt_type").val(response.obj.type);
                    $("#txt_tanah").val(response.obj.luas_tanah);
                    $("#txt_bangunan").val(response.obj.luas_bangunan);
                    $("#txt_harga").val(response.harga);
                }
            });
        }
    });
    $("#periode_Um").change(function (e) { 
        e.preventDefault();
        let id = $(this).val();
        $(".angsuran_periode").remove();
        let form = '<div class="row angsuran_periode">';
        for (let index = 1; index <= id; index++) {
            form += '<div class="col-sm-3"><div class="form-group"><label for="txt_uang_muka">Angsuran '+index+'</label><input type="number" name="txt_angsuran[]" class="form-control txt_angsuran_change" required></div></div>';
        }
        form += '</div>';
        $(".periode_row").after(form);
    });
    $("#txt_type_pembayaran").change(function (e) { 
        e.preventDefault();
        let id = $(this).val();
        $(".val_periode").remove();
        let form="";
        // let form = '<div class="row">';
        if ((id == "1") || (id == "3")) {
            form += '<div class="col-sm-3 val_periode"><div class="form-group"><label for="periode_bayar">Periode Bayar(Bulan)</label><input type="number" name="periode_bayar" class="form-control" id="periode_bayar" required></div></div><div class="col-sm-3 val_periode"><div class="form-group"><label for="total_bayar_periode">Cicilan</label><input type="text" name="total_bayar_periode" class="form-control" id="total_bayar_periode" Readonly required></div></div>';
        }
        else if(id == "2"){
            form += '<div class="col-sm-3 val_periode"><div class="form-group"><label for="total_bayar_periode">Cicilan</label><input type="text" name="total_bayar_periode" class="form-control" id="total_bayar_periode" Readonly required></div></div>';
        }
        // form += '</div>';
        $(".bayar").after(form);
    });

    
    let kesepakatan = document.getElementById('txt_kesepakatan');
    let tanda_jadi = document.getElementById('txt_tanda_jadi');
    if (kesepakatan != null) {
		kesepakatan.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			kesepakatan.value = formatRupiah(this.value, 'Rp. ');
        });
    }
    if (tanda_jadi != null) {
		tanda_jadi.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			tanda_jadi.value = formatRupiah(this.value, 'Rp. ');
        });
    }
    $("#txt_kesepakatan").focusout(function (e) { 
        e.preventDefault();
        let harga;
        let kesepakatans = String($(this).val());
        // if (($("#select_unit").val() == "") || ($("#select_konsumen").val() == "")) {
        //     swallSuccess("Error", "Isi data diatas","error","")
        //     $(this).val("");
        //     return;
        // }
        $("#txt_ttl_transaksi,#txt_ttl_akhir").val(kesepakatans)
    });
    $(".btn-check").on("change",function (e) {
        e.preventDefault();
        let radio = $(this).val();
        let tanda_jadi = $("#txt_tanda_jadi").val();
        let parseTanda = parseInt(tanda_jadi.split('.').join(''));
        let hasil;
        let ttl_sementara = parseInt ($("#txt_ttl_transaksi").val().split('.').join(''));
        if (radio == "tidak_masuk_harga_jual") {
            hasil = ttl_sementara;
            $("#txt_ttl_akhir").val(formatRupiah(String(hasil), 'Rp. '));
            return;
        }
        else {
            hasil = parseInt(ttl_sementara - parseTanda);
            $("#txt_ttl_akhir").val(formatRupiah(String(hasil), 'Rp. '));
            return;
        }
    })
    // let angsuran = document.getElementById("form_transaksi");
    // let hello = $("input[name='txt_angsuran[]']").map(function() {
    //     return $(this).attr('id');
    // }).get()
    // console.log(hello);
    $("#txt_tanda_jadi").change(function (e) { 
        e.preventDefault();
        let radio = $("input[name='radio_tj']:checked");
        let hasil;
        let tanda_jadi = $(this).val();
        let parseTanda = parseInt(tanda_jadi.split('.').join(''));
        let ttl_sementara = parseInt ($("#txt_ttl_transaksi").val().split('.').join(''));
        if (radio.length > 0 ) {
            if (radio.val() == "masuk_harga_jual") {
                hasil = parseInt(ttl_sementara - parseTanda);
                $("#txt_ttl_akhir").val(formatRupiah(String(hasil), 'Rp. '));
                return;
            }
            else {
                hasil = ttl_sementara;
                $("#txt_ttl_akhir").val(formatRupiah(String(hasil), 'Rp. '));
                return;
            }
        }else{
            hasil = ttl_sementara;
            $("#txt_ttl_akhir").val(formatRupiah(String(hasil), 'Rp. '));
        }
    });
    $(document).on("focusout","input[name='txt_angsuran[]']",function () { 
        let total = 0;
        // let value = 
        $("input[name='txt_angsuran[]']").each(function() {
            total += Number($(this).val()); 
        })
        $("#txt_uang_muka").val(formatRupiah(String(total), 'Rp. '));
        let ttl = $("#txt_ttl_akhir").val().split('.').join('');
        let value = ttl - total;
        $("#txt_ttl_akhir").val(formatRupiah(String(value), 'Rp. '));
    });
    $(document).on("change","#periode_bayar",function (e) { 
        e.preventDefault();
        let ttl_akhir = parseInt($("#txt_ttl_akhir").val().split('.').join(''));
        let cicilan; 
        let value = parseInt($(this).val());
        cicilan = parseInt(ttl_akhir/value);
        $("#total_bayar_periode").val(formatRupiah(String(cicilan), 'Rp. '))

    });
    $(document).on("keyup","input[name='txt_harga_tambah[]']",function(e) {
        e.preventDefault();
        $(this).val(formatRupiah(this.value, 'Rp. '));
    })
    $(document).on("change","input[name='txt_harga_tambah[]']",function(e) {
        e.preventDefault();
        let total = 0;
        $("input[name='txt_harga_tambah[]']").each(function() {
            total += Number($(this).val().split('.').join('')); 
        })
        $("#txt_total_tambahan").val(formatRupiah(String(total), 'Rp. '));
    })
    $(".btn-kunci").click(function (e) { 
        e.preventDefault();
        let tambahan = $("#txt_kesepakatan").val();
        let split_tambahan = parseInt(tambahan.split('.').join(''));
        let transaksi = parseInt($("#txt_total_tambahan").val().split('.').join(''));
        let total = transaksi + split_tambahan;
        $("#txt_ttl_transaksi").val(formatRupiah(String(total), 'Rp. '));

    });
    
    // Submit Form
    $("#form_transaksi").on("submit",function (e) { 
        e.preventDefault();
        let form = $(this).serialize();
        $.ajax({
            type: "post",
            url: "inserttransaksi",
            data: form,
            dataType: "JSON",
            success: function (response) {
                if (response.success == true) {
                    $('input.form-group').removeClass('is-invalid').removeClass('is-valid');
                    swallSuccess("Sukses", "Berhasil ditambahkan", "success", function () {
                        location.reload();
                    })
                } else if ((response.success == false) && (response.error)) {
                    swallSuccess(response.title, response.text, response.type, function () {
                        window.location.href = url;
                    })
                } else {
                    $.each(response.msg, function (key, val) {
                        let el = $('#' + key)
                        el.removeClass('is-invalid')
                            .addClass(val.length > 0 ? 'is-invalid' : 'is-valid')
                            .next('.invalid-feedback').remove();
                        el.after(val);
                    });
                }
            }
        });
    });

    $("#form_ubah_transaksi").on("submit",function (e) { 
        e.preventDefault();
        let form = $(this).serialize();
        let url = $(this).attr("action");
        $.ajax({
            type: "post",
            url: url+"/core_ubah_transaksi",
            data: form,
            dataType: "JSON",
            success: function (response) {
                if (response.success == true) {
                    $('input.form-group').removeClass('is-invalid').removeClass('is-valid');
                    swallSuccess("Sukses", "Berhasil ditambahkan", "success", function () {
                        location.reload();
                    })
                } else if ((response.success == false) && (response.error)) {
                    swallSuccess(response.title, response.text, response.type, function () {
                        window.location.href = url;
                    })
                } else {
                    $.each(response.msg, function (key, val) {
                        let el = $('#' + key)
                        el.removeClass('is-invalid')
                            .addClass(val.length > 0 ? 'is-invalid' : 'is-valid')
                            .next('.invalid-feedback').remove();
                        el.after(val);
                    });
                }
            }
        });
    });

    $("#tbl_list_transaksi").on("click",".lock",function (e) { 
        e.preventDefault();
        $id = $(this).attr('data-id');
        Swal({
            title: "Kunci ?",
            text: "Apakah ingin dikunci ?",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: '#a55eea',
            cancelButtonColor: '#fed330',
            confirmButtonText: 'Lock !'
        }).then((result) => {
            if (result.value) {
                let id = $(this).attr('data-id');
                $.ajax({
                    type: "post",
                    url: "transaksi/lock",
                    data: {
                        id_transaksi: id
                    },
                    dataType: "JSON",
                    success: function (success) {
                        if (success.success == "false") {
                            swallSuccess("Gagal", "Gagal dikunci", "error", null);
                        } else {
                            swallSuccess("Berhasil", "Berhasil Dikunci", "success", function () {
                                location.reload();
                            });
                        }
                    }
                });
            }
        })
    });
});
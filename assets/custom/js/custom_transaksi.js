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
    $("#tbl_list_transaksi,#tbl_list_unlock").DataTable({
        "responsive" :true
    });
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
            $(".overlay").show();
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
                },
                complete: function(){
                    $('.overlay').hide();
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
            $(".overlay").show();
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
                },
                complete: function(){
                    $('.overlay').hide();
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
            form += '<div class="col-sm-3 val_periode"><div class="form-group"><label for="periode_bayar">Periode Bayar(Bulan)</label><input type="number" name="periode_bayar" class="form-control" id="periode_bayar" required></div></div><div class="col-sm-3 val_periode"></div>';
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
    $("#lock_kesepakatan").on("click",function (e) { 
        e.preventDefault();
        let harga;
        let kesepakatans = String($("#txt_kesepakatan").val());
        if ($("#txt_kesepakatan").val() == "") {
            toastr.remove()
            toastr.warning("masukkan Kesepakatan");
            $("#txt_kesepakatan").val("");
            return;
        }else if (($("#select_unit").val() == "") || ($("#select_konsumen").val() == "")) {
            toastr.warning("Isi Data diatas");
            return;
        }
        $("#txt_ttl_transaksi,#txt_ttl_akhir").val(kesepakatans);
        $("#txt_kesepakatan").attr("readonly",true);
        $(this).addClass("locked");
        $(this).attr("disabled",true);
    });
    $("#lock_tanda_jadi").on("click",function (e) { 
        e.preventDefault();
        let radio = $("input[name='radio_tj']:checked");
        let tanda_jadi = $("#txt_tanda_jadi").val();
        if ($("button.locked").length < 1) {
            toastr.remove()
            toastr.error("Kesepakatan belum di kunci");
            return false;
        }else if (tanda_jadi == "") {
            toastr.remove()
            toastr.warning("Masukkan Tanda Jadi");
            return false;
        }else if (radio.length < 1) {
            toastr.remove()
            toastr.warning("Pilih Tanda Jadi");
            return false;
        }
        let hasil;
        let parseTanda = parseInt(tanda_jadi.split('.').join(''));
        let ttl_sementara = parseInt ($("#txt_ttl_transaksi").val().split('.').join(''));
        if (radio.val() == "masuk_harga_jual") {
            hasil = parseInt(ttl_sementara - parseTanda);
            $("#txt_ttl_akhir").val(formatRupiah(String(hasil), 'Rp. '));
        }
        else {
            hasil = ttl_sementara;
            $("#txt_ttl_akhir").val(formatRupiah(String(hasil), 'Rp. '));
        }
        $(this).attr("disabled",true);
        $(this).addClass("locked_tanda_jadi");
        $("#txt_tanda_jadi").attr("readonly",true);
        $("input[name='radio_tj']").attr("disabled",true);
    });
    $("#lock_uang_muka").on("click",function () { 
        let total = 0;
        if (($("button.locked").length < 1) || ($("button.locked_tanda_jadi").length < 1)) {
            toastr.remove()
            toastr.error("Kesepakatan atau Tanda Jadi Belum di kunci");
            return false;
        }
        else if ($("input[name='txt_angsuran[]']").val() == "") {
            toastr.remove()
            toastr.warning("Masukkan Uang Muka");
            return false;
        }
        $("input[name='txt_angsuran[]']").each(function() {
            total += Number($(this).val()); 
        })
        $("#txt_uang_muka").val(formatRupiah(String(total), 'Rp. '));
        let ttl = $("#txt_ttl_akhir").val().split('.').join('');
        let value = ttl - total;
        $("#txt_ttl_akhir").val(formatRupiah(String(value), 'Rp. '));
        $("input[name='txt_angsuran[]']").attr("readonly",true);
        $(this).attr("disabled",true);
        $(this).addClass("locked_uang_muka");
    });
    $("#lock_type_bayar").on("click",function (e) { 
        e.preventDefault();
        let ttl_akhir = parseInt($("#txt_ttl_akhir").val().split('.').join(''));
        let cicilan; 
        let value = parseInt($("#periode_bayar").val());
        let type = $("#txt_type_pembayaran").val();
        if ($("button.locked_tanda_jadi").length < 1) {
            toastr.remove()
            toastr.error("Tanda Jadi belum di kunci");
            return false;
        }
        else if (type == "") {
            toastr.remove()
            toastr.warning("Pilih Type");
            return false;
        }
        if (type == "1" || type == "3") {
            cicilan = parseInt(ttl_akhir/value);
        }else if(type == "2"){
            cicilan = ttl_akhir;
        }
        $("#total_bayar_periode").val(formatRupiah(String(cicilan), 'Rp. '))
        $(this).attr("disabled",true);
        if ($(".locked_uang_muka").length < 1) {
            $("#lock_uang_muka").attr("disabled",true);
        }
        $(this).addClass("locked_type_bayar");
        $("#txt_type_pembayaran").attr("readonly",true);


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
        $(".overlay").show();
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
            },
            complete: function(){
                $('.overlay').hide();
            }
        });
    });

    $("#form_ubah_transaksi").on("submit",function (e) { 
        e.preventDefault();
        let form = $(this).serialize();
        let url = $(this).attr("action");
        $(".overlay").show();
        $.ajax({
            type: "post",
            url: url+"/core_ubah_transaksi",
            data: form,
            dataType: "JSON",
            success: function (response) {
                if (response.success == true) {
                    $('input.form-group').removeClass('is-invalid').removeClass('is-valid');
                    swallSuccess("Sukses", "Berhasil diubah", "success", function () {
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
            },
            complete: function(){
                $('.overlay').hide();
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
            confirmButtonColor: '#448aff',
            cancelButtonColor: '#ff4081',
            confirmButtonText: 'Lock !'
        }).then((result) => {
            if (result.value) {
                let id = $(this).attr('data-id');
                $(".overlay").show();
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
                    },
                    complete: function(){
                        $('.overlay').hide();
                    }
                });
            }
        })
    });
    $("#tbl_list_transaksi").on("click",".delete-transaksi",function (e) { 
        e.preventDefault();
        let href = $(this).attr('href');
        Swal({
            title: "Hapus ?",
            text: "Apakah ingin dihapus ?",
            type: "question",
            showCancelButton: true,
            confirmButtonColor: '#448aff',
            cancelButtonColor: '#ff4081',
            confirmButtonText: 'Hapus !'
        }).then((result) => {
            if (result.value) {
                $(".overlay").show();
                $.ajax({
                    type: "post",
                    url: href,
                    dataType: "JSON",
                    success: function (success) {
                        if (success.success == false) {
                            swallSuccess("Gagal", "Gagal dihapus", "error", null);
                        } else {
                            swallSuccess("Berhasil", "Berhasil Dihapus", "success", function () {
                                location.reload();
                            });
                        }
                    },
                    complete: function(){
                        $('.overlay').hide();
                    }
                });
            }
        })
    });

    $("#detail_unlock").click(function (e) {
        e.preventDefault();
        $("#modal_list_transaksi").modal("show");
    })
});
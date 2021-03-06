<div class="content-wrapper" id="detail_property">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-1">
                        <div class="row">
                            <div class="col-sm-4 p-4">
                                <h4 class="dark txt_title d-inline-block">Transaksi SPR</h4>
                            </div>
                            <div class="col-sm-4 pt-2">
                                <div class="form-group">
                                <label for="">No PPJB</label>
                                    <input type="text" class="form-control" name="txt_ppjb" id="txt_ppjb" value="<?= $transaksi->no_ppjb ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-4 p-4">
                                <?= $link ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="d-inline-block">Data Konsumen</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="select_konsumen">Pilih Konsumen</label>
                                    <input type="text" name="nama_konsumen" class="form-control" value="<?= $konsumen->nama_konsumen ?>" readonly>
                                </div>    
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="txt_card">Card</label>
                                    <input type="text" name="txt_card" class="form-control" value="<?= $konsumen->id_card ?>" readonly>
                                </div>        
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="txt_telp">Telp</label>
                                    <input type="text" name="txt_telp" class="form-control" value="<?= $konsumen->telp ?>" readonly>
                                </div> 
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="txt_email">Email</label>
                                    <textarea class="form-control" name="txt_email" rows="3" readonly><?= $konsumen->email ?></textarea>
                                </div>  
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="txt_alamat">Alamat</label>
                                    <textarea class="form-control" name="txt_alamat" rows="3" readonly><?= $konsumen->alamat ?></textarea>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="d-inline-block">Data Transaksi</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="select_unit">Pilih Unit</label>
                                    <input type="text" name="nama_unit" class="form-control" value="<?= $unit->nama_unit ?>" readonly>
                                </div>         
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_type">Type Unit</label>
                                    <input type="text" name="txt_type" class="form-control" value="<?= $unit->type ?>" disabled>
                                </div> 
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_bangunan">Luas Bangunan</label>
                                    <input type="text" name="txt_bangunan" class="form-control" value="<?= $unit->luas_bangunan ?>" disabled>
                                </div> 
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_bangunan">Luas Tanah</label>
                                    <input type="text" name="txt_tanah" class="form-control" value="<?= $unit->luas_tanah ?>" disabled>
                                </div> 
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_harga">Harga</label>
                                    <input type="text" name="txt_harga" class="form-control" id="txt_harga" value="<?= number_format($unit->harga_unit,2,',','.') ?>" disabled>
                                </div> 
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-end">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="txt_nama_tambah" class="col-sm-5 col-form-label f-29">Kesepakatan Harga</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="txt_kesepakatan" class="form-control" value="<?= $transaksi->total_kesepakatan ?>" readonly>
                                    <small class="form-text text-danger">* digunakan untuk mengecek total harga</small>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" id="clone_form">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="d-inline-block">Data Tambahan</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="form-clone">
                            <?php if (!empty($detail_transaksi)) {
                                foreach ($detail_transaksi as $key => $value) { ?> 
                            <div class="form-tambah">
                                <small class="tambah_txt">Penambahan</small>
                                <div class="row mt-2">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="txt_nama_tambah">Nama</label>
                                            <input type="text" name="txt_nama_tambah[]" class="form-control" value="<?= $value->penambahan ?>" readonly>
                                        </div>   
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="txt_volume_tambah">Volume</label>
                                            <input type="number" name="txt_volume_tambah[]" class="form-control" value="<?= $value->volume ?>" readonly>
                                        </div> 
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="txt_satuan_tambah">Satuan</label>
                                            <input type="text" name="txt_satuan_tambah[]" class="form-control" value="<?= $value->satuan ?>" readonly>
                                        </div> 
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="txt_harga_tambah">Harga per M2</label>
                                            <input type="text" name="txt_harga_tambah[]" class="form-control" value="<?= $value->harga ?>" readonly>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <?php } }else{ ?>
                            <h4 class="text-center">Tidak Ada Tambahan</h4>
                            <?php } ?>
                        </div>
                        <hr>
                        <div class="row justify-content-end">
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <label for="txt_total">Total Tambahan</label>
                                            <input type="text" name="txt_total_tambahan" class="form-control" value="<?= $transaksi->total_tambahan ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body" id="clone_form">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="d-inline-block">Total</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-2 periode_row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_tanda_jadi">Tanda Jadi</label>
                                    <input type="text" name="txt_tanda_jadi" class="form-control" value="<?= $transaksi->tanda_jadi ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_ttl_transaksi">Total Transaksi</label>
                                    <input type="text" name="txt_ttl_transaksi" class="form-control"value="<?= $transaksi->total_transaksi ?>" Readonly>
                                </div> 
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="periode_Um">Periode Uang Muka</label>
                                    <input type="text" name="ttl_periode" value="<?= $transaksi->periode_uang_muka ?>" class="form-control" readonly>
                                </div> 
                            </div>
                        </div>
                        <hr>
                        <div class="row justify-content-end">
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <div class="col-sm-7">
                                        <input type="text" name="txt_uang_muka" class="form-control" value="<?= $transaksi->uang_muka ?>" Readonly>
                                    </div>
                                    <label for="txt_uang_muka" class="col-sm-5 f-29 col-form-label">Uang Muka</label>
                                </div> 
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label f-29 border-left border-dark">Total Akhir</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="txt_ttl_akhir" class="form-control" value="<?= $transaksi->total_akhir ?>" Readonly>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="d-inline-block">Pembayaran dan Tanggal Penting</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="type_pembayaran">Type Pembayaran</label>
                                    <input type="text" class="form-control" value="<?= $transaksi->type_pembayaran ?>" readonly>
                                </div> 
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_type_pembayaran">Perkiraan Bayar Tanda Jadi</label>
                                    <input type="text" class="form-control" name="tgl_tanda_jadi" value="<?php $date = DateTime::createFromFormat("Y-m-d",$transaksi->tempo_tanda_jadi); echo tanggal($date->format("d"),$date->format("m"),$date->format("Y")) ?>" readonly>
                                    <small class="form-text text-danger">Bayar Setiap Tanggal <?= $date->format("d") ?></small>
                                </div> 
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_type_pembayaran">Perkiraan Bayar Uang Muka</label>
                                    <input type="text" class="form-control" name="tgl_uang_muka" value="<?php $date = DateTime::createFromFormat("Y-m-d",$transaksi->tempo_uang_muka); echo tanggal($date->format("d"),$date->format("m"),$date->format("Y")) ?>" readonly>
                                    <small class="form-text text-danger">Bayar Setiap Tanggal <?= $date->format("d") ?></small>
                                </div> 
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_type_pembayaran">Perkiraan Bayar Cicilan</label>
                                    <input type="text" class="form-control" name="tgl_pembayaran" value="<?php $date = DateTime::createFromFormat("Y-m-d",$transaksi->tempo_bayar); echo tanggal($date->format("d"),$date->format("m"),$date->format("Y")) ?>" readonly>
                                    <small class="form-text text-danger">Bayar Setiap Tanggal <?= $date->format("d") ?></small>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Tambah Data Pengeluaran</h4>
                                <img id="logo_perusahaan" width="50px" src="<?= base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="<?=base_url('pengeluaran/tambah_aksi') ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="exampleInputName1">nama_pengeluaran</label>
                                        <input type="text" name = "nama_pengeluaran" class="form-control" value="<?= set_value("nama_pengeluaran") ?>">
                                        <small class="text-small text-danger"><?= form_error("nama_pengeluaran") ?></small>
                                    </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">volume</label>
                                    <input type="number" name = "volume" class="form-control"value="<?= set_value("volume") ?>">
                                    <small class="text-small text-danger"><?= form_error("volume") ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">satuan</label>
                                    <input type="text" name = "satuan" class="form-control" value="<?= set_value("satuan") ?>">
                                    <small class="text-small text-danger"><?= form_error("satuan") ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">harga_satuan</label>
                                    <input type="number" name = "harga_satuan" class="form-control" value="<?= set_value("harga") ?>">
                                    <small class="text-small text-danger"><?= form_error("harga_satuan") ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="txt_file">Pilih Kelompok</label>
                                    <select name="kelompok" class="form-control">
                                        <option value="">-- Pilih Kelompok --</option>
                                        <?php foreach ($kelompok as $key => $value) { ?>
                                            <option value="<?= $value->id_kelompok ?>"><?= $value->nama_kelompok ?></option>
                                        <?php } ?>
                                    </select>
                                    <small class="text-small text-danger"><?= form_error("kelompok") ?></small>
                                </div>
                                <div class="form-group">
                                    <label for="txt_file">bukti_kwitansi</label>
                                    <input type="file" name = "bukti_kwitansi" class="form-control" >
                                    <small class="text-small text-danger"><?php echo ($error == "") ? "" : $error;  ?></small>
                                </div>
			                    <button type="submit" class="btn btn-sm btn-success float-right">Simpan</button>
			                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
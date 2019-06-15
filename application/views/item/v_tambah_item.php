<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Tambah Kelompok Item</h4>
                                <!-- <img id="logo_perusahaan" width="50px" src="<?= base_url().'assets/uploads/images/profil/user/'.$perusahaan[0]['logo_perusahaan'] ?>" class="float-right" alt=""> -->
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
                        <form action="<?php echo base_url(). 'item/tambah_aksi'; ?>" method="post">
                        <div class="row">
                            <div class="col-sm-6">
								<div class="form-group">
                                    <label for="item_name">nama_kelompok</label>
                                    <input type="text" name = "nama_kelompok" class="form-control" id="item_name" placeholder="">
                                    <small class="form-text text-danger"><?= form_error ('nama_kelompok'); ?></small>
                                    </div>
                                </div>
                            <div class="col-sm-6">
								<div class="form-group">
                                    <label for="item_name">nama_kelompok</label>
                                    <select name="select_kategori" class="form-control">
                                        <option value="">-- Pilih Kategori Kelompok</option>
                                        <?php foreach ($kategori as $key => $value) : ?>
                                        <option value="<?= $value->id_kategori ?>"><?= $value->nama_kategori ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text text-danger"><?= form_error ('select_kategori'); ?></small>
								</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
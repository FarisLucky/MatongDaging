<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Follow Calon Konsumen</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="d-inline-block">Edit Follow Calon Konsumen</h5>
                            </div>
                        </div>
                        <hr>
                        <form method="post" action="<?= base_url() ?>follow_calon_konsumen/corePerbarui" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="edit_id_follow" value="<?= $follow_calon_konsumen['id_follow']; ?>"><!-- itu hidden buat nnt ngirim id nya jd di view nya ga keliatan-->
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label>Pilih Nama Calon Konsumen</label>
                                                <select name="edit_nama_konsumen" id="input_calon_konsumen" value="<?= $follow_calon_konsumen['id_konsumen']; ?>" class="form-control <?= form_error('edit_nama_konsumen') ? 'is-invalid' : '' ?>">
                                                    <?php
                                                    foreach ($konsumen as  $value) {
                                                        ?>
                                                        <option value="<?= $value['id_konsumen'] ?>" <?= $value['id_konsumen'] == $follow_calon_konsumen['id_konsumen'] ? 'selected' : '' ?>><?= $value['nama_lengkap'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('edit_nama_konsumen') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label for="input_media">Media</label>
                                                <select name="edit_media" id="input_media" value="" class="form-control <?= form_error('edit_media') ? 'is-invalid' : '' ?>">
                                                    <?php foreach ($media as $m) : ?>
                                                        <?php if ($m == $follow_calon_konsumen['media']) : ?>
                                                            <option value="<?= $m ?>" selected><?= $m ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $m ?>"><?= $m ?></option>
                                                        <?php endif ?>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('edit_media') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label for="input_keterangan">Keterangan</label>
                                                <input type="text" class="form-control <?= form_error('edit_keterangan') ? 'is-invalid' : '' ?>" id="input_keterangan" name="edit_keterangan" value="<?= $follow_calon_konsumen['keterangan']; ?>">
                                                <div>
                                                    <?php echo form_error('edit_keterangan') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-label-group">
                                                <label for="input_hasil">Hasil</label>
                                                <select name='edit_hasil' id="input_hasil" value="" class="form-control <?= form_error('edit_hasil') ? 'is-invalid' : '' ?>">
                                                    <?php foreach ($hasil as $h) : ?>
                                                        <?php if ($h == $follow_calon_konsumen['hasil']) : ?>
                                                            <option value="<?= $h ?>" selected><?= $h ?></option>
                                                        <?php else : ?>
                                                            <option value="<?= $h ?>"><?= $h ?></option>
                                                        <?php endif ?>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('edit_hasil') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" id="btn_simpan_properti" class="btn btn-success mr-2">Simpan</button>
                                        <a href="<?= base_url() ?>follow_calon_konsumen" class="btn btn-dark mr-2" btn-sm float-right">Batal</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
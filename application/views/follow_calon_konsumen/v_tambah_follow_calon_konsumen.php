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
                                <h5 class="d-inline-block">Tambah Follow Calon Konsumen</h5>
                            </div>
                        </div>
                        <hr>
                        <form action="<?php echo base_url() . 'followcalonkonsumen/tambah_data'; ?>" method="post">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Pilih Nama Calon Konsumen</label>
                                                <input type="text" name="val_nama_konsumen" id="input_calon_konsumen" class="form-control" placeholder="Pilih Konsumen ">
                                                <!-- <select name="val_nama_konsumen" id="input_calon_konsumen" class="form-control <?= form_error('val_nama_konsumen') ? 'is-invalid' : '' ?>">
                                                    <option value="">-- Pilih --</option>
                                                    <?php
                                                    foreach ($id_konsumen as  $value) {
                                                        ?>
                                                        <option value="<?= $value['id_konsumen'] ?>"><?= $value['nama_lengkap'] ?></option>
                                                    <?php } ?>
                                                </select> -->
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('val_nama_konsumen') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="input_media">Media</label>
                                                <select name="val_media" id="input_media" class="form-control <?= form_error('val_media') ? 'is-invalid' : '' ?>">
                                                    <option value="">-- Pilih Media --</option>
                                                    <option value="Whatsapp" <?= set_value('val_media') == 'Whatsapp' ? 'selected' : '' ?>>Whatsapp</option>
                                                    <option value="Facebook" <?= set_value('val_media') == 'Facebook' ? 'selected' : '' ?>>Facebook</option>
                                                    <option value="Instagram" <?= set_value('val_media') == 'Instagram' ? 'selected' : '' ?>>Instagram</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('val_media') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="input_keterangan">Keterangan</label>
                                                <textarea type="text" id="input_keterangan" name="val_keterangan" value="<?= set_value('val_keterangan') ?>" placeholder="Masukan Keterangan" class="form-control <?= form_error('val_keterangan') ? 'is-invalid' : '' ?> " rows="5"></textarea>
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('val_keterangan') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="input_hasil">Hasil</label>
                                                <select name='val_hasil' id="input_hasil" class="form-control <?= form_error('val_hasil') ? 'is-invalid' : '' ?>">
                                                    <option value="">-- Pilih Hasil --</option>
                                                    <option value="d" <?= set_value('val_hasil') == 'd' ? 'selected' : '' ?>>Deal</option>
                                                    <option value="bd" <?= set_value('val_hasil') == 'bd' ? 'selected' : '' ?>>Belum Deal</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('val_hasil') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" id="btn_simpan_follow" class="btn btn-success mr-2">Simpan</button>
                                    <a href="<?= base_url() ?>followcalonkonsumen" class="btn btn-dark mr-2">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_follow_konsumen" aria-hidden="true">
    <div class="modal-dialog" >
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" >Pilih Konsumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="row justify-content-end">
                <div class="col-sm-5">
                    <label class="modal-title">Cari Nama</label>
                    <input type="text" class="form-control" name="cari_nama">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Nama Calon</td>
                                <td>npwp</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($id_konsumen as $key => $value) { ?>
                                <tr>
                                    <td><?= $value["nama_lengkap"] ?></td>
                                    <td><?= $value["npwp"] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
    </div>
</div>
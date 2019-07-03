<div class="content-wrapper">
<div class="container">
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Tambah Calon Konsumen</h4>
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
                    </div>
                </div>
                <form action="<?php echo base_url() . 'konsumen/tambah_data'; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label>Pilih Type ID Card</label>
                                    <select name="val_id_type" id="" class="form-control <?= form_error('val_id_card') ? 'is-invalid' : '' ?>">
                                        <option value="">-- Pilih --</option>
                                        <?php
                                        foreach ($id_type as  $value) {
                                            ?>
                                            <option value="<?= $value['id_type'] ?>"><?= $value['nama_type'] ?></option>
                                        <?php
                                    }
                                    ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('val_id_type') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label for="inpt_id_card">ID Card</label>
                                    <input type="text" id="inpt_id_card" name="val_id_card" value="<?= set_value('val_id_card') ?>" placeholder="Masukan ID Card" class="form-control <?= form_error('val_id_card') ? 'is-invalid' : '' ?> ">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('val_id_card') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label for="inpt_nama_konsumen">Nama Konsumen</label>
                                    <input type="text" id="inpt_nama_konsumen" name="val_nama_konsumen" value="<?= set_value('val_nama_konsumen') ?>" placeholder="Masukan Nama Konsumen" class="form-control <?= form_error('val_nama_konsumen') ? 'is-invalid' : '' ?> ">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('val_nama_konsumen') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label for="inpt_alamat">Alamat</label>
                                    <textarea type="text" id="inpt_alamat" name="val_alamat" placeholder="Masukan Alamat" class="form-control <?= form_error('val_alamat') ? 'is-invalid' : '' ?> "><?= set_value('val_alamat') ?></textarea>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('val_alamat') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label for="inpt_nomor_telepon">Nomor Telepon</label>
                                    <input type="text" id="inpt_nomor_telepon" name="val_nomor_telepon" value="<?= set_value('val_nomor_telepon') ?>" placeholder="Masukan Nomor Telepon" class="form-control <?= form_error('val_nomor_telepon') ? 'is-invalid' : '' ?> ">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('val_nomor_telepon') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label for="inpt_email">Email</label>
                                    <input type="text" id="inpt_email" name="val_email" value="<?= set_value('val_email') ?>" placeholder="Masukan Alamat Email" class="form-control <?= form_error('val_email') ? 'is-invalid' : '' ?> ">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('val_email') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label for="inpt_npwp">Npwp</label>
                                    <input type="text" id="inpt_npwp" name="val_npwp" value="<?= set_value('val_npwp') ?>" placeholder="Masukan NPWP" class="form-control <?= form_error('val_npwp') ? 'is-invalid' : '' ?> ">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('val_npwp') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label for="inpt_pekerjaan">Pekerjaan</label>
                                    <input type="text" id="inpt_pekerjaan" name="val_pekerjaan" value="<?= set_value('val_pekerjaan') ?>" placeholder="Masukan Apa Pekerjaan Anda" class="form-control <?= form_error('val_pekerjaan') ? 'is-invalid' : '' ?> ">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('val_pekerjaan') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label for="inpt_alamat_kantor">Alamat Kantor</label>
                                    <textarea type="text" id="inpt_alamat_kantor" name="val_alamat_kantor" placeholder="Masukan Alamat Kantor Anda " class="form-control <?= form_error('val_alamat_kantor') ? 'is-invalid' : '' ?> "><?= set_value('val_alamat_kantor') ?></textarea>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('val_alamat_kantor') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-label-group">
                                    <label for="inpt_telepon_kantor">Telepon Kantor</label>
                                    <input type="text" id="inpt_telepon_kantor" name="val_telepon_kantor" value="<?= set_value('val_telepon_kantor') ?>" placeholder="Masukkan Nomor telepon kantor Anda" class="form-control <?= form_error('val_telepon_kantor') ? 'is-invalid' : '' ?> ">
                                    <div class="invalid-feedback">
                                        <?php echo form_error('val_telepon_kantor') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- foto -->
                    <div class="form-group">
                        <label for="name">Foto Ktp</label>
                        <input class="form-control-file form-control <?php echo form_error('price') ? 'is-invalid' : '' ?>" type="file" name="val_foto">
                        <div class="invalid-feedback">
                            <?php echo form_error('image') ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <a href="<?php echo base_url('konsumen/calonkonsumen') ?>" class="btn btn-dark btn-fw"></i> Cancel</a>
                    </div>
            </div>
            </form>
            <div>
            </div>
        </div>
    </div>
    </div>
</div>
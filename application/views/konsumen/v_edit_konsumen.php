<div class="content-wrapper">
<div class="container">
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Edit Konsumen</h4>
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
                <form method="post" action="<?= base_url() ?>konsumen/corePerbarui" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="edit_id_konsumen" value="<?= $konsumen[0]['id_konsumen'] ?>">

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label>Pilih Type ID Card</label>
                                        <select name="edit_id_type" id="" class="form-control">
                                            <option value="">-- Pilih --</option>
                                            <?php
                                            foreach ($id_type as  $value) {
                                                ?>
                                                <option value="<?= $value['id_type'] ?>" <?= $konsumen[0]['id_type'] == $value['id_type'] ? 'selected' : '' ?>><?= $value['nama_type'] ?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_idcard">Id Card</label>
                                        <input type="text" class="form-control" id="input_idcard" name="edit_id_card" value="<?= $konsumen[0]['id_card'] ?>" placeholder="Masukan Id Card" required><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_nama">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="input_nama" name="edit_nama" value="<?= $konsumen[0]['nama_lengkap'] ?>" placeholder="Masukan Nama Lengkap" required><br>
                                        <!--$konsumen diatas itu harus sama kayak yang di controller, di $data yang di deklarasikan, lalu ['nama_lengkap'] itu merupakan field yang ada pada database, supaya dia bisa dapat datanya dari field nama_lengkap -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_alamat">Alamat</label>
                                        <input type="text" class="form-control" id="input_alamat" name="edit_alamat" value="<?= $konsumen[0]['alamat'] ?>" placeholder="Masukan Alamat" required><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_telepon">No Telepon</label>
                                        <input type="text" class="form-control" id="input_telepon" name="edit_telepon" value="<?= $konsumen[0]['telp'] ?>" placeholder="Masukan Nomer Telepon" required><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_email">Email</label>
                                        <input type="text" class="form-control" id="input_email" name="edit_email" value="<?= $konsumen[0]['email'] ?>" placeholder="Masukan Email" required><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_npwp">NPWP</label>
                                        <input type="text" class="form-control" id="input_npwp" name="edit_npwp" value="<?= $konsumen[0]['npwp'] ?>" placeholder="Masukan NPWP" required><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_pekerjaan">Pekerjaan</label>
                                        <input type="text" class="form-control" id="input_pekerjaan" name="edit_pekerjaan" value="<?= $konsumen[0]['pekerjaan'] ?>" placeholder="Masukan Pekerjaan" required><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_alamatkantor">Alamat Kantor</label>
                                        <input type="text" class="form-control" id="input_alamatkantor" name="edit_alamat_kantor" value="<?= $konsumen[0]['alamat_kantor'] ?>" placeholder="Masukan Alamat Kantor" required><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_tlpkantor">Telepon Kantor</label>
                                        <input type="text" class="form-control" id="input_telpkantor" name="edit_telp_kantor" value="<?= $konsumen[0]['telp_kantor'] ?>" placeholder="Masukan Telepon Kantor" required><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="<?= base_url()."assets/uploads/images/konsumen/".$konsumen[0]['foto_ktp'] ?>" width="200px" alt="">
                                <input type="file" class="form-control col-sm-6" name="img_foto">
                            </div>
                        </div>

                        <!-- foto-->
                    </div>
                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
                <div>
                </div>
            </div>
        </div>
    </div>
</div>
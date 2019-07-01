<div class="content-wrapper" id="detail_konsumen">
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
                <form method="post" action="<?= base_url('laporankonsumen/coreedit') ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="edit_id_konsumen" value="<?= $konsumen[0]['id_konsumen'] ?>">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label>Pilih Type ID Card</label>
                                        <select name="detail_id_type" id="" class="form-control" >
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
                                        <input type="text" class="form-control" id="input_idcard" name="detail_id_card" value="<?= $konsumen[0]['id_card'] ?>" placeholder="Masukan Id Card" required ><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_nama">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="input_nama" name="detail_nama" value="<?= $konsumen[0]['nama_lengkap'] ?>" placeholder="Masukan Nama Lengkap" required >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_alamat">Alamat</label>
                                        <textarea type="text" class="form-control" id="input_alamat" name="detail_alamat" rows="3" placeholder="Masukan Alamat" required ><?= $konsumen[0]['alamat'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_telepon">No Telepon</label>
                                        <input type="text" class="form-control" id="input_telepon" name="detail_telepon" value="<?= $konsumen[0]['telp'] ?>" placeholder="Masukan Nomer Telepon" required ><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_email">Email</label>
                                        <input type="text" class="form-control" id="input_email" name="detail_email" value="<?= $konsumen[0]['email'] ?>" placeholder="Masukan Email" required ><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_npwp">NPWP</label>
                                        <input type="text" class="form-control" id="input_npwp" name="detail_npwp" value="<?= $konsumen[0]['npwp'] ?>" placeholder="Masukan NPWP" required ><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_pekerjaan">Pekerjaan</label>
                                        <input type="text" class="form-control" id="input_pekerjaan" name="detail_pekerjaan" value="<?= $konsumen[0]['pekerjaan'] ?>" placeholder="Masukan Pekerjaan" required ><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_alamatkantor">Alamat Kantor</label>
                                        <textarea type="text" class="form-control" id="input_alamatkantor" name="detail_alamat_kantor" rows="3" placeholder="Masukan Alamat Kantor" required > <?= $konsumen[0]['alamat_kantor'] ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label for="input_tlpkantor">Telepon Kantor</label>
                                        <input type="text" class="form-control" id="input_telpkantor" name="detail_telp_kantor" value="<?= $konsumen[0]['telp_kantor'] ?>" placeholder="Masukan Telepon Kantor" required ><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label for="">Foto</label>
                                <?php $foto = base_url()."assets/uploads/images/konsumen/".$konsumen[0]['foto_ktp'];  ?>
                                <img src="<?= $foto ?>" width="160px" alt="" class="m-2">
                                <input type="file" class="form-control" name="foto_konsumen">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <?php foreach ($persyaratan as $key => $value) { 
                                $checked ="";
                                foreach ($check_syarat as $key1 => $value1) {
                                    if ($value['id_sasaran'] == $value1['id_sasaran']) {
                                        $checked = "checked";
                                    }
                                }?>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="persyaratan[]" class="form-check-input" value="<?= $value['id_sasaran'] ?>" <?= $checked ?>> <?= $value['nama_persyaratan']."  ".$value['poin_penting'] ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <a href="<?= site_url("laporankonsumen/konsumen") ?>" class="btn btn-dark">Cancel</a>
                    </div>
                </form>
                <div>
                </div>
            </div>
        </div>
    </div>
</div>
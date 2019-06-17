<div class="content-wrapper">
<div class="container">
    <div class="card">
        <div class="card-body p-4">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="dark txt_title d-inline-block mt-2">Data Konsumen</h4>
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
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label>Type Id Card</label>
                                            <input type="text" id="id_card" class="form-control" value="<?= $konsumen['nama_type'].' '.$konsumen['id_card']?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label for="input_nama">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="input_nama" name="edit_nama" value="<?= $konsumen['nama_konsumen'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label for="input_alamat">Alamat</label>
                                            <textarea type="text" class="form-control" id="input_alamat" name="edit_alamat" rows="3"><?= $konsumen['alamat'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label for="input_telepon">No Telepon</label>
                                            <input type="text" class="form-control" id="input_telepon" name="edit_telepon" value="<?= $konsumen['telp'] ?>"><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label for="input_email">Email</label>
                                            <input type="text" class="form-control" id="input_email" name="edit_email" value="<?= $konsumen['email'] ?>"><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label for="input_npwp">NPWP</label>
                                            <input type="text" class="form-control" id="input_npwp" name="edit_npwp" value="<?= $konsumen['npwp'] ?>"><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label for="input_pekerjaan">Pekerjaan</label>
                                            <input type="text" class="form-control" id="input_pekerjaan" name="edit_pekerjaan" value="<?= $konsumen['pekerjaan'] ?>" placeholder="Masukan Pekerjaan" required><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label for="input_alamatkantor">Alamat Kantor</label>
                                            <textarea type="text" class="form-control" id="input_alamatkantor" name="edit_alamat_kantor" rows="3" > <?= $konsumen['alamat_kantor'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label for="input_tlpkantor">Telepon Kantor</label>
                                            <input type="text" class="form-control" id="input_telpkantor" name="edit_telp_kantor" value="<?= $konsumen['telp_kantor'] ?>" placeholder="Masukan Telepon Kantor" required><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <img src="<?= base_url()."assets/uploads/images/konsumen/".$konsumen['foto_ktp'] ?>" width="200px" alt="">
                                    <input type="file" class="form-control col-sm-6" name="img_foto">
                                </div>
                            </div>
                            <!-- foto-->
                        </div>
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <a href="<?= site_url("konsumen/calonkonsumen") ?>" class="btn btn-light">Cancel</a>
                    </form>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
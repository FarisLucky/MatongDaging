<div class="content-wrapper" id="detail_user_content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Kelola User</h4>
                                <img id="logo_perusahaan" width="50px" src="<?= base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right" alt="">
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
                                <h5 class="d-inline-block">Tambah User</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <form id="form_user" action="#" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_nama">Nama</label>
                                                <input type="text" name="txt_nama_user" class="form-control" id="txt_nama_user">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Jenis Kelamin</label>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-radio">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="radio_jk" id="radio1" value="laki-laki">Laki Laki
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-radio">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="custom-control-input" name="radio_jk" id="radio2" value="perempuan">Perempuan
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_file">Photo</label>
                                                <input type="file" name="txt_foto_user" id="txt_foto_user" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_alamat_user">Alamat</label>
                                                <textarea class="form-control" name="txt_alamat_user" id="txt_alamat_user" rows="3"></textarea>
                                            </div> 
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_telp_user">Telp</label>
                                                <input type="number" name="txt_telp_user" class="form-control" id="txt_telp_user">
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_email_user">Email</label>
                                                <input type="text" name='txt_email_user' class="form-control" id="txt_email_user">
                                            </div>
                                            <div class="form-group mt-34">
                                                <label for="txt_akses_user">Akses</label>
                                                <select name="txt_akses_user" id="txt_akses_user" class="form-control">
                                                    <option value="">-- Pilih Akses --</option>
                                                    <?php foreach ($akses as $key => $value) : ?>
                                                        <option value="<?= $value->id_akses ?>"><?= $value->akses ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group mt-34">
                                                <label for="txt_status_user">Status</label>
                                                <select name="txt_status_user" id="txt_status_user" class="form-control">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="aktif">Aktif</option>
                                                    <option value="nonaktif">Nonaktif</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_username_user">Username</label>
                                                <input type="text" name="txt_username_user" class="form-control" id="txt_username_user">
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_username_user">Password</label>
                                                <input type="password" name="txt_password_user" class="form-control" id="txt_password_user"><div class="mt-1"></div><div class="d-flex flex-row"><input type="checkbox" class="float-left mr-1" name="show_pw" id="show_pw"><label for="show_pw">show Password</label></div>
                                            </div>
                                            <div class="form-group mt-34">
                                                <label for="txt_username_user">Retype Password</label>
                                                <input type="password" name="txt_retype_password" class="form-control" id="txt_retype_password"><div class="mt-1"></div><div class="d-flex flex-row"><input type="checkbox" class="float-left mt-1 mr-1" name="show_pw2" id="show_pw2"><label for="show_pw2">show Password</label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?= base_url() ?>kelola_users" id="batal" class="btn btn-sm btn-dark float-right">Batal</a>
                                            <button type="submit" class="btn btn-sm btn-success float-right mr-2">Simpan</button>
                                        </div>
                                    </div>
                                </form>                                  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
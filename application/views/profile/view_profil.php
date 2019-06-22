<div class="content-wrapper" id="detail_user_content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Profile User</h4>
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
                                <a href="<?= base_url('dashboard') ?>" class="float-right"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                            </div>
                        </div>
                        <hr>
                        <form action="<?= base_url('profileuser/coreupdateuser') ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="txt_nama">Nama</label>
                                                <input type="text" name="txt_nama" class="form-control" id="txt_nama" value="<?= $user->nama_lengkap ?>">
                                                <small class="text-danger"><?php echo form_error('txt_nama') ?></small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="txt_username">Username</label>
                                                <input type="text" name="txt_username" class="form-control" id="txt_username" value="<?= $user->username ?>">
                                                <small class="text-danger"><?php echo form_error('txt_username') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="txt_telp">Telp</label>
                                                <input type="number" name="txt_telp" class="form-control" id="txt_telp" value="<?= $user->no_hp ?>">
                                                <small class="text-danger"><?php echo form_error('txt_telp') ?></small>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="txt_email">Email</label>
                                                <input type="text" name='txt_email' class="form-control" id="txt_email" value="<?= $user->Email ?>">
                                                <small class="text-danger"><?php echo form_error('txt_email') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Jenis Kelamin</label>
                                                <div class="row">
                                                    <?php if ($user->jenis_kelamin == "laki-laki") { ?>
                                                    <div class="col-sm-6">
                                                        <div class="form-radio">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="txt_jk" id="rj2" value="laki-laki" checked>Laki Laki
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-radio">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="custom-control-input" name="txt_jk" id="rj1" value="perempuan">Perempuan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php }else{ ?>
                                                    <div class="col-sm-6">
                                                        <div class="form-radio">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="form-check-input" name="txt_jk" id="rj" value="laki-laki">Laki Laki
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-radio">
                                                            <label class="form-check-label">
                                                                <input type="radio" class="custom-control-input" name="txt_jk" id="rj1" value="perempuan" checked>Perempuan
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <?php } ?> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-center">
                                            <small class="txt-normal mb-3 d-block">Status Akun</small>
                                            <small class="badge badge-primary px-3"><?= $user->status_user ?></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="txt_alamat">Alamat</label>
                                                <textarea class="form-control" name="txt_alamat" id="txt_alamat" rows="3"><?= $user->alamat ?></textarea>
                                                <small class="text-danger"><?php echo form_error('txt_alamat') ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <small class="txt-normal ml-3 d-block">Photo User</small>
                                    <img src="<?php echo base_url('assets/uploads/images/profil/user/'.$user->foto_user) ?>" class="img-thumbnail" style="width:100%;max-height:300px;">
                                    <input type="file" name="upload" class="form-control mt-4">
                                    <small class="text-danger"><?php echo $error; ?></small>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-sm btn-success mx-2">Simpan</button>
                                </div>
                            </div>
                        </form>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
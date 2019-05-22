<div class="content-wrapper" id="detail_user_content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Detail RAB</h4>
                                <!-- <img id="logo_perusahaan" width="50px" src="<?= base_url().'assets/uploads/images/profil/user/'.$perusahaan[0]['logo_perusahaan'] ?>" class="float-right" alt=""> -->
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
                                <h5 class="d-inline-block">Detail RAB</h5>
                                <div class="badge badge-primary float-right">Marketing</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <form id="form_detail" action="#" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txti_nama">Nama</label>
                                                <input type="text" name="txt_nama" class="form-control" id="txt_nama_user" value="<?php echo $users->nama_lengkap;?>" disabled>
                                            </div>
                                            <div class="form-group">
                                            <label class="col-form-label">Jenis Kelamin</label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-radio form-radio-flat">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios1" value="" <?php echo(($users->jenis_kelamin == "laki-laki") ? $check="checked":$check="" )?> disabled>Laki - Laki
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-radio form-radio-flat">
                                                        <label class="form-check-label">
                                                            <input type="radio" class="form-check-input" name="membershipRadios" id="membershipRadios2" value="option2" <?php echo(($users->jenis_kelamin == "perempuan") ? $check="checked":$check="" )?> disabled>Perempuan
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_telp_user">Telp</label>
                                                <input type="number" name="txt_telp" class="form-control" id="txt_telp_user" value="<?= $users->no_hp;?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_alamat_user">Alamat</label>
                                                <textarea class="form-control" name="txt_alamat" id="txt_alamat_user" rows="3" disabled><?= $users->alamat;?></textarea>
                                            </div> 
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_username_user">Username</label>
                                                <input type="text" name="txt_username" class="form-control" id="txt_username_user" value="<?= $users->username;?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_email_user">Email</label>
                                                <input type="text" name='txt_email' class="form-control" id="txt_email_user" value="<?= $users->Email;?>"disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="<?= base_url() ?>assets/images/faces/face1.jpg">
                                        </div>
                                    </div>
                                </form>                                  
                            </div>
                        </div>
                        <hr>
                        <form id="form_user_properti" action="<?= base_url() ?>setting/userproperti" method="post" >
                        <input type="hidden" name="txt_id" id="hidden_user" value="<?= $users->id_user ?>">
                        <div class="row">
                            <?php foreach ($properti as $key => $value) : ?>
                                <div class="col-sm-3">
                                    <img src="<?= base_url() ?>assets/uploads/images/profil/user/try.png" alt="" class="img-rounded img-properti">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="form-check form-check-flat">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" name="membershipRadios" id="properti" data-id="<?= $value->id_properti ?>" value="" <?php ($user_properti != null) ? ($value->id_properti == $user_properti->id_properti) ? $check = "checked":$check = "":$check=""; echo $check ?>><?php echo $value->nama_properti ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button class="btn btn-sm btn-primary mr-2">Simpan</button>
                                <a href="<?= base_url() ?>setting/user" class="btn btn-sm btn-dark">Back</a>
                            </div>  
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
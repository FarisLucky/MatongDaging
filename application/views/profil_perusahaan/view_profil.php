<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Setting Perusahaan</h4>
                                <img id="logo_perusahaan" width="50px" src="<?php echo base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right" alt="">
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
                                <h5><i class="fa fa-m"></i>Kelola Perusahaan</h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <form id="form_perusahaan" action="<?= base_url() ?>profilperusahaan/update" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="txt_id" value="<?php $id = $perusahaan[0]['id_perusahaan']; echo $this->encryption->encrypt($id); ?>">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="txti_siup">SIUP</label>
                                                <input type="text" name="txt_siup" class="form-control" id="txt_siup" value="<?= $perusahaan[0]['siup'] ?>" placeholder="SIUP" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="txti_tdp">TDP</label>
                                                <input type="text" name="txt_tdp" class="form-control" id="txt_tdp" value="<?= $perusahaan[0]['tanda_daftar_perusahaan'] ?>" placeholder="Tanda Daftar Perusahan" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="txti_namaperusahaan">Nama Perusahaan</label>
                                                <input type="text" name="txt_namaperusahaan" class="form-control" id="txt_namaperusahaan" value="<?= $perusahaan[0]['nama'] ?>" placeholder="Nama Perusahaan" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="txti_email">Email</label>
                                                <input type="text" name='txt_email' class="form-control" id="txt_email" value="<?= $perusahaan[0]['email'] ?>" placeholder="Password" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="txti_telp">Telp</label>
                                                <input type="number" name="txt_telp" class="form-control" id="txt_telp" value="<?= $perusahaan[0]['telepon'] ?>" placeholder="Telepon" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_alamat">Alamat</label>
                                                <textarea class="form-control" name="txt_alamat" id="txt_alamat" rows="3" disabled><?= $perusahaan[0]['alamat'] ?></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Logo</label>
                                                        <img id="logo_perusahaan" width="150px" src="<?= base_url().'assets/uploads/images/properti/'.$perusahaan[0]['logo_perusahaan'] ?>" alt="" >
                                                    </div> 
                                                </div>
                                            </div>  
                                                <button type="button" id="btn_ubah_profil" class="btn btn-outline-info mr-2 float-right">ubah</button>
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
<div class="content-wrapper" id="detail_property">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Kelola Properti</h4>
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
                                <h5 class="d-inline-block">Detail Properti</h5>
                                <a href="<?= base_url() ?>properti" class="btn btn-dark mr-2 float-right"><i class="fa fa-arrow-circle-left"></i>Kembali</a>
                            </div>
                        </div>
                        <hr>
                        <form id="form_detail" action="<?= base_url() ?>properti/update" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" name="txt_id" value="<?= $properti->id_properti ?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="txti_nama">Nama Properti</label>
                                                <input type="text" name="txt_nama" class="form-control" id="txt_nama" value="<?php echo $properti->nama_properti;?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_alamat">Alamat</label>
                                                <textarea class="form-control" name="txt_alamat" id="txt_alamat" rows="3" disabled><?= $properti->alamat;?></textarea>
                                            </div> 
                                            <div class="form-group">
                                                <label for="txt_luas">Luas Tanah</label>
                                                <input type="text" name="txt_luas" class="form-control" id="txt_luas" value="<?= $properti->luas_tanah;?>" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_jumlah">Jumlah</label>
                                                <input type="text" name='txt_jumlah' class="form-control" id="txt_jumlah" value="<?= $properti->jumlah_unit;?>"disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_rekening">Rekening</label>
                                                <input type="text" name='txt_rekening' class="form-control" id="txt_rekening" value="<?= $properti->rekening;?>"disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_foto">SPR</label>
                                                <textarea class="form-control" name="txt_spr" id="txt_spr" rows="10" disabled><?= $properti->setting_spr ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_foto">Status</label>
                                                <select name="txt_status" id="txt_status" class="form-control" disabled>
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="publish" <?php echo (($properti->status == "publish")?"selected":""); ?>>Publish</option>
                                                    <option value="non-publish" <?php echo (($properti->status == "non-publish")?"selected":""); ?>>Non Publish</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_logo" class="d-flex">logo Properti</label>
                                                <img id="logo_properti" width="180px" src="<?= base_url().'assets/uploads/images/properti/'.$properti->logo_properti ?>" alt="" >
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_foto" class="d-flex">Foto Properti</label>
                                                <img id="foto_properti" src="<?= base_url().'assets/uploads/images/properti/'.$properti->foto_properti ?>" style="max-width:100%;max-height:350px" >
                                            </div>
                                        </div>
                                    </div>                                
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="button" id="btn_ubah_properti" class="btn btn-info mr-2 float-right">Ubah</button>
                            </div>  
                        </div>
                        </form>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
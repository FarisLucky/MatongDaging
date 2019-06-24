<div class="content-wrapper" id="detail_unit">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Site Plan</h4>
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
                                <h5 class="d-inline-block mr-4">Detail Unit Properti</h5>
                                <small class="badge badge-info"><?= $unit->status_unit ?></small>
                                <a href="<?= base_url() ?>unitproperti" class="btn btn-dark float-right"><i class="fa fa-arrow-circle-left"></i>Kembali</a>
                            </div>
                        </div>
                        <hr>
                        <form id="form_detail_unit" action="<?= base_url() ?>unitproperti/core_detail_unit" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" name="txt_id" class="form-control" id="txt_id" value="<?= $unit->id_unit ?>" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="txt_nama">Nama Unit</label>
                                            <input type="text" name="txt_nama" class="form-control" id="txt_nama" value="<?= $unit->nama_unit ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_type">Type</label>
                                            <input type="text" name="txt_type" class="form-control" id="txt_type" value="<?= $unit->type?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_tanah">Luas Tanah</label>
                                            <input type="text" name="txt_tanah" class="form-control" id="txt_tanah" value="<?= $unit->luas_tanah ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_bangunan">Luas Bangunan</label>
                                            <input type="text" name="txt_bangunan" class="form-control" id="txt_bangunan" value="<?= $unit->luas_bangunan ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_harga">Harga</label>
                                            <input type="text" name="txt_harga" class="form-control" id="txt_harga" value="<?= $unit->harga_unit ?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="txt_alamat">Alamat</label>
                                            <textarea class="form-control" name="txt_alamat" id="txt_alamat" rows="5" disabled><?= $unit->alamat_unit ?></textarea>
                                        </div> 
                                        <div class="form-group">
                                            <label for="txt_desc">Deskripsi</label>
                                            <textarea class="form-control" name="txt_desc" id="txt_desc" rows="5"  disabled><?= $unit->deskripsi ?></textarea>
                                        </div> 
                                        <div class="form-group">
                                            <label for="txt_foto" class="d-flex">Foto Properti</label>
                                            <img src="<?= base_url() ?>assets/uploads/images/unit_properti/<?= $unit->foto_unit ?>" alt="" id="foto_unit" class="img-thumbnail" style="max-width:500px">
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="button" id="btn_ubah_unit" class="btn btn-info mr-2 float-right">Ubah</button>
                            </div>  
                        </div>
                        </form>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper" id="multi_tambah">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Kelola Unit</h4>
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
                                <h5 class="d-inline-block">Tambah Unit Properti</h5>
                            </div>
                        </div>
                        <hr>
                        <form id="form_multi_tambah" action="<?= base_url() ?>unitproperti" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="txt_nama">Nama Unit</label>
                                    <input type="text" name="txt_nama" class="form-control" id="txt_nama">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="txt_nama">Blok Awal</label>
                                            <input type="number" name="txt_blok_awal" class="form-control" id="txt_blok_awal">
                                        </div>
                                        <div class="col-sm-8">
                                            <label for="txt_nama">Jumlah</label>
                                            <input type="number" name="txt_jumlah_blok" class="form-control" id="txt_jumlah_blok">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="txt_type">Type</label>
                                    <input type="text" name="txt_type" class="form-control" id="txt_type">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="txt_tanah">Luas Tanah</label>
                                    <input type="text" name="txt_tanah" class="form-control" id="txt_tanah">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="txt_bangunan">Luas Bangunan</label>
                                    <input type="text" name="txt_bangunan" class="form-control" id="txt_bangunan">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="txt_harga">Harga</label>
                                    <input type="text" name="txt_harga" class="form-control" id="txt_harga">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="txt_alamat">Alamat</label>
                                    <textarea class="form-control" name="txt_alamat" id="txt_alamat" rows="3"></textarea>
                                </div> 
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="txt_desc">Deskripsi</label>
                                    <textarea class="form-control" name="txt_desc" id="txt_desc" rows="3"></textarea>
                                </div> 
                            </div>
                        </div>   
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" id="btn_simpan_properti" class="btn btn-success mr-2">Simpan</button>
                                <a href="<?= base_url() ?>unitproperti" id="btn_batal_properti" class="btn btn-dark mr-2">Batal</a>
                            </div>  
                        </div>
                        </form>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
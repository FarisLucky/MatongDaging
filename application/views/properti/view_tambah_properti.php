<div class="content-wrapper" id="tambah_property">
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
                                <h5 class="d-inline-block">Tambah Properti</h5>
                                <a href="<?= base_url() ?>properti" class="btn btn-dark mr-2 float-right"><i class="fa fa-arrow-circle-left"></i>Kembali</a>
                            </div>
                        </div>
                        <hr>
                        <form id="form_tambah" action="<?= base_url() ?>properti" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="txti_nama">Nama Properti</label>
                                                <input type="text" name="txt_nama" class="form-control" id="txt_nama">
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_alamat">Alamat</label>
                                                <textarea class="form-control" name="txt_alamat" id="txt_alamat" rows="3"></textarea>
                                            </div> 
                                            <div class="form-group">
                                                <label for="txt_luas">Luas Tanah</label>
                                                <input type="text" name="txt_luas" class="form-control" id="txt_luas">
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_jumlah">Jumlah</label>
                                                <input type="text" name='txt_jumlah' class="form-control" id="txt_jumlah">
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_rekening">Rekening</label>
                                                <input type="text" name='txt_rekening' class="form-control" id="txt_rekening">
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_foto">Status</label>
                                                <select name="txt_status" id="txt_status" class="form-control" >
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="publish">Publish</option>
                                                    <option value="non-publish">Non Publish</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_logo" class="d-flex">logo Properti</label>
                                                <img id="logo_properti" width="180px" alt="" >
                                                <input type="file" name="foto[logo]" multiple id="txt_logo" class="form-control col-sm-4">
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="txt_foto" class="d-flex">Foto Properti</label>
                                                <img id="foto_properti" style="max-width:100%;max-height:350px" >
                                                <input type="file" name="foto[foto]" multiple id="txt_foto" class="form-control col-sm-4">
                                            </div>
                                        </div>
                                    </div>                                
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                            <div class="form-group">
                                <label for="txt_foto" class="font-weight-light">SPR</label>
                                <textarea class="form-control" name="txt_spr" id="txt_spr" rows="5" ></textarea>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" id="btn_simpan_properti" class="btn btn-success mr-2">Simpan</button>
                                <a href="<?= base_url() ?>properti" id="btn_batal_properti" class="btn btn-dark mr-2">Batal</a>
                            </div>  
                        </div>
                        </form>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper" id="view_surat_kpr">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Surat SP3K</h4>
                                <img id="logo_perusahaan" width="50px" src="<?= base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="<?php echo base_url('pembayaran/coresuratkpr') ?>" method="post" enctype="multipart/form-data" id="kpr_form">
        <input type="hidden" name="input_hidden" value="<?= $id ?>">
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="">Upload Surat</label>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-sm-6">
                                <img id="foto_sp3k" src="<?= base_url("assets/uploads/images/pembayaran/cicilan/".$image->sp3k) ?>" style="width:100%">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="file" name="upload" class="form-control">
                                    <small class="text-danger"><?php echo ($error != null) ? $error : "" ; ?></small> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                <a href="<?= base_url("pembayaran/cicilan") ?>" class="btn btn-dark mx-2"><i class="fa fa-arrow-left"></i> Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
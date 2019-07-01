<div class="content-wrapper" id="unit_properti">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Site Plan dan List Unit</h4>
                                <img id="logo_perusahaan" width="50px" src="<?php echo base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <img src="<?= base_url('assets/uploads/images/properti/'.$site_plan["foto_properti"]) ?>" style="max-width:100%;max-height:300px">
                            </div>
                        </div>
                        <hr>
                        <small class="txt-normal text-danger">* yang di centang berarti sudah terjual</small>
                            <div class="row mt-3">
                                <?php foreach ($list_unit as $key => $value) : 
                                    if ($value->status_unit == "sudah terjual") {
                                        $check = "checked";
                                    }else{
                                        $check="";
                                    } ?>
                                <div class="col-sm-2">
                                <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="unit_properti" disabled <?php echo $check ?>><?php echo $value->nama_unit ?>
                                    </label>
                                </div>
                                </div>
                                <?php endforeach; ?>
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
                                <h5 class="d-inline-block"><i class="fa fa-m"></i>Data Unit</h5>
                                <a href="<?= base_url() ?>unitproperti/multitambah" class="btn btn-warning btn-sm float-right"><i class="fa fa-plus"></i>Tambah Banyak</a>
                                <a href="<?= base_url() ?>unitproperti/tambah" class="btn btn-primary btn-sm float-right mx-2"><i class="fa fa-plus"></i>Tambah</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-hover display responsive no-wrap" id="tbl_unit">
                                    <thead>
                                        <th>Nama</th>
                                        <th>Type Rumah</th>
                                        <th>Tanah</th>
                                        <th>Bangunan</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </thead>
                                </table>                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

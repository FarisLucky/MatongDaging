<div class="content-wrapper" id="unit_properti">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Kelola Unit</h4>
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
                                <h5 class="d-inline-block"><i class="fa fa-m"></i>Table Properti</h5>
                                <a href="<?= base_url() ?>unit_properti/tambah" class="btn btn-info btn-sm float-right mr-2">Tambah Unit</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-hover display responsive no-wrap" id="tbl_unit">
                                    <thead>
                                        <th>Nama</th>
                                        <th>Type Rumah</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Foto</th>
                                        <th>Alamat</th>
                                        <th>Luas Tanah</th>
                                        <th>Luas Bangunan</th>
                                        <th>Deskripsi</th>
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

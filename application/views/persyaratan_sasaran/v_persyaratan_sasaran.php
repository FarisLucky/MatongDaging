<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Kelola Persyaratan Sasaran</h4>
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
                                <h5 class="d-inline-block"><i class="fa fa-m"></i>Kelola Persyaratan</h5>
                                <a href="<?= base_url() ?>persyaratansasaran/tambah"class="btn btn-info btn-sm float-right">Tambah</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                <table class="table table-hover" id="tbl_users">
                                    <thead>
                                        <th>N0</th>
                                        <th>Nama Persyaratan</th>
                                        <th>Poin Penting</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                <?php 
                                $no = 1;
                                foreach($persyaratan_sasaran as $p){ 
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $p->nama_persyaratan ?></td>
                                    <td><?php echo $p->poin_penting ?></td>
                                    <td><?php echo $p->keterangan ?></td>
                                    <td>
                                    <a href="<?= base_url() .'persyaratansasaran/edit'?>/<?= $p->id_sasaran ?>" class="btn btn-primary" class="btn btn-primary">Edit</a>
                                    <a href="<?= base_url() .'persyaratansasaran/hapus'?>/<?= $p->id_sasaran?>" class="btn btn-danger" class="btn btn-danger">Delete</a>
                                    </td>

                                </tr>
                                <?php } ?>
                                            
                                        </tr>
                                    </tbody>
                                </table>                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

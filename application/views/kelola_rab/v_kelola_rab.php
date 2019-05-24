<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Kelola RAB Bangunan</h4>
                                <!-- <img id="logo_perusahaan" width="50px" src="<?= base_url().'assets/uploads/images/profil/user/'.$perusahaan[0]['logo_perusahaan'] ?>" class="float-right" alt=""> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Isi bung </h4>
                                <!-- <img id="logo_perusahaan" width="50px" src="<?= base_url().'assets/uploads/images/profil/user/'.$perusahaan[0]['logo_perusahaan'] ?>" class="float-right" alt=""> -->
                                <br>
                                <form>
                                  <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="exampleFormControlSelect1">Nama Rab</label>
                                    <input type="text" name = "nama_rab" value= "<?php echo $rab_properti->nama_rab?> "class="form-control" id="exampleInputName1" readonly placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="exampleFormControlSelect1">Total Anggaran</label>
                                    <input type="text" name = "total_anggaran" value= "<?php echo $rab_properti->total_anggaran?> "class="form-control" id="exampleInputName1" readonly placeholder="">
                                    </div>
                                  </div>
                                 </form>
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
                                <h5 class="d-inline-block"><i class="fa fa-m"></i>Kelola RAB</h5>
                                <a href="<?= base_url() ?>kelola_rab/tambah"class="btn btn-info btn-sm float-right">Tambah</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                <table class="table table-hover" id="tbl_users">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Detail</th>
                                        <th>Volume</th>
                                        <th>Satuan</th>
                                        <th>Harga Satuan</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                <?php 
                                $no = 1;
                                foreach($kelola_rab as $k){ 
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $k->nama_detail ?></td>
                                    <td><?php echo $k->volume ?></td>
                                    <td><?php echo $k->satuan ?></td>
                                    <td><?php echo $k->harga_satuan ?></td>
                                    <td>
                                    <a href="<?= base_url() .'kelola_rab/edit'?>/<?= $k->id_detail ?>" class="btn btn-primary" class="btn btn-primary">Edit</a>
                                    <a href="<?= base_url() .'kelola_rab/hapus'?>/<?= $k->id_detail?>" class="btn btn-danger" class="btn btn-danger">Delete</a>
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

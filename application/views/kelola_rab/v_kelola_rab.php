<div class="content-wrapper">
    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="dark txt_title d-inline-block mt-2">RAB <?= ucfirst($rab_properti->nama_rab) ?></h4>
                        <a href="<?= base_url().'properti' ?>" class="float-right mt-2 text-primary"><i class="fa fa-arrow-left text-primary"></i> Lihat Properti</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="dark txt_title d-inline-block mb-3">Type RAB : <?= ucfirst($rab_properti->type) ?></h5>
                                <br>
                                <form>
                                  <div class="form-row">
                                    <div class="form-group col-md-6">
                                      <label for="exampleFormControlSelect1">Nama Rab</label>
                                    <input type="text" name = "nama_rab" value= "<?php echo $rab_properti->nama_rab?> "class="form-control" id="exampleInputName1" readonly placeholder="">
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="exampleFormControlSelect1">Total Anggaran</label>
                                    <input type="text" name = "total_anggaran" value= "<?php echo number_format($rab_properti->total_anggaran,2,",",".")?> "class="form-control" id="exampleInputName1" readonly placeholder="">
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
                                <a href="<?= base_url() ?>rab/tambah/<?= $rab_properti->id_rab ?>"class="btn btn-info btn-sm float-right" data-id="<?= $rab_properti->id_properti ?>" id="tambah_rab">Tambah</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-hover" id="tbl_rab_properti">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Detail</th>
                                        <th>Volume</th>
                                        <th>Satuan</th>
                                        <th>Harga Satuan</th>
                                        <th>Total Harga</th>
                                        <th>Kelompok</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                <?php 
                                $no = 1;
                                foreach($kelola_rab as $k){ 
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $k->nama_detail ?></td>
                                    <td><?php echo $k->volume ?></td>
                                    <td><?php echo $k->satuan ?></td>
                                    <td><?php echo number_format($k->harga_satuan,2,',','.') ?></td>
                                    <td><?php echo  number_format($k->total_harga,2,',','.') ?></td>
                                    <td><?php echo $k->kelompok_pengeluaran ?></td>
                                    <td>
                                    <a href="<?= base_url() .'rab/edit/'.$k->id_detail?>" class="btn btn-sm btn-primary">Edit</a>
                                    <button type="button" class="btn btn-sm btn-danger" id="rm_detail" data-id="<?= $k->id_detail ?>">Delete</a>
                                    </td>

                                </tr>
                                <?php } ?>
                                    </tbody>
                                </table>                                 
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

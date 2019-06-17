<div class="content-wrapper">
    <div class="container">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Kelola Pengeluaran</h4>
                        <img id="logo_perusahaan" width="50px" src="<?php echo base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right" alt="">
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
                                <h5 class="d-inline-block"><i class="fa fa-m"></i>Pengeluaran</h5>
                                <a href="<?= base_url() ?>pengeluaran/tambah"class="btn btn-info btn-sm float-right">Tambah</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tbl_pengeluaran">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama_pengeluaran</th>
                                        <th>Volume</th>
                                        <th>Satuan</th>
                                        <th>Harga_satuan</th>
                                        <th>Tgl_buat</th>
                                        <th>Bukti_kwitansi</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no = 1;
                                        foreach($pengeluaran as $p){ 
                                        ?>
                                        <tr>
                                <?php 
                                $no = 1;
                                foreach($pengeluaran as $p){ 
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $p->nama_pengeluaran ?></td>
                                    <td><?php echo $p->volume ?></td>
                                    <td><?php echo $p->satuan ?></td>
                                    <td><?php echo $p->harga_satuan ?></td>
                                    <td><?php echo $p->tgl_buat ?></td>
                                    <td>
                                    <img src="<?=base_url('upload/foto/'.$p->bukti_kwitansi)?>" style="width:300px; height:150">
                                    </td>
                                    <td>
                                    <a href="<?= base_url() .'pengeluaran/edit'?>/<?= $p->id_pengeluaran ?>" class="btn btn-primary">Edit</a>
                                    <a href="<?= base_url() .'pengeluaran/hapus'?>/<?= $p->id_pengeluaran ?>" class="btn btn-danger" class="btn btn-danger">Delete</a>
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
    </div>
</div>

<div class="content-wrapper" id="v_persyaratan_sasaran">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Kelola Persyaratan Sasaran</h4>
                            </div>
                            <?php if ($this->session->flashdata('berhasil')) { ?>
                                <div class="col-sm-12">
                                    <div class="alert alert-success"> &nbsp;<?= $this->session->flashdata('berhasil'); ?></div>
                                </div>
                            <?php } ?>
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
                                <a href="<?= base_url() ?>persyaratanunit/tambah"class="btn btn-info btn-sm float-right"><i class="fa fa-plus"></i>Tambah</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered" id="tbl_syarat">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Persyaratan</th>
                                        <th>Poin Penting</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach($persyaratan as $p){ 
                                                if ($p->poin_penting == "tp") {
                                                    $poin = "Tidak Penting";
                                                }elseif ($p->poin_penting == "s") {
                                                    $poin = "Sedang";
                                                }elseif ($p->poin_penting == "p") {
                                                    $poin = "Penting";
                                                }elseif($p->poin_penting == "ps"){
                                                    $poin = "Penting Sekali";
                                                }else{
                                                    $poin = "-";
                                                }
                                            ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $p->nama_persyaratan ?></td>
                                            <td><?php echo $poin ?></td>
                                            <td><?php echo $p->keterangan ?></td>
                                            <td>
                                                <a href="<?= base_url('persyaratanunit/ubah/'.$p->id_sasaran) ?>" class="btn btn-sm btn-primary" ><i class="fa fa-edit"></i>Ubah</a>
                                                <button class="btn btn-sm btn-danger hapus_syarat" data-id="<?= $p->id_sasaran ?>"><i class="fa fa-trash"></i>Hapus</button>
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

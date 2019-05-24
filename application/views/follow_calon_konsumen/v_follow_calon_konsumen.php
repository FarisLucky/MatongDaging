<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Follow Up Konsumen</h4>
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
                        <h5 class="d-inline-block"><i class="fa fa-m"></i>Data Follow Up Konsumen</h5>
                        <a href="<?= base_url() ?>Follow_calon_konsumen/tambah" class="btn btn-info btn-sm float-right">Tambah</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-hover" id="follow_up_konsumen">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Konsumen</th>
                                        <th>Tanggal Follow</th>
                                        <th>Media</th>
                                        <th>Keterangan</th>
                                        <th>Hasil Follow</th>
                                        <th>Nama Petugas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($follow_calon_konsumen as $f) :
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $f->id_konsumen ?></td>
                                            <td><?php echo $f->tgl_follow ?></td>
                                            <td><?php echo $f->media ?></td>
                                            <td><?php echo $f->keterangan ?></td>
                                            <td><?php echo $f->hasil_follow ?></td>
                                            <td><?php echo $f->id_user ?></td>
                                            <td width="250">
                                                <a href="" class="btn btn btn-primary btn-fw"></i> Edit</a>
                                                <a href="<?php echo site_url('index.php/Follow_calon_konsumen/hapus/' . $f->id_follow) ?>" class="btn btn btn-danger btn-fw"></i> Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
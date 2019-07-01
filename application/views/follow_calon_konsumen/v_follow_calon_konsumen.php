<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Follow Calon Konsumen</h4>
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
                                <h5 class="d-inline-block"><i class="fa fa-m"></i>Data Follow Calon Konsumen</h5>
                                <a href="<?= base_url() ?>followcalonkonsumen/tambah" class="btn btn-info btn-sm float-right">Tambah</a>
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
                                                <th>Tanggal Mendaftar</th>
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
                                                $tanggal = date('d-m-Y', strtotime($f->tgl_follow));
                                                ?>
                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo $f->nama_lengkap ?></td>
                                                    <td><?php echo $tanggal ?></td>
                                                    <td><?php echo $f->media ?></td>
                                                    <td><?php echo $f->keterangan ?></td>
                                                    <td><?php echo $f->hasil_follow ?></td>
                                                    <td><?php echo $f->pembuat ?></td>
                                                    <td width="250">
                                                        <a href="<?php echo site_url('followcalonkonsumen/edit/' . $f->id_follow) ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                                        <a href="<?php echo site_url('followcalonkonsumen/hapus/' . $f->id_follow) ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ?');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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
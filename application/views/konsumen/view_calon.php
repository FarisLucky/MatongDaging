<div class="content-wrapper">
<div class="container">
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body p-4">
                <h4 class="dark txt_title d-inline-block mt-2">Calon Konsumen</h4>
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
                        <h5 class="d-inline-block"><i class="fa fa-m"></i>Data Calon</h5>
                        <a href="<?= site_url() ?>konsumen/tambah" class="btn btn-info btn-sm float-right">Tambah</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                            <table class="table table-hover" id="tbl_konsumen">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Type</th>
                                        <th>Id Card</th>
                                        <th>Nama Konsumen</th>
                                        <th>No Telepon</th>
                                        <th>Email</th>
                                        <th>Status Konsumen</th>
                                        <th>Nama Pembuat</th>
                                        <th>Tanggal dibuat</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($konsumen as $k) :
                                        $tgl = explode(' ', $k->tgl_buat);
                                        $tanggal = $tgl[0];
                                        $waktu = $tgl[1];
                                        $tanggal = date('d-m-Y', strtotime($tanggal));
                                        ?>
                                        <tr>
                                            <td><?php echo $no++ ?></td>
                                            <td><?php echo $k->nama_type ?></td>
                                            <td><?php echo $k->id_card ?></td>
                                            <td><?php echo $k->nama_konsumen ?></td>
                                            <td><?php echo $k->telp ?></td>
                                            <td><?php echo $k->email ?></td>
                                            <td><?php echo $k->status_konsumen ?></td>
                                            <td><?php echo $k->nama_pembuat ?></td>
                                            <td><?php echo $k->tgl_buat?></td>
                                            <td><?php echo $k->alamat ?></td>
                                            <td>
                                                <a href="<?php echo site_url('konsumen/edit/' . $k->id_konsumen) ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>Edit</a>
                                                <a href="<?php echo site_url('konsumen/hapus/' . $k->id_konsumen) ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Hapus</a>
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
</div>
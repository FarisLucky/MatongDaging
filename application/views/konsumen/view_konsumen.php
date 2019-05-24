<div class="content-wrapper">
<div class="container">
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Konsumen</h4>
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
                        <h5 class="d-inline-block"><i class="fa fa-m"></i>Data Konsumen</h5>
                        <a href="<?= site_url() ?>konsumen/tambah" class="btn btn-info btn-sm float-right">Tambah</a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-hover" id="tbl_konsumen">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Type</th>
                                        <th>Id Card</th>
                                        <th>Nama Konsumen</th>
                                        <th>Alamat</th>
                                        <th>No Telepon</th>
                                        <th>Email</th>
                                        <th>Foto KTP</th>
                                        <th>NPWP</th>
                                        <th>Pekerjaan</th>
                                        <th>Alamat Kantor</th>
                                        <th>Telepon Kantor</th>
                                        <th>Status Konsumen</th>
                                        <th>Nama Pembuat</th>
                                        <th>Tanggal dibuat</th>
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
                                            <td><?php echo $k->alamat ?></td>
                                            <td><?php echo $k->telp ?></td>
                                            <td><?php echo $k->email ?></td>
                                            <td><img src="<?= base_url()."assets/uploads/images/konsumen/".$k->foto_ktp ?>" width="64" /></td>
                                            <td><?php echo $k->npwp ?></td>
                                            <td><?php echo $k->pekerjaan ?></td>
                                            <td><?php echo $k->alamat_kantor ?></td>
                                            <td><?php echo $k->telp_kantor ?></td>
                                            <td><?php echo $k->status_konsumen ?></td>
                                            <td><?php echo $k->nama_pembuat ?></td>
                                            <td><?php echo $k->tgl_buat?></td>
                                            <td>
                                                <a href="<?php echo site_url('konsumen/edit/' . $k->id_konsumen) ?>" class="btn btn-sm btn-primary"></i> Edit</a>
                                                <a href="<?php echo site_url('konsumen/hapus/' . $k->id_konsumen) ?>" class="btn btn-sm btn-danger"></i> Hapus</a>
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
</div>
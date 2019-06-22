<div class="content-wrapper" id="laporan_unlock_transaksi">
    <div class="container">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">List Unlock Transaksi</h4>
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
                            <h5 class="d-inline">List Unlock Transaksi Unit</h5>
                            <a href="<?= base_url("laporantransaksi") ?>" class="btn btn-primary float-right"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-hover table-bordered" id="tbl_unlock_transaksi">
                                <thead class="thead-light">
                                    <tr>
                                        <th>PPJB</th>
                                        <th>Nama Konsumen</th>
                                        <th>Nama Rumah</th>
                                        <th>Nama Perumahan</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>User Pembuat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transaksi as $key => $value) { ?>
                                        <tr>
                                            <td><?= $value->no_ppjb ?></td>
                                            <td><?= $value->nama_lengkap ?></td>
                                            <td><?= $value->nama_unit ?></td>
                                            <td><?= $value->nama_properti ?></td>
                                            <td><?= $value->tgl_transaksi ?></td>
                                            <td><?= $value->nama_pembuat ?></td>
                                            <td><?= '<div class="badge badge-primary">'.$value->status_transaksi.'</badge>' ?></td>
                                            <td>
                                                <a href="<?= base_url('laporantransaksi/getdetail/'.$value->id_transaksi.'/un') ?>" class="btn btn-success mx-2"><i class="fa fa-info"></i> Detail</a>
                                                <?php if ($_SESSION["id_akses"] == 1) { ?>
                                                    <button class="btn btn-danger btn-hapus" data-id="<?= $value->id_transaksi ?>"><i class="fa fa-trash"></i> Hapus</button>
                                                <?php } ?>
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

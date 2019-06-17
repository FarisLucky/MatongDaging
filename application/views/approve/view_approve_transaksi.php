<div class="content-wrapper" id="approve_transaksi">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Approve Final</h4>
                                <img id="logo_perusahaan" width="50px" src="<?php echo base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right" alt="">
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
                                <table class="table table-hover display responsive no-wrap" id="tbl_approve_transaksi">
                                    <thead>
                                        <th>PPJB</th>
                                        <th>Nama Konsumen</th>
                                        <th>Nama Rumah</th>
                                        <th>Nama Perumahan</th>
                                        <th>Status</th>
                                        <th>Total Kesepakatan</th>
                                        <th>Total Tambahan</th>
                                        <th>Tanda Jadi</th>
                                        <th>Uang Muka/Periode</th>
                                        <th>Cicilan/Periode</th>
                                        <th>Total Akhir</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($approve_trans as $key => $value) : ?>
                                        <tr>
                                            <td><?= $value->no_ppjb ?></td>
                                            <td><?= $value->nama_lengkap ?></td>
                                            <td><?= $value->nama_unit ?></td>
                                            <td><?= $value->nama_properti ?></td>
                                            <td><?= $value->status_transaksi ?></td>
                                            <td> <?= "Rp. ".number_format($value->total_kesepakatan,2,',','.') ?></td>
                                            <td> <?= "Rp. ".number_format($value->total_tambahan,2,',','.') ?></td>
                                            <td> <?= "Rp. ".number_format($value->tanda_jadi,2,',','.') ?></td>
                                            <td> <?= "Rp. ".number_format($value->uang_muka,2,',','.')." / ".$value->periode_uang_muka ?></td>
                                            <td> <?= "Rp. ".number_format($value->pembayaran,2,',','.')." / ".$value->bayar_periode ?></td>
                                            <td> <?= "Rp. ".number_format($value->total_akhir,2,',','.') ?></td>
                                            <td><a href="<?= base_url()."approve/transaksi/detail/".$value->id_transaksi ?>" class="btn btn-sm btn-primary btn-detail-trans" >Detail</a><a href="<?= base_url()."approve/transaksi/detail/".$value->id_transaksi ?>" class="btn btn-sm btn-warning ml-2 btn-detail-trans" >Data Konsumen</a><button type="button" class="btn btn-sm btn-danger ml-2 btn-confirm-trans" data-id="<?= $value->id_transaksi ?>">Confirm</button></td>
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
</div>
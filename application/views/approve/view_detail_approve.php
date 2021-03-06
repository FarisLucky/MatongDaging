<div class="content-wrapper" id="detail_approve">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Detail Transaksi</h4>
                                <img id="logo_perusahaan" width="50px" src="<?= base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right" alt="">
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
                                <h5 class="d-inline-block">Konsumen : <?= $data_transaksi->nama_lengkap ?></h5>
                                <a href="<?= base_url().'approve/penjualan' ?>" class="float-right"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center mb-4">
                                <span class="kh-title">Detail Tambahan</span>
                            </div>
                        </div>
                        <div class="row">
                                <?php if ($detail_trans != null) { 
                                    foreach ($detail_trans as $key => $value) {?>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Tambahan</label>
                                            <input type="text" class="form-control" name="tambahan" disabled value="<?= $value->penambahan ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Volume</label>
                                            <input type="text" class="form-control" name="volume" disabled value="<?= $value->volume ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Satuan</label>
                                            <input type="text" class="form-control" name="satuan" disabled value="<?= $value->satuan ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Harga</label>
                                            <input type="text" class="form-control" name="harga" disabled value="<?= $value->harga ?>">
                                        </div>
                                    </div>
                                <?php }}else{?>
                                    <div class="col-sm-12 text-center mb-3">
                                        <span>Tidak Ada Tambahan</span>
                                    </div>
                                <?php } ?>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h6 class="ttl_um">Semua Pembayaran</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-hover display responsive no-wrap" id="tbl_app_detail">
                                        <thead>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Tagihan</th>
                                            <th>Bayar</th>
                                            <th>Hutang</th>
                                            <th>Status</th>
                                            <th>Tempo</th>
                                            <th>Bukti</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($data_pembayaran as $key => $value) :?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $value->nama_pembayaran ?></td>
                                                <td><?= number_format($value->total_tagihan,2,',','.') ?></td>
                                                <td><?= number_format($value->jumlah_bayar,2,',','.') ?></td>
                                                <td><?= number_format($value->hutang,2,',','.') ?></td>
                                                <td><span class="badge <?php $sts = $value->status; if($sts == 'belum bayar') { $cs='badge-dark';} elseif ($sts == 'pending') { $cs = 'badge-danger'; }else{ $cs = 'badge-success';} echo $cs; ?>"><?= $sts ?></span></td>
                                                <td><?= $value->tgl_jatuh_tempo?></td>
                                                <td><img src="<?= base_url() ?>assets/uploads/images/pembayaran/uang_muka/<?= $value->bukti_bayar ?>" class="img-circle img-responsive" alt=""></td>
                                                <td><button type="button" class="btn btn-sm btn-primary btn-transaksi" data-id="<?= $value->id_pembayaran ?>">Detail</a>
                                                </td>
                                            </tr>
                                            <?php $no++; endforeach;  ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 text-center mb-4">
                                <span class="kh-title">Transaksi</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_kesepakatan">Total Kesepakatan</label>
                                    <input type="text" name="txt_kesepakatan" class="form-control" value="<?= number_format($data_transaksi->total_kesepakatan,2,',','.') ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_kesepakatan">Total Tambahan</label>
                                    <input type="text" name="txt_tambahan" class="form-control" value="<?= number_format($data_transaksi->total_tambahan,2,',','.') ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Total transaksi</label>
                                    <input type="text" name="txt_ttl_transaksi" class="form-control" value="<?= number_format($data_transaksi->total_transaksi,2,',','.') ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_nama">Total Akhir</label>
                                    <input type="text" name="txt_ttl_akhir" class="form-control" value="<?= number_format($data_transaksi->total_akhir,2,',','.') ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row">
                                <div class="col-sm-12 text-center mb-3">
                                    <span class="kh-title">Uang Muka</span>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="txt_nama">Total UM</label>
                                        <input type="text" name="txt_ttl_transaksi" class="form-control" value="<?= number_format($data_transaksi->uang_muka,2,',','.') ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group text-center">
                                        <label for="txt_nama" class="mb-3">Periode</label>
                                        <strong><?= $data_transaksi->periode_uang_muka ?></strong>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="txt_nama">Total Bayar</label>
                                        <input type="text" name="txt_ttl_transaksi" class="form-control" value="<?= number_format($bayar_um->ttl_bayar,2,',','.') ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="txt_nama">Hutang UM</label>
                                        <input type="text" name="txt_ttl_transaksi" class="form-control" value="<?= number_format($hutang_um->hutang,2,',','.') ?>" readonly>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                <div class="col-sm-12 text-center mb-3">
                                    <span class="kh-title">Cicilan</span>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="txt_nama">Total Cicilan</label>
                                        <input type="text" name="txt_ttl_cicilan" class="form-control" value="<?= number_format($data_transaksi->pembayaran,2,",",".") ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group text-center">
                                        <label for="txt_nama" class="mb-3">Periode</label>
                                        <strong class="periode"><?= $data_transaksi->bayar_periode ?></strong>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="txt_nama" class="mb-3">Type</label>
                                        <strong class="type"><?= $data_transaksi->type_pembayaran ?></strong>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="txt_nama">Total Bayar</label>
                                        <input type="text" name="txt_ttl_transaksi" class="form-control" value="<?= number_format($bayar_ccl->ttl_bayar,2,',','.') ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="txt_nama">Hutang Cicilan</label>
                                        <input type="text" name="txt_ttl_transaksi" class="form-control" value="<?= number_format($hutang_ccl->hutang,2,',','.') ?>" readonly>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal_transaksi">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-6">
                <small class="txt-normal user">User : </small><br>
                <small class="txt-normal tgl_bayar">Tanggal Bayar : </small><br>
                <small class="txt-normal tgl_tempo">Tanggal Tempo : </small><br>
            </div>
            <div class="col-sm-6">
                <small class="txt-normal jenis">Jenis Pembayaran : </small><br>
                <small class="txt-normal type_modal">Type Pembayaran : </small><br>
                <small class="txt-normal">Status : <small class="badge badge-success status"></small> </small><br>
            </div>
        </div> 
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <small class="txt-normal">Bukti Bayar</small>
                <img src="<?= base_url().'assets/uploads/' ?>" class="img-base" width="150px" alt="">
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <div class="content-wrapper" id="detail_kontrol">
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
                                <a href="<?= base_url().'kartukontrol' ?>" class="float-right"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h6 class="ttl_um">Semua Pembayaran</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row mb-1">
                                    <div class="col-sm-4">
                                        <small class="txt-normal font-weight-semibold">Total transaksi</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class='txt-normal'><?php echo number_format($transaksi->total_transaksi,2,",",".") ?></small>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">
                                        <small class="txt-normal font-weight-semibold">Tanda Jadi</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class='txt-normal'><?php echo number_format($transaksi->tanda_jadi,2,",",".") ?></small>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">
                                        <small class="txt-normal font-weight-semibold">Uang Muka / periode</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class='txt-normal'><?php echo number_format($transaksi->uang_muka,2,",",".")." / ".$transaksi->periode_uang_muka ?></small>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-sm-4">
                                        <small class="txt-normal font-weight-semibold">Cicilan / periode</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class='txt-normal'><?php echo number_format($transaksi->pembayaran,2,",",".")." / ".$transaksi->bayar_periode ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <small class="txt-normal font-weight-semibold">Total Pemasukan</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="txt-normal"><?= number_format($pemasukan->pemasukan,2,",",".") ?></small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <small class="txt-normal font-weight-semibold">Total Hutang</small>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="txt-normal"><?= number_format($hutang->hutang,2,",",".") ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-hover display responsive no-wrap" id="tbl_detail_kontrol">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>jenis Bayar</th>
                                        <th>Tagihan</th>
                                        <th>Bayar</th>
                                        <th>Status</th>
                                        <th>Hutang</th>
                                        <th>Bukti</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach ($detail_kontrol as $key => $value) :?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $value->nama_pembayaran ?></td>
                                            <td><?= $value->jenis_pembayaran ?></td>
                                            <td><?= number_format($value->total_tagihan,2,',','.') ?></td>
                                            <td><?= number_format($value->jumlah_bayar,2,',','.') ?></td>
                                            <td><span class="badge <?php $sts = $value->status; if($sts == 'belum bayar') { $cs='badge-dark';} elseif ($sts == 'pending') { $cs = 'badge-danger'; }else{ $cs = 'badge-success';} echo $cs; ?>"><?= $sts ?></span></td>
                                            <td><?= number_format($value->hutang,2,',','.') ?></td>
                                            <td><img src="<?= base_url() ?>assets/uploads/images/pembayaran/uang_muka/<?= $value->bukti_bayar ?>" class="img-circle img-responsive" alt=""></td>
                                            </td>
                                            <td><button type="button" class="btn btn-sm btn-primary btn-detail" data-id="<?= $value->id_pembayaran ?>">Detail</a>
                                        </tr>
                                        <?php $no++; endforeach;  ?>
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


<!-- Modal -->
<div class="modal fade" id="modal_detail_kontrol">
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
            <div class="col-sm-12">
                <small class="txt-normal user">User : </small><br>
                <small class="txt-normal tgl_bayar">Tanggal Bayar : </small><br>
                <small class="txt-normal tgl_tempo">Tanggal Tempo : </small><br>
            </div>
        </div> 
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <small class="txt-normal">Bukti Bayar</small><br>
                <img src="" class="img-base" width="100%" alt="">
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
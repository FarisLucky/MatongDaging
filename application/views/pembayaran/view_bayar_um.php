<div class="content-wrapper" id="kelola_uang_muka">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Kelola Uang Muka</h4>
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
                                <h5 class="d-inline-block">Konsumen : <?= $um_data->nama_lengkap ?></h5>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 mb-4 text-center">
                                <span class="kh-title">Total Khusus Uang Muka</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_nama">Total Uang Muka</label>
                                    <input type="text" name="txt_ttl_transaksi" class="form-control" value="<?= number_format($um_data->uang_muka,2,',','.') ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group text-center">
                                    <label for="txt_nama" class="mb-3">Periode</label>
                                    <strong><?= $um_data->periode_uang_muka ?></strong>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_nama">Total Bayar</label>
                                    <input type="text" name="txt_ttl_transaksi" class="form-control" value="<?= number_format($um_bayar->ttl_bayar,2,',','.') ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_nama">Total Hutang</label>
                                    <input type="text" name="txt_ttl_transaksi" class="form-control" value="<?= number_format($um_hutang->hutang,2,',','.') ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h6 class="ttl_um">Uang Muka</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-hover display responsive no-wrap" id="tbl_kelola_um">
                                        <thead>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Tagihan</th>
                                            <th>Hutang</th>
                                            <th>Status</th>
                                            <th>Tempo</th>
                                            <th>Bukti</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($data_uang_muka as $key => $value) :?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $value->nama_pembayaran ?></td>
                                                <td><?= number_format($value->total_tagihan,2,',','.') ?></td>
                                                <td><?= number_format($value->hutang,2,',','.') ?></td>
                                                <td><span class="badge <?php $sts = $value->status; if($sts == 'belum bayar') { $cs='badge-dark';} elseif ($sts == 'pending') { $cs = 'badge-danger'; }else{ $cs = 'badge-success';} echo $cs; ?>"><?= $sts ?></span></td>
                                                <td><?= $value->tgl_jatuh_tempo?></td>
                                                <td><img src="<?= base_url() ?>assets/uploads/images/pembayaran/uang_muka/<?= $value->bukti_bayar ?>" class="img-circle img-responsive" alt=""></td>
                                                <td><?php if ($sts == 'belum bayar') { ?>
                                                <a href="<?= base_url() ?>pembayaran/uangmuka/bayar" class="btn btn-sm btn-info bayar_Um" data-id="<?= $value->id_pembayaran ?>">bayar</a>
                                                <?php }else{ ?>
                                                    <a href="<?= base_url() ?>pembayaran/uangmuka/bayar" class="btn btn-sm btn-success bayar_Um" data-id="<?= $value->id_pembayaran ?>">Print</a>
                                                <?php } ?>
                                                </td>
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
</div>


<!-- Modal -->
<div class="modal fade" id="modal_uang_muka">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Uang Muka</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" class="form_uang_muka" action="<?= base_url() ?>pembayaran/uangmuka/submitbayar" enctype="multipart/formdata">
      <input type="hidden" name="input_hidden">
      <div class="modal-body">
        <div class="row m-3">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="">Uang Muka</label>
                    <input type="text" class="form-control uang_muka" name="uang_muka" disabled>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="">Bayar</label>
                    <input type="text" class="form-control nominal_um" name="bayar">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="">Tanggal</label>
                    <input type="date" class="form-control" name="tgl">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="">Upload Bukti</label>
                    <input type="file" class="form-control" name="upload">
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
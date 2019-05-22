<div class="content-wrapper" id="approve_bayar">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Approve Pembayaran</h4>
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
                                <table class="table table-hover display responsive no-wrap" id="tbl_approve_pembayaran">
                                    <thead>
                                        <th>Nama Konsumen</th>
                                        <th>Nama</th>
                                        <th>Nama Rumah</th>
                                        <th>Nama Perumahan</th>
                                        <th>Type</th>
                                        <th>Tanggal Tempo</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Total Tagihan</th>
                                        <th>Total Bayar</th>
                                        <th>Hutang</th>
                                        <th>Bukti</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($approve_bayar as $key => $value) : ?>
                                        <tr>
                                            <td><?= $value->nama_lengkap ?></td>
                                            <td><?= $value->nama_pembayaran ?></td>
                                            <td><?= $value->nama_properti ?></td>
                                            <td><?= $value->nama_unit ?></td>
                                            <td><?php $jenis_pembayaran = $value->jenis_pembayaran;if ($jenis_pembayaran == 'Transaksi') { $href = 'assets/uploads/images/pembayaran/cicilan'; }else if ($jenis_pembayaran == 'Tanda Jadi') { $href = 'assets/uploads/images/pembayaran/tanda_jadi/'; }else{ $href = 'assets/uploads/images/pembayaran/uang_muka/'; } echo $jenis_pembayaran; ?></td>
                                            <td><?= $value->tgl_jatuh_tempo ?></td>
                                            <td><?= $value->tgl_bayar ?></td>
                                            <td> <?= number_format($value->total_tagihan,2,',','.') ?></td>
                                            <td> <?= number_format($value->jumlah_bayar,2,',','.') ?></td>
                                            <td><?= $value->hutang ?></td>
                                            <td><img src="<?php echo base_url().$href.$value->bukti_bayar ?>" width="70px" alt=""></td>
                                            <td><button type="button" class="btn btn-sm btn-info btn-detail" data-id="<?= $value->id_pembayaran ?>">Detail</button><button type="button" class="btn btn-sm btn-warning ml-2 btn-confirm" data-id="<?= $value->id_pembayaran ?>">Confirm</button></td>
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

<!-- Modal -->
<div class="modal fade" id="modal_approve_pembayaran">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-12 text-center">
                <h6>Angsuran</h6>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Nama Properti</label>
                    <input type="text" class="form-control" name="properti" disabled>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Nama Unit</label>
                    <input type="text" class="form-control" name="unit" disabled>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Tanggal Jatuh Tempo</label>
                    <input type="text" class="form-control" name="tgl_tempo" disabled>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="">Tanggal Bayar</label>
                    <input type="text" class="form-control" name="tgl_bayar" disabled>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Total Tagihan</label>
                    <input type="text" class="form-control" name="tagihan" disabled>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Jumlah Bayar</label>
                    <input type="text" class="form-control" name="bayar" disabled>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="">Hutang</label>
                    <input type="text" class="form-control" name="hutang" disabled>
                </div>
            </div>
            <hr>
            <div class="col-sm-12 image">
                <img src="" alt="" class="img-responsive gambar_bukti" width="100%">
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
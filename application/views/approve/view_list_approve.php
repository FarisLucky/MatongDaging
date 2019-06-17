<div class="content-wrapper" id="list_approve">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Approve Pengeluaran</h4>
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
                                <table class="table table-hover table-bordered" id="tbl_list_approve">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama Transaksi</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                        <th>bukti</th>
                                        <th>kelompok</th>
                                        <th>tanggal dibuat</th>
                                        <th>Pembuat</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;  foreach ($approve_pengeluaran as $key => $value) : ?>
                                        <tr>
                                            <td><?= $no ?></td>
                                            <td><?= $value->nama_pengeluaran ?></td>
                                            <td><?= $value->volume." ".$value->satuan ?></td>
                                            <td><?= $value->harga_satuan ?></td>
                                            <td><?= $value->total_harga ?></td>
                                            <td><?= $value->bukti_kwitansi ?></td>
                                            <td><?= $value->nama_kelompok ?></td>
                                            <td><?= $value->created_at ?></td>
                                            <td><?= $value->nama_lengkap ?></td>
                                            <td><button type="button" class="btn btn-sm btn-info btn-detail" data-id="<?= $value->id_pengeluaran ?>">Detail</button>
                                            <button type="button" class="btn btn-sm btn-warning ml-2 btn-confirm" data-id="<?= $value->id_pengeluaran ?>">Confirm</button></td>
                                        </tr>
                                        <?php $no++; endforeach; ?>
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
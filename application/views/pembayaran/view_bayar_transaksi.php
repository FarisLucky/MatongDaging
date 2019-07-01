<div class="content-wrapper" id="bayar_transaksi">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Bayar Transaksi</h4>
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
                            <div class="col-sm-12 text-center mb-3">
                                <small class="kh-title">Total Khusus Cicilan</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_nama">Total Cicilan</label>
                                    <input type="text" name="txt_ttl_akhir" class="form-control" value="<?= number_format($um_data->total_akhir,2,',','.') ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group text-center">
                                    <label for="txt_nama" class="mb-3">Periode</label>
                                    <strong><?= $um_data->bayar_periode ?></strong>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group text-center">
                                    <label for="txt_nama" class="mb-3">Type</label>
                                    <strong><?= $um_data->type_pembayaran ?></strong>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="txt_nama">Bayar Per Periode</label>
                                    <input type="text" name="txt_ttl_akhir" class="form-control" value="<?= number_format($um_data->pembayaran,2,',','.') ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="txt_nama">Total Pemasukan</label>
                                    <input type="text" name="txt_ttl_akhir" class="form-control" value="<?= number_format($um_bayar->ttl_bayar,2,',','.') ?>" readonly>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="txt_nama">Total Hutang</label>
                                    <input type="text" name="txt_ttl_akhir" class="form-control" value="<?= number_format($um_hutang->hutang,2,',','.') ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h6 class="ttl_um">Cicilan Transaksi</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table-hover display responsive no-wrap" id="tbl_cicilan">
                                        <thead>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Tagihan</th>
                                            <th>Bayar</th>
                                            <th>Total Bayar</th>
                                            <th>Hutang</th>
                                            <th>Status</th>
                                            <th>Tempo</th>
                                            <th>Bukti</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($data_transaksi as $key => $value) :
                                                if (($value->status == "belum bayar") && ($value->total_bayar == 0)) {
                                                    $badge = "badge-danger";
                                                    $button = '<button type="button" class="btn btn-sm btn-danger mr-1 bayar_cicilan" data-id="'.$value->id_pembayaran.'"><i class="fa fa-money"></i> Bayar</button>';
                                                }else if (($value->status == "belum bayar") && ($value->total_bayar != 0)) {
                                                    $badge = "badge-danger";
                                                    $button = '<button type="button" class="btn btn-sm btn-danger mr-1 bayar_cicilan" data-id="'.$value->id_pembayaran.'"><i class="fa fa-money"></i>Bayar</button><a href="'.base_url('pembayaran/printdata/'.$value->id_pembayaran).'" class="btn btn-sm btn-success mr-1" >Cetak</a>';
                                                }
                                                else if($value->status == "sementara"){
                                                    $badge = "badge-warning";
                                                    $button = '<button type="button" class="btn btn-sm btn-warning mr-1 edit_bayar" data-id="'.$value->id_pembayaran.'"><i class="fa fa-edit"></i> Edit</button><button type="button" class="btn btn-sm btn-info mr-1 lock_bayar" data-id="'.$value->id_pembayaran.'"><i class="fa fa-lock"></i> Lock</button>';
                                                }
                                                else if($value->status == "pending"){
                                                    $badge = "badge-primary";
                                                    $button = "<i>Menunggu Approve</i>";
                                                }
                                                else{
                                                    $badge = "badge-success";
                                                    $button = '<a href="'.base_url('pembayaran/printdata/'.$value->id_pembayaran).'" class="btn btn-sm btn-success mr-1" >Cetak</a>';
                                                }?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $value->nama_pembayaran ?></td>
                                                <td><?= number_format($value->total_tagihan,2,',','.') ?></td>
                                                <td><?= number_format($value->jumlah_bayar,2,',','.') ?></td>
                                                <td><?= number_format($value->total_bayar,2,',','.') ?></td>
                                                <td><?= number_format($value->hutang,2,',','.') ?></td>
                                                <td><?= '<span class="badge '.$badge.'">'.$value->status.'</span>' ?></td>
                                                <td><?= $value->tgl_jatuh_tempo?></td>
                                                <td><img src="<?= base_url('assets/uploads/images/pembayaran/cicilan/'.$value->bukti_bayar) ?>"></td>
                                                <td><?= $button ?></td>
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
<div class="modal fade" id="modal_cicilan">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Uang Muka</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" class="form_cicilan" action="<?= base_url() ?>pembayaran/transaksi/submitbayar" enctype="multipart/form-data">
      <input type="hidden" name="input_hidden">
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-7">
                <div class="row m-3">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Cicilan</label>
                            <input type="text" class="form-control cicilan" name="cicilan" disabled>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Hutang</label>
                            <input type="text" class="form-control" name="hutang" disabled>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Bayar</label>
                            <input type="text" class="form-control nominal_cicilan" name="bayar">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" name="tgl">
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-sm-5">
                    <small class="txt-normal mb-2">Upload Image</small>
                    <div class="col-sm-12">
                        <img src="" style="max-width:100%; max-height:330px;">
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <input type="file" class="form-control" name="upload">
                        </div>
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
<div class="content-wrapper" id="detail_approve_manager">
    <div class="container">
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
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="d-inline-block">Konsumen : <?= $data_transaksi->nama_lengkap ?></h5>
                                <a href="<?= base_url().'approvetransaksi' ?>" class="float-right"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center mb-4">
                                <span class="kh-title">Tanggal Penting</span>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-sm-3">
                                <small class="txt-normal">Transaksi</small><br>
                                <small class="txt-normal font-weight-semibold"><?php $time = DateTime::createFromFormat("Y-m-d",$data_transaksi->tgl_transaksi); echo tanggal($time->format("d"),$time->format("m")) ?></small>
                            </div>
                            <div class="col-sm-3">
                                <small class="txt-normal">Bayar Tanda Jadi</small><br>
                                <small class="txt-normal font-weight-semibold">Setiap Tanggal <?php $time = DateTime::createFromFormat("Y-m-d",$data_transaksi->tempo_tanda_jadi); echo $time->format("d") ?></small>
                            </div>
                            <div class="col-sm-3">
                                <small class="txt-normal">Bayar Uang Muka</small><br>
                                <small class="txt-normal font-weight-semibold">Setiap Tanggal <?php $time = DateTime::createFromFormat("Y-m-d",$data_transaksi->tempo_uang_muka); echo $time->format("d") ?></small>
                            </div>
                            <div class="col-sm-3">
                                <small class="txt-normal">Bayar Cicilan</small><br>
                                <small class="txt-normal font-weight-semibold">Setiap Tanggal <?php $time = DateTime::createFromFormat("Y-m-d",$data_transaksi->tempo_bayar); echo $time->format("d")  ?></small>
                            </div>
                        </div>
                        <hr>   
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
                                            <input type="text" class="form-control" name="harga" disabled value="<?= number_format($value->harga,2,",",".") ?>">
                                        </div>
                                    </div>
                                <?php }}else{?>
                                    <div class="col-sm-12 text-center mb-3">
                                        <span>Tidak Ada Tambahan</span>
                                    </div>
                                <?php } ?>
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
<div class="content-wrapper" id="tanda_jadi">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Tanda Jadi</h4>
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
                                <table class="table table-hover display responsive no-wrap" id="tbl_tanda_jadi">
                                    <thead>
                                        <th>Pembayaran</th>
                                        <th>Konsumen</th>
                                        <th>Nama Unit</th>
                                        <th>Status</th>
                                        <th>Tagihan</th>
                                        <th>Total Bayar</th>
                                        <th>Hutang</th>
                                        <th>Bukti</th>
                                        <th>Tanggal Tempo</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Pembuat</th>
                                        <th>Aksi</th>
                                    </thead>
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
<div class="modal fade" id="modal_tanda_jadi">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tanda Jadi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" class="form_tanda_jadi" enctype="multipart/formdata">
      <input type="hidden" name="input_hidden">
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-7">
            <div class="row m-3">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="">Tanda Jadi</label>
                        <input type="text" class="form-control tanda_jadi" name="tanda_jadi" disabled>
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
                        <input type="text" class="form-control" name="bayar" id="bayar">
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
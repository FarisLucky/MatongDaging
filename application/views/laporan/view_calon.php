<div class="content-wrapper">
    <div class="container">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Laporan Konsumen</h4>
                        <img id="logo_perusahaan" width="50px" src="<?php echo base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right" alt="">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="tbl_laporan_calon" class="table">
                            <thead>
                                <tr>
                                    <th>Card</th>
                                    <th>Nama Konsumen</th>
                                    <th>Telp</th>
                                    <th>Email</th>
                                    <th>Foto</th>
                                    <th>tgl_buat</th>
                                    <th>Pembuat</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_laporan_calon">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Konsumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body m-3">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-input">
                    <label for="">Npwp</label>
                    <input type="text" name="npwp_detail" class="form-control">
                </div>
                <br>
                <div class="form-input">
                    <label for="">Pekerjaan</label>
                    <input type="text" name="pekerjaan_detail" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-input">
                    <label for="">Alamat Kantor</label>
                    <input type="text" name="alamat_kantor_detail" class="form-control">
                </div>
                <br>
                <div class="form-input">
                    <label for="">Telp Kantor</label>
                    <input type="text" name="telp_kantor_detail" class="form-control">
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
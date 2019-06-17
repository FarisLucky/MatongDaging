<form action="<?=base_url('index.php/pengeluaran/tambah_aksi') ?>" method="post" enctype="multipart/form-data">
<div class="content-wrapper">
    <div class="container">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Tambah Data Pengeluaran</h4>
                <img id="logo_perusahaan" width="50px" src="<?php echo base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right" alt="">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <form action="<?php echo base_url(). 'pengeluaran/tambah_aksi'; ?>" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
          							<div class="form-group">
			                      <label for="id_nama">Pengeluaran</label>
			                      <input type="text" name = "nama_pengeluaran" class="form-control" id="id_nama">
			                      <small class="form-text text-danger"><?= form_error ('nama_pengeluaran'); ?></small>
			                    </div>
                                <div class="form-group">
                                  <label for="id_volume">Volume</label>
                                  <input type="number" name = "volume" class="form-control" id="id_volume">
                                  <small class="form-text text-danger"><?= form_error ('volume'); ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="id_satuan">Satuan</label>
                                  <input type="" name = "satuan" class="form-control" id="id_satuan">
                                  <small class="form-text text-danger"><?= form_error ('satuan'); ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="id_harga">Harga</label>
                                  <input type="text" name = "harga_satuan" class="form-control" id="id_harga">
                                  <small class="form-text text-danger"><?= form_error ('harga_satuan'); ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="id_bukti">bukti_kwitansi</label>
                                  <input type="file" name = "bukti_kwitansi" class="form-control" id="id_bukti">
                                </div>
			                    <td>  
                          </td>
			                    <button type="submit" class="btn btn-sm btn-success float-right">Simpan</button>
	                           </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>


                   
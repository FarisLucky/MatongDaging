<form action="<?php echo base_url(). 'index.php/pengeluaran/tambah_aksi'; ?>" method="post">
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Tambah Data Pengeluaran</h4>
                                <!-- <img id="logo_perusahaan" width="50px" src="<?= base_url().'assets/uploads/images/profil/user/'.$perusahaan[0]['logo_perusahaan'] ?>" class="float-right" alt=""> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- <img id="logo_perusahaan" width="50px" src="<?= base_url().'assets/uploads/images/profil/user/'.$perusahaan[0]['logo_perusahaan'] ?>" class="float-right" alt=""> -->
    							<div class="form-group">
			                      <label for="exampleInputName1">nama_pengeluaran</label>
			                      <input type="text" name = "nama_pengeluaran" class="form-control" id="exampleInputName1" placeholder="">
			                      <small class="form-text text-danger"><?= form_error ('nama_pengeluaran'); ?></small>
			                    </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">volume</label>
                                  <input type="text" name = "volume" class="form-control" id="exampleInputName1" placeholder="">
                                  <small class="form-text text-danger"><?= form_error ('volume'); ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">satuan</label>
                                  <input type="text" name = "satuan" class="form-control" id="exampleInputName1" placeholder="">
                                  <small class="form-text text-danger"><?= form_error ('satuan'); ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">harga_satuan</label>
                                  <input type="text" name = "harga_satuan" class="form-control" id="exampleInputName1" placeholder="">
                                  <small class="form-text text-danger"><?= form_error ('harga_satuan'); ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">tgl_buat</label>
                                  <input type="text" name = "tgl_buat" class="form-control" id="exampleInputName1" placeholder="">
                                  <small class="form-text text-danger"><?= form_error ('tgl_buat'); ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">bukti_kwitansi</label>
                                  <input type="text" name = "bukti_kwitansi" class="form-control" id="exampleInputName1" placeholder="">
                                  <small class="form-text text-danger"><?= form_error ('bukti_kwitansi'); ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">id_user</label>
                                  <input type="text" name = "id_user" class="form-control" id="exampleInputName1" placeholder="">
                                  <small class="form-text text-danger"><?= form_error ('id_user'); ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">id_properti</label>
                                  <input type="text" name = "id_properti" class="form-control" id="exampleInputName1" placeholder="">
                                  <small class="form-text text-danger"><?= form_error ('id_properti'); ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">id_kelompok</label>
                                  <input type="text" name = "id_kelompok" class="form-control" id="exampleInputName1" placeholder="">
                                  <small class="form-text text-danger"><?= form_error ('id_kelompok'); ?></small>
                                </div>
			                    <td></td>
			                    <button type="submit" class="btn btn-sm btn-success float-right">Simpan</button>
			                </form>
	                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


                   
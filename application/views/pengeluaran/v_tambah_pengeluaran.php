<form action="<?=base_url('index.php/pengeluaran/tambah_aksi') ?>" method="post" enctype="multipart/form-data">
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
      			                    </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">volume</label>
                                  <input type="text" name = "volume" class="form-control" id="exampleInputName1" placeholder="">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">satuan</label>
                                  <input type="text" name = "satuan" class="form-control" id="exampleInputName1" placeholder="">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">harga_satuan</label>
                                  <input type="text" name = "harga_satuan" class="form-control" id="exampleInputName1" placeholder="">
                                </div>
                                <div class="form-group">
                                  <label for="txt_file">bukti_kwitansi</label>
                                  <input type="file" name = "bukti_kwitansi" class="form-control" id="exampleInputName1" placeholder="">
                                </div>
			                    <td>  
                          </td>
			                    <button type="submit" class="btn btn-sm btn-success float-right">Simpan</button>
			                </form>
	                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


                   
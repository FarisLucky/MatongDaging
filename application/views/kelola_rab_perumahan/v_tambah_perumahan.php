<form action="<?php echo base_url(). 'index.php/kelola_rab_perumahan/tambah_aksi'; ?>" method="post">
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Tambah RAB Perumahan</h4>
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
                                  <label for="exampleInputName1">nama_detail</label>
                                  <input type="text" name = "nama_detail" class="form-control" id="exampleInputName1" placeholder="">
                                  <small class="form-text text-danger"><?= form_error ('nama_detail'); ?></small>
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
                                  <label for="exampleInputName1">Harga_satuan</label>
                                  <input type="text" name = "harga_satuan" class="form-control" id="exampleInputName1" placeholder="">
                                  <small class="form-text text-danger"><?= form_error ('harga_satuan'); ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">id_kelompok</label>
                                  <select name="id_kelompok" class="form-control">
                                    <?php foreach ($kategori as $key => $value) { ?>
                                      <option value="<?= $value->id_kelompok ?>"><?= $value->nama_kelompok ?></option>
                                    <?php } ?>
                                  </select>
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


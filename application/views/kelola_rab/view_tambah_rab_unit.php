
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                      <h4 class="dark txt_title d-inline-block mt-2">Tambah RAB Perumahan</h4>
                      <a href="<?= base_url().'rab/unit/'.$kembali ?>" class="float-right mt-2 text-primary"><i class="fa fa-arrow-left text-primary"></i> Lihat Properti</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                    <form action="<?php echo base_url(). 'rab/core_tambah_unit/'; ?>" method="post">
                    <input type="hidden" name="id_rab" value="<?= $data_id ?>">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                  <label for="exampleInputName1">nama_detail</label>
                                  <input type="text" name = "nama_detail" class="form-control" id="exampleInputName1" placeholder="">
                                  <small class="form-text text-danger"><?= form_error ('nama_detail'); ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">volume</label>
                                  <input type="number" name = "volume" class="form-control" id="exampleInputName1" placeholder="">
                                  <small class="form-text text-danger"><?= form_error ('volume'); ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">satuan</label>
                                  <input type="text" name = "satuan" class="form-control" id="exampleInputName1" placeholder="">
                                  <small class="form-text text-danger"><?= form_error ('satuan'); ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">Harga_satuan</label>
                                  <input type="number" name = "harga_satuan" class="form-control" id="exampleInputName1" placeholder="">
                                  <small class="form-text text-danger"><?= form_error ('harga_satuan'); ?></small>
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputName1">id_kelompok</label>
                                  <select name="select_kelompok" class="form-control">
                                  <option value=""> -- Pilih Kelompok --</option>
                                    <?php foreach ($kelompok_rab as $key => $value) { ?>
                                      <option value="<?= $value->id_kelompok ?>"><?= $value->nama_kelompok ?></option>
                                    <?php } ?>
                                  </select>
                                  <small class="form-text text-danger"><?= form_error ('select_kelompok'); ?></small>
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


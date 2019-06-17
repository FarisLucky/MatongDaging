
<div class="content-wrapper">
  <div class="container">
    <div class="card">
      <div class="card-body p-4">
        <div class="row">
            <div class="col-sm-12">
              <h4 class="d-inline-block mt-2">Tambah RAB Bangunan</h4>
              <a href="<?= base_url().'rab/properti/'.$kembali ?>" class="float-right" id="kembali"><i class="fa fa-arrow-left text-primary mt-2" ></i> Kembali</a>
            </div>
        </div>
      </div>
  </div>
  <br>
  <div class="card">
      <div class="card-body p-4">
        <div class="row">
            <div class="col-sm-12">
                <form action="<?php echo base_url(). 'rab/tambah_aksi'; ?>" method="post">
                <input type="hidden" name="txt_hidden" value="<?= $data_id ?>">
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="form-group">
                            <label for="exampleInputName1">nama_detail</label>
                            <input type="text" name = "nama_detail" class="form-control" id="exampleInputName1" placeholder="Nama">
                            <small class="form-text text-danger"><?= form_error ('nama_detail'); ?></small>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputName1">volume</label>
                            <input type="number" name = "volume" class="form-control" id="exampleInputName1" placeholder="Volume">
                            <small class="form-text text-danger"><?= form_error ('volume'); ?></small>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputName1">satuan</label>
                            <input type="text" name = "satuan" class="form-control" id="exampleInputName1" placeholder="Satuan">
                            <small class="form-text text-danger"><?= form_error ('satuan'); ?></small>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputName1">harga_satuan</label>
                            <input type="number" name = "harga_satuan" class="form-control" id="exampleInputName1" placeholder="Harga">
                            <small class="form-text text-danger"><?= form_error ('harga_satuan'); ?></small>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputName1">kelompok</label>
                            <select name="select_kelompok" class="form-control">
                            <option value="">-- Pilih Kelompok --</option>
                              <?php foreach ($kelompok_rab as $key => $value) { ?>
                                <option value="<?= $value->id_kelompok ?>"><?= $value->nama_kelompok ?></option>
                              <?php } ?>
                            </select>
                            <small class="form-text text-danger"><?= form_error ('select_kelompok'); ?></small>
                          </div>
                    <button type="submit" class="btn btn-sm btn-success float-right">Simpan</button>
                </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>


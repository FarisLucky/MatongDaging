<form action="<?php echo base_url(). 'index.php/type_id/tambah_aksi'; ?>" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">nama_type</label>
                      <input type="text" name = "nama_type" class="form-control" id="exampleInputName1" placeholder="">
                      <small class="form-text text-danger"><?= form_error ('nama_type'); ?></small>
                    </div>
                    <td></td>
                   <button type="submit" class="btn btn-sm btn-success float-right">Simpan</button>
                </form>
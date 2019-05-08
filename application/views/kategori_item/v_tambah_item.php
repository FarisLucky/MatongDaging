<form action="<?php echo base_url(). 'index.php/kategori_item/tambah_aksi'; ?>" method="post">
<div class="form-group">
  <label for="exampleInputName1">nama_kelompok</label>
  <input type="text" name = "nama_kelompok" class="form-control" id="exampleInputName1" placeholder="">
  <small class="form-text text-danger"><?= form_error ('nama_kelompok'); ?></small>
</div>
<td></td>
<button type="submit" class="btn btn-sm btn-success float-right">Simpan</button>
</form>
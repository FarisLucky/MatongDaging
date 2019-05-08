<?php foreach($kategori_item as $k){ ?>
<form action="<?php echo base_url(). 'index.php/kategori_item/update'; ?>" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">nama_kelompok</label>
                        <input type="hidden" name = "id_kelompok" value = "<?php echo $k->id_kelompok ?>"class="form-control" id="exampleInputName1" placeholder="">
                      <input type="text" name = "nama_kelompok" value = "<?php echo $k->nama_kelompok ?>"class="form-control" id="exampleInputName1" placeholder="">
                    </div>
                    <td></td>
                    <button type="submit" class="btn btn-sm btn-success float-right">Simpan</button>
                </form>
                <?php } ?>
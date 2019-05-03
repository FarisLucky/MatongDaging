<?php foreach($kategori_kelompok as $k){ ?>
<form action="<?php echo base_url(). 'index.php/kategori_kelompok/update'; ?>" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">nama_kategori</label>
                        <input type="hidden" name = "id_kategori" value = "<?php echo $k->id_kategori ?>"class="form-control" id="exampleInputName1" placeholder="">
                      <input type="text" name = "nama_kategori" value = "<?php echo $k->nama_kategori ?>"class="form-control" id="exampleInputName1" placeholder="">
                    </div>
                    <td></td>
                    <td><input type="submit" value="Simpan"></td>
                </form>
                <?php } ?>
<?php foreach($type_id_card as $t){ ?>
<form action="<?php echo base_url(). 'index.php/type_id/update'; ?>" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">nama_type</label>
                        <input type="hidden" name = "id_type" value = "<?php echo $t->id_type ?>"class="form-control" id="exampleInputName1" placeholder="">
                      <input type="text" name = "nama_type" value = "<?php echo $t->nama_type ?>"class="form-control" id="exampleInputName1" placeholder="">
                    </div>
                    <td></td>
                   <button type="submit" class="btn btn-sm btn-success float-right">Simpan</button>
                </form>
                <?php } ?>
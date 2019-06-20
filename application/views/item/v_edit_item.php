<?php foreach($kategori_item as $k){ ?>
	<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Edit Kategori Item</h4>
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
                    <form action="<?php echo base_url(). 'item/update'; ?>" method="post">
                        <input type="hidden" name = "id_kelompok" value = "<?php echo $k->id_kelompok ?>">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                <label for="exampleInputName1">nama_kelompok</label>
                                    <input type="text" name = "nama_kelompok" value = "<?php echo $k->nama_kelompok ?>"class="form-control" id="exampleInputName1" placeholder="">
                                </div>
                            </div>
                            <div class="col-sm-6">
								<div class="form-group">
                                    <label for="item_name">nama_kelompok</label>
                                    <select name="select_kategori" class="form-control">
                                        <option value="">-- Pilih Kategori Kelompok</option>
                                        <?php $select = ""; foreach ($kategori as $key => $value) :
                                            if ($value->id_kategori == $k->id_kategori) {
                                                $select = "selected";
                                            }?>
                                        <option value="<?= $value->id_kategori ?>" <?= $select ?>><?= $value->nama_kategori ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text text-danger"><?= form_error ('select_kategori'); ?></small>
                                </div>
                            </div>
                            <div class="col-sm-6">
			                    <button type="submit" class="btn btn-sm btn-success ">Simpan</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
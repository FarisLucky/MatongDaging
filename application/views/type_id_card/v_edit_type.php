<?php foreach($type_id_card as $t){ ?>
<form action="<?php echo base_url(). 'index.php/type_id/update'; ?>" method="post">
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Edit Type Id Card</h4>
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
			                      <label for="exampleInputName1">nama_type</label>
			                        <input type="hidden" name = "id_type" value = "<?php echo $t->id_type ?>"class="form-control" id="exampleInputName1" placeholder="">
			                      <input type="text" name = "nama_type" value = "<?php echo $t->nama_type ?>"class="form-control" id="exampleInputName1" placeholder="">
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
                <?php } ?>
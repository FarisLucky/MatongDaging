<?php foreach($pengeluaran as $p){ ?>
<form action="<?php echo base_url(). 'index.php/pengeluaran/update'; ?>" method="post">
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Edit Pengeluaran</h4>
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
                              <label for="exampleInputName1">nama_pengeluaran</label>
                                <input type="hidden" name = "id_pengeluaran" value = "<?php echo $p->id_pengeluaran ?>"class="form-control" id="exampleInputName1" placeholder="">
                              <input type="text" name = "nama_pengeluaran" value = "<?php echo $p->nama_pengeluaran ?>"class="form-control" id="exampleInputName1" placeholder="">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputName1">volume</label>
                              <input type="text" name = "volume" value = "<?php echo $p->volume ?>"class="form-control" id="exampleInputName1" placeholder="">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputName1">satuan</label>
                              <input type="text" name = "satuan" value = "<?php echo $p->satuan ?>"class="form-control" id="exampleInputName1" placeholder="">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputName1">harga_satuan</label>
                              <input type="text" name = "harga_satuan" value = "<?php echo $p->harga_satuan ?>"class="form-control" id="exampleInputName1" placeholder="">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputName1">bukti_kwitansi</label>
                              <input type="file" name = "bukti_kwitansi" value = "<?php echo $p->bukti_kwitansi ?>"class="form-control" id="exampleInputName1" placeholder="">
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
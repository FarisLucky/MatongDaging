<div class="content-wrapper" id="laporan_view_unit">
    <div class="container">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Laporan Unit</h4>
                        <img id="logo_perusahaan" width="50px" src="<?php echo base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right" alt="">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <form action="<?= base_url().'laporanunit/search' ?>" method="post">
                        <div class="form-group">
                            <label for="id_status">Pilih Status</label>
                            <select name="status_item" id="id_status" class="form-control">
                                <option value=""> -- Pilih Status -- </option>
                                <option value="Sudah Terjual" <?php echo ($id == "Sudah Terjual") ? "Selected" : "" ; ?> >Sudah Terjual</option>
                                <option value="Belum Terjual" <?php echo ($id == "Belum Terjual") ? "Selected" : "" ; ?> >Belum Terjual</option>
                            </select>
                        </div>
                    </div>
                    
                    <?php if ($_SESSION['id_akses'] === "1") { ?>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="properti_id">Pilih Properti</label>
                            <select name="properti" id="id_properti" class="form-control text-center">
                                <option value=""> -- Properti -- </option>
                                <?php foreach ($properti as $key => $value) { ?>
                                    <option value="<?= $value->id_properti ?>"  <?php echo ($id_properti == $value->id_properti) ? "Selected" : "" ; ?>><?= $value->nama_properti ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="unit_id">Pilih Unit</label>
                            <select name="id_unit" id="id_unit" class="form-control text-center">
                                <option value=""> -- Unit -- </option>
                            </select>
                        </div>
                    </div>
                    <?php } ?>
                        
                    <div class="col-sm-3 mt-4 pl-0">
                        <button type="submit" class="btn btn-primary mr-2" id="btn_search"><i class="fa fa-search"></i>Search</button>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <a href="<?= base_url().'laporanunit/print' ?>" class="ml-3  mb-3 print"><i class="fa fa-print text-info"> Print</i></a>
                    <div class="col-sm-12">
                        <table id="tbl_laporan_unit" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Unit</th>
                                    <th>Type</th>
                                    <th>Tanah</th>
                                    <th>Bangunan</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Foto</th>
                                    <?php $aksi=""; if ($_SESSION["id_akses"] != 3) {
                                        $aksi = "<th>Aksi</th>";
                                    }; echo $aksi ;?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ; foreach ($unit as $key => $value) { 
                                    if ($value->status_unit == "sudah terjual") {
                                        $badge = "badge-success";
                                    }else{
                                        $badge = "badge-danger";
                                    }?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $value->nama_unit ?></td>
                                        <td><?= $value->type ?></td>
                                        <td><?= $value->luas_tanah ?></td>
                                        <td><?= $value->luas_bangunan ?></td>
                                        <td><?= $value->harga_unit ?></td>
                                        <td><div class="badge <?= $badge ?>"><?= $value->status_unit ?></div></td>
                                        <td><img src="<?= base_url()."assets/uploads/images/unit_properti/".$value->foto_unit ?>" width="50px"></td>
                                        <?php if ($_SESSION['id_akses'] == 3) {
                                            $td = '<td><button class="btn btn-info" data-id="'.$value->id_unit.'">Detail</button></td>';
                                        }else {
                                            $td = '<td><button class="btn btn-info btn-edit" data-id="'.$value->id_unit.'">Edit</button></td>';
                                        } echo $td; ?>
                                    </tr>
                                <?php $no++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal_laporan_calon">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Unit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body m-3">
        <div class="row">

        <?php foreach ($syarat_unit as $key => $value) { ?>
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="form-check form-check-flat">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="detail" id="sasaran_<?= $value->id_sasaran ?>" value="<?= $value->id_sasaran ?>" ><?php echo $value->nama_persyaratan ?>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        </div>
      </div>
    </div>
  </div>
</div>
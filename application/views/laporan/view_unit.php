<div class="content-wrapper">
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
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-6">
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
                            <div class="col-sm-6 mt-4 pl-0">
                                <button type="submit" class="btn btn-primary mr-2" id="btn_search"><i class="fa fa-search"></i>Search</button>
                                </form>
                            </div>
                        </div>
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
                                        <td><img src="<?= base_url()."assets/uploads/images/unit_properti/".$value->foto_unit ?>" alt="" width="50px"></td>
                                        <?php if ($_SESSION['id_akses'] != 3) {
                                            $td = '<td><button>Detail</button><td>';
                                        }else {
                                            $td = '<td><button>Edit</button></td>';
                                        } ?>
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
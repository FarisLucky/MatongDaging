<div class="content-wrapper" id="laporan_transaksi">
    <div class="container">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Laporan Transaksi Unit</h4>
                        <img id="logo_perusahaan" width="50px" src="<?php echo base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="properti_id">Pilih Properti</label>
                                        <select name="id_properti" id="id_properti" class="form-control text-center">
                                            <option value=""> -- Properti -- </option>
                                            <?php foreach ($properti as $key => $value) { ?>
                                                <option value="<?= $value->id_properti ?>"><?= $value->nama_properti ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="unit_id">Pilih Unit</label>
                                        <select name="id_unit" id="id_unit" class="form-control text-center">
                                            <option value=""> -- Unit -- </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" name="tgl_mulai" class="form-control" id="id_mulai">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Tanggal Akhir</label>
                                        <input type="date" name="tgl_akhir" class="form-control" id="id_akhir">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 pt-4">
                            <button type="submit" class="btn btn-primary mr-2" id="search_kontrol"><i class="fa fa-search"></i>Search</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <h5 class="d-inline">List Semua Transaksi Unit</h5>
                            <a href="<?= base_url('laporantransaksi/listunlock') ?>" class="btn btn-warning float-right"><i class="fa fa-unlock"></i> List Unlock</a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-hover table-bordered" id="tbl_transaksi_unit">
                                <thead class="thead-light">
                                    <tr>
                                        <th>PPJB</th>
                                        <th>Nama Konsumen</th>
                                        <th>Nama Rumah</th>
                                        <th>Nama Perumahan</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>User Pembuat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>                                 
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

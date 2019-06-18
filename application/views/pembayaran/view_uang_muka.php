<div class="content-wrapper" id="uang_muka">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Uang Muka</h4>
                                <img id="logo_perusahaan" width="50px" src="<?php echo base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="unit_id">Pilih Unit</label>
                                <select name="id_unit" id="id_unit" class="form-control text-center">
                                    <option value=""> -- Unit -- </option>
                                    <?php foreach ($unit as $key => $value) : ?>
                                        <option value="<?= $value->id_unit ?>"><?= $value->nama_unit ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2 pt-4">
                            <button type="submit" class="btn btn-primary mr-2" id="filter_bayar_um"><i class="fa fa-search"></i>Search</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-hover" id="tbl_uang_muka">
                                <thead>
                                    <th>Nama</th>
                                    <th>Nama Perumahan</th>
                                    <th>Nama Rumah</th>
                                    <th>Tanggal Uang Muka</th>
                                    <th>Status</th>
                                    <th>Periode</th>
                                    <th>Uang Muka</th>
                                    <th>Total Kesepakatan</th>
                                    <th>Total Transaksi</th>
                                    <th>Total Akhir</th>
                                    <th>Aksi</th>
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
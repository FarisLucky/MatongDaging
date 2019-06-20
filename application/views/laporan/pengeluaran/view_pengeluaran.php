<div class="content-wrapper" id="view_pengeluaran">
    <div class="container">
        <div class="card">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="dark txt_title d-inline-block mt-2">Laporan Pengeluaran </h4>
                        <img id="logo_perusahaan" width="50px" src="<?php echo base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right" alt="">
                    </div>
                </div>
                <hr>
                <form action="" method="POST">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="unit_id">Pilih Kelompok</label>
                                    <select name="id_kelompok" id="id_kelompok" class="form-control text-center">
                                        <option value=""> -- Kelompok -- </option>
                                        <?php foreach ($kelompok as $key => $value) { ?>
                                            <option value="<?= $value->id_kelompok ?>"><?= $value->nama_kelompok ?></option>
                                        <?php } ?>
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
                    <div class="col-sm-3 pt-4 px-0 mx-0">
                        <button type="submit" class="btn btn-primary" id="search_kontrol"><i class="fa fa-search"></i>Search</button>
                        <button type="submit" formaction="<?= base_url('laporanpengeluaran/printall') ?>" class="btn btn-warning"><i class="fa fa-print"></i>Print</button>
                    </div>
                </div>
                </form>
                <hr>
                <div class="row my-2">
                    <div class="col-sm-12">
                        <small class="text-normal"> * <small class="text-primary">Laporan ditampilkan Berdasarkan Properti yang sedang dikelola</small></small>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered table-hover" id="tbl_laporan_pengeluaran">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pengeluaran</th>
                                    <th>Kelompok</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total Harga</th>
                                    <th>Pembuat</th>
                                    <th>Tanggal Buat</th>
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
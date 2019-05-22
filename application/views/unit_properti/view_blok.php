<div class="content-wrapper" id="blok_unit">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="dark txt_title d-inline-block mt-2">Kelola Unit</h4>
                                <img id="logo_perusahaan" width="50px" src="<?= base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right" alt="">
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
                            <div class="col-sm-12">
                                <h5 class="d-inline-block">Blok Unit</h5>
                                <a href="<?= base_url() ?>unit_property" class="btn btn-dark float-right">Kembali</a>
                            </div>
                        </div>
                        <hr>
                        <form id="form_tambah" action="<?= base_url() ?>properti" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" class="form-control" name="txt_id" id="txt_id">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="txt_blok">Nama Blok</label>
                                                <input type="text" class="form-control" name="txt_blok" id="txt_blok" required>
                                            </div>
                                        </div>
                                    </div>                                
                                    <button type="submit" id="btn_simpan_properti" class="btn btn-success mr-2">Simpan</button>
                            </div>
                        </div>
                        </form> 
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-hover display responsive no-wrap" id="tbl_blok">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; foreach ($blok as $key => $value) : ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $value->nama_blok ?></td>
                                                <td><button type="button" class="btn btn-sm btn-primary mr-1" id="ubah_blok" data-id="<?= $value->id_blok ?>">Ubah</button><button type="button" class="btn btn-sm btn-danger mr-1" id="hapus_blok"  data-id="<?= $value->id_blok ?>">Hapus</button>
                                                </td>
                                            </tr>
                                        <?php $no++; endforeach; ?>
                                    </tbody>
                                </table>     
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
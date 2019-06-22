<div class="content-wrapper" id="view_password">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body p-4">
                        <h4 class="txt_title d-inline pt-2">Ganti Password</h4>
                        <img id="logo_perusahaan" width="50px" src="<?= base_url().'assets/uploads/images/properti/'.$img->logo_perusahaan ?>" class="float-right">
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url("profileuser/corepassword") ?>" method="POST" id="form_password">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pass_baru">Password Baru</label>
                                    <input type="password" name="pass_baru" id="pass_baru" class="form-control">
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <div class="form-check form-check-flat my-1">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="show_pw1">Show Password
                                        </label>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass_confirm">Confirm Password Baru</label>
                                    <input type="password" name="confirm_pass_baru" class="form-control" id="confirm_pass_baru">
                                        <div class="form-check form-check-flat my-1">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="show_pw3">Show Password
                                        </label>
                                        </div>
                                </div>
                                <div class="form-group">
                                    <label for="pass_lama">Password Lama</label>
                                    <input type="password" name="pass_lama" class="form-control" id="pass_lama">
                                        <div class="form-check form-check-flat my-1">
                                        <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input" name="show_pw2">Show Password
                                        </label>
                                        </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
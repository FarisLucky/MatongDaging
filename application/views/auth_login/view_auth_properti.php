<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Auth Properti || Sidepi</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/vendors/css/vendor.bundle.addons.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/custom/css/custom_css.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/custom/toastr/toastr.min.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
        <div class="row flex-grow">
          <div class="col-lg-12 mx-auto text-white">
            <form action="">
            <div class="row align-items-center d-flex flex-row mb-2">
              <div class="col-lg-6 text-lg-right pr-lg-5 pl-lg-4">
                  <h5 class="text-right mb-3">Pilih Perumahan</h5>
                  <div class="row justify-content-end">
                    <?php if (!empty($properti_user)) { 
                      $button = '<a class="text-white font-weight-medium btn pl-4 border-secondary pr-4 btn-success" href="'.base_url().'auth/core_auth_properti" id="pilih_properti">Pilih</a>';
                      foreach ($properti_user as $key => $value) {?>

                        <div class="col-sm-3 text-center">
                          <img src="<?= base_url() ?>assets/uploads/images/properti/<?= $value['foto'] ?>" alt="" class="img-thumbnail img-properti-auth">
                          <div class="form-radio">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input auth_title" name="check_properti" value="<?= $value['id'] ?>"> <?= $value['nama'] ?>
                            </label>
                          </div>
                        </div>

                    <?php }}else{ $button = "";?>

                      <h3>Data Kosong </h2>
                      <h3> { / } </h3>

                    <?php } ?>
                  </div>
              </div>
              <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                <h2 class="pl-2">Hi!</h2>
                <h3 class="font-weight-light ml-3">Stefan Leony</h3>
                <h3 class="font-weight-light ml-3 border-bottom d-inline-block pb-1">Marketing
                <h2 cllass="font-weight-light">^_^</h2></h3>
              </div>
            </div>
            </form>
            <div class="row mt-5">
              <div class="col-12 text-center mt-xl-2">
                <?= $button ?>
              </div>
            </div>
            <div class="row mt-1">
              <div class="col-12 text-center mt-xl-2">
                <a class="text-white font-weight-medium" href="<?= base_url() ?>auth/logout">Logout</a>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12 mt-xl-2">
                <p class="text-white font-weight-medium text-center">Copyright &copy; 2019 All rights reserved.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="<?= base_url() ?>assets/vendors/js/vendor.bundle.addons.js"></script>
  <script src="<?= base_url() ?>assets/custom/toastr/toastr.min.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="<?= base_url() ?>assets/js/off-canvas.js"></script>
  <script src="<?= base_url() ?>assets/js/misc.js"></script>
  <!-- endinject -->
  <script src="<?= base_url() ?>assets/custom/js/custom_auth.js"></script>
</body>

</html>
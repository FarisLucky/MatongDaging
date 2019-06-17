<!-- partial Main Menu -->
<?php $user = get_where('tbl_users',['id_user'=>$this->session->userdata['id_user']])->row(); ?>
<div class="container-fluid page-body-wrapper">

  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <div class="nav-link">
          <div class="profile-icon">
            <div class="profile-image">
              <img src="<?= base_url() ?>assets/uploads/images/profil/user/<?= $user->foto_user ?>" class="img-profil" >
            </div>
            <div class="text-wrapper">
              <p class="profile-name"><?= $user->nama_lengkap ?></p>
            </div>
          </div>
          <small class="badge badge-success akses_title"><?= $user->akses ?></small>
        </div>
      </li>
      <?php echo $menus ?>
    </ul>
  </nav>
  </li>
  </ul>
  </nav>
  <div class="main-panel">
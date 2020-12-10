  <!-- Navbar -->

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- SEARCH FORM -->
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
      <div class="input-group">
        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for...">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Menu -->
      <li class="nav-item">
        <a class="nav-link" onclick="botbeol()" style="cursor: pointer;">
          <i class="far fa-comments"></i>
          <span class="badge badge-warning navbar-badge">AI</span>
        </a>
      </li>

      <!-- Cart Menu -->
      <li class="nav-item">
        <a class="nav-link" onclick="krjg()" style="cursor: pointer;">
          <i class="fas fa-shopping-cart"></i>
          <?php if ($this->session->email) : $this->db->where('email_user', $this->session->email);
                                    $this->db->where('s_bayar', 0);
                                    $jml = $this->db->get('pesanan')->num_rows(); ?>
            <span class="badge badge-danger navbar-badge"><?= $jml ?></span>
          <?php else : ?>
            <span class="badge badge-danger navbar-badge">0</span>
          <?php endif; ?>
        </a>

      </li>

      <?php if ($this->session->has_userdata('email') || $this->session->has_userdata('admin')) : ?>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link" data-toggle="dropdown" id="userDropdown" role="button" href="">
            <img class="img-profile rounded-circle" src="<?= base_url() ?>assets/profile/<?= $user['gambar'] ?>" width="25">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small ml-1"><?= $user['nama'] ?></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="<?= base_url('profile/edit') ?>">
              <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="<?= base_url() ?>profile/logout">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
          </div>
        </li>
      <?php else : ?>
        <li class="nav-item">
          <a class="nav-link" id="user" href="<?= base_url() ?>profile/login">
            <img class="img-profile rounded-circle" src="<?= base_url('assets/profile/') . $user['gambar'] ?>" width="25">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small ml-1"><?= $user['nama'] ?></span>
          </a>
        </li>
      <?php endif; ?>

    </ul>
  </nav>
  <!-- /.navbar -->

  <script>
    function krjg(){
      // console.log("ok");
      <?php if (!$this->session->email) : ?>
        salah();
      <?php elseif($jml < 1) : ?>
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: 'Keranjang anda masih kosong',
          confirmButtonText: 'Belanja'
        });
      <?php else : ?>
        document.location.href = "<?= base_url('dashboard/detail_keranjang') ?>";
      <?php endif; ?>
    }
    function botbeol(){
      <?php if ($this->session->admin) : ?>
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Silahkan Login User'
        });
      <?php elseif(!$this->session->email) : ?>
        salah();
      <?php else : ?>
        document.location.href = "<?= base_url('ai') ?>";
      <?php endif; ?>
    }
  </script>
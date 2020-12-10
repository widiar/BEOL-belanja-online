<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link">
        <img src="<?= base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <?php $usr = $this->db->get_where('user', ['email' => $this->session->email])->row_array(); ?>
        <?php if (isset($usr)) : ?>
            <span class="brand-text font-weight-light ml-3"><?= $usr['nama']; ?></span>
        <?php else : ?>
            <span class="brand-text font-weight-light ml-3">BEOL</span>
        <?php endif; ?>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url() ?>" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p> Home </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>kategori/handphone" class="nav-link">
                        <i class="nav-icon fas fa-mobile-alt"></i>
                        <p> Handphone </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>kategori/laptop" class="nav-link">
                        <i class="nav-icon fas fa-laptop"></i>
                        <p> Laptop </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>kategori/tablet" class="nav-link">
                        <i class="nav-icon fas fa-tablet-alt"></i>
                        <p> Tablet </p>
                    </a>
                </li>
                <hr>
                <li class="nav-item">
                    <a href="<?= base_url('profile/logout') ?>" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i>
                        <p> Log Out </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
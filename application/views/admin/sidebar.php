<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url() ?>" class="brand-link">
      <img src="<?= base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">BEOL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p> Dashboard </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/data_barang') ?>" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p> Data Barang </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/invoice') ?>" class="nav-link">
              <i class="nav-icon fas fa-file-invoice"></i>
              <p> Invoices </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
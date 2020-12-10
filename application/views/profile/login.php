<div class="login-box">
  <div class="login-logo">
    <p><strong>Halaman Login</strong></p>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg text-center">
        <?= $this->session->flashdata('pesan') ?>
      </p>

      <form action="<?= base_url() ?>profile/login" method="post">
        <div class="form-group">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Email" name="email" value="<?= set_value('email') ?>">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <?= form_error('usernmae', '<small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group">
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
        </div>

        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <hr>
      <p class="mb-1 text-center">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0 text-center">
        <a href="<?= base_url() ?>profile/register" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="card direct-chat direct-chat-primary mt-5">
      <div class="card-header">
        <h3 class="card-title">Asisten Beol</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body boxai">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages" id="isidah">
          <!-- Message. Default to the left -->
        </div>

        <!-- /.card-body -->
        <div class="card-footer tempatpesan">
          <form action="<?= base_url('ai/tambah_chat') ?>" method="post" id="pesan">
            <div class="input-group">
              <input type="text" name="pesan_usr" placeholder="Type Message ..." class="form-control psnw" autocomplete="off">
              <span class="input-group-append">
                <button type="submit" name="submit" class="btn btn-primary">Send</button>
              </span>
            </div>
          </form>
        </div>
        <!-- /.card-footer-->
      </div>
      <!--/.direct-chat -->
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    loadData();
    $('#pesan').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        type: 'post',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(data) {
          console.log(data);
          loadData();
          resetPesan()
        }
      });
    });
  });


  function loadData() {
    $.get('<?= base_url('ai/ambil') ?>', function(data) {
      $('#isidah').html(data);
      $('.link_beli').click(function(e) {
        e.preventDefault();
        $.ajax({
          type: 'get',
          url: $(this).attr('href'),
          success: function() {
            loadData();
            resetPesan();
          }
        });
      });
      $('.bayardahsu').click(function(e) {
        e.preventDefault();
        $.ajax({
          type: 'post',
          url: $(this).attr('href'),
          success: function() {
            console.log('ok');
            loadData();
            resetPesan();
          }
        });
      });
    });
  }

  function resetPesan() {
    $('.psnw').val('');
    $('.psnw').focus();
  }
</script>
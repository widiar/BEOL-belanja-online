<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- content -->

  <div class="container-fluid">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?= base_url() ?>/assets/dist/img/slider1.jpg" class="d-block w-100 h-50" alt="...">
        </div>
        <div class="carousel-item">
          <img src="<?= base_url() ?>/assets/dist/img/slider2.jpg" class="d-block w-100 h-50" alt="...">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <div class="row text-center">
      <?php foreach ($barang as $brg) : ?>
        <div class="card mx-auto mt-2" style="width: 15rem;">
          <img src="<?= base_url() ?>assets/images/<?= $brg['gambar'] ?>" class="card-img-top" alt="...">
          <div class="card-body">
            <strong><?= $brg['nama_brg'] ?></strong>
            <br>
            <small><?= $brg['keterangan'] ?></small>
            <br>
            <span class="badge badge-pill badge-success mb-2">Rp. <?= number_format($brg['harga'], 0, ',', '.') ?></span>
            <!-- <a href="dashboard/tambah_keranjang/<?= $brg['id_brg']  ?>"> -->
              <button class="btn btn-primary btn-sm mb-2" onclick="tes(<?= $brg['id_brg'] ?>)">Tambah Ke Keranjang</button>
            <!-- </a> -->
            <?= anchor('dashboard/detail/' . $brg['id_brg'], '<div  class="btn btn-success btn-sm">Lihat Detail</div>') ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

<script>
  function tes(id){
    // console.log(id);
    <?php if (!$this->session->email) : ?>
      salah();
    <?php else : ?>
      document.location.href = "<?= base_url() ?>dashboard/tambah_keranjang/" + id;
    <?php endif; ?>
  }
</script>

</div>
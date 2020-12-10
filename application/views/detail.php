<div class="content-wrapper">
	<section class="content">
		<div class="container-fluid">
			<div class="card mt-3">
				<h5 class="card-header">Detail Produk</h5>
				<div class="card-body">
					<?php foreach ($barang as $brg) : ?>
						<div class="row">
							<div class="col-md-4 card-img-top"><img src="<?= base_url() ?>assets/images/<?= $brg['gambar'] ?>" height="300px"></div>
							<div class="col-md-8">
								<table class="table">
									<tr>
										<td>Nama Produk</td>
										<td><strong><?= $brg['nama_brg'] ?></strong></td>
									</tr>
									<tr>
										<td>Keterangan</td>
										<td><strong><?= $brg['keterangan'] ?></strong></td>
									</tr>
									<tr>
										<td>Kategori</td>
										<td><strong><?= $brg['kategori'] ?></strong></td>
									</tr>
									<tr>
										<td>Stok</td>
										<td><strong><?= $brg['stok'] ?></strong></td>
									</tr>
									<tr>
										<td>Harga</td>
										<td><strong>Rp. <?= number_format($brg['harga'], 0, ',', '.') ?></strong></td>
									</tr>
								</table>
								<?= anchor('dashboard/tambah_keranjang/' . $brg['id_brg'], '<div  class="btn btn-primary btn-sm mr-3">Tambah Ke Keranjang</div>') ?>
								<?= anchor('/', '<div  class="btn btn-success btn-sm">Kembali</div>') ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
</div>
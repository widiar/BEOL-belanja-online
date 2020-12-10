<div class="content-wrapper">
	<div class="container-fluid  ml-3">
		<h3><i class="fa fa-edit"></i>EDIT DATA BARANG</h3>

		<?php foreach ($barang as $brg) : ?>
			<form action="<?= base_url() ?>admin/data_barang/update" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id_brg" value="<?= $brg['id_brg'] ?>">
				<input type="hidden" name="gambar_lama" value="<?= $brg['gambar'] ?>">

				<div class="form-group">
					<label>Nama Barang</label>
					<input type="text" name="nama_brg" class="form-control" value="<?= $brg['nama_brg'] ?>">
				</div>
				<div class="form-group">
					<label>Keterangan</label>
					<input type="text" name="keterangan" class="form-control" value="<?= $brg['keterangan'] ?>">
				</div>
				<div class="form-group">
					<label>Kategori</label>
					<input type="text" name="kategori" class="form-control" value="<?= $brg['kategori'] ?>">
				</div>
				<div class="form-group">
					<label>Harga</label>
					<input type="number" name="harga" class="form-control" value="<?= $brg['harga'] ?>">
				</div>
				<div class="form-group">
					<label>Stok</label>
					<input type="number" name="stok" class="form-control" value="<?= $brg['stok'] ?>">
				</div>
				<div class="form-group">
					<label>Gambar</label><br>
					<img src="<?= base_url() ?>assets/images/<?=$brg['gambar']?>" alt="" class="h-50">
					<input type="file" name="gambar" class="form-control mt-2" value="">
				</div>
				<button type="submit" class="btn btn-primary mb-3">Simpan</button>
			</form>
		<?php endforeach; ?>
	</div>
</div>
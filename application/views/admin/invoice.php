<div class="content-wrapper">
	<div class="container-fluid">
		<h3>Invoice Pemesanan Produk</h3>
		<table class="table table-bordered table-hover table-striped">
			<tr>
				<th>NO</th>
				<th>Nama Pemesan</th>
				<th>Email</th>
				<th>Aksi</th>
			</tr>
			<?php $no = 1;
			$tmp_nama = '';
			foreach ($barang as $inv) : ?>
				<?php if ($inv['nama'] != $tmp_nama) : ?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td><?= $inv['nama'] ?></td>
						<td><?= $inv['email'] ?></td>
						<td><?= anchor('admin/invoice/detail/' . $inv['id'], '<div class="btn btn-primary btn-sm">Detail</div>') ?></td>
					</tr>
				<?php $tmp_nama = $inv['nama'];
					endif; ?>
			<?php endforeach; ?>
		</table>
	</div>
</div>
<div class="content-wrapper">
	<div class="container-fluid">
		<h3>Keranjang Belanja</h3>

		<table class="table table-bordered table-striped table-hover">
			<tr>
				<th>NO</th>
				<th>Nama Produk</th>
				<th>Jumlah</th>
				<th>Harga</th>
				<th>Sub-Total</th>
				<th class="text-center">Aksi</th>
			</tr>

			<?php $no = 1;
			$total = 0;
			foreach ($pesanan as $item) : $subtotal = $item['harga'] * $item['jumlah'];
				$total += $subtotal;  ?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $item['nama_brg'] ?></td>
					<td><?= $item['jumlah'] ?></td>
					<td align="right">Rp. <?= number_format($item['harga'], 0, ',', '.') ?></td>
					<td align="right">Rp. <?= number_format($subtotal, 0, ',', '.') ?></td>
					<td onclick="return confirm('Yakin Hapus?')" class="text-center">
						<a href="<?= base_url('dashboard/hapus_keranjang_id/') . $item['id'] ?>">
							<div class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></div>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="3">
				<td class="text-center">TOTAL</td>
				<td align="right">Rp. <?= number_format($total, 0, ',', '.') ?></td>
				</td>
			</tr>
		</table>
		<div align="right">
			<a onclick="return confirm('Yakin hapus?')" href="<?= base_url() ?>dashboard/hapus_keranjang">
				<div class="btn btn-danger">Hapus Keranjang</div>
			</a>
			<a href="<?= base_url() ?>">
				<div class="btn btn-primary">Lanjut Belanja</div>
			</a>
			<a href="<?= base_url() ?>dashboard/pembayaran">
				<div class="btn btn-success">Pembayaran</div>
			</a>
		</div>
	</div>
</div>
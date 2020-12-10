<div class="content-wrapper">
	<div class="container-fluid">
		<h3>
			Detail Pesanan dari
			<div class="btn btn-sm btn-success"><?= $invoice[0]['nama'] ?></div>
		</h3>
		<table class="table table-bordered table-striped table-hover">
			<tr>
				<th>NO</th>
				<th>NAMA PRODUK</th>
				<th>JUMLAH PESANAN</th>
				<th>HARGA SATUAN</th>
				<th>SUB-TOTAL</th>
				<th>TANGGAL DIPESAN</th>
			</tr>
			<?php $no = 1;
												$total = 0;
												foreach ($invoice as $inv) :
													$subtotal = $inv['harga_p'] * $inv['jumlah'];
													$total += $subtotal;
			?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $inv['nama_brg'] ?></td>
					<td><?= $inv['jumlah'] ?></td>
					<td align="right">Rp. <?= number_format($inv['harga_p'], 0, ',', '.') ?></td>
					<td align="right">Rp. <?= number_format($subtotal, 0, ',', '.') ?></td>
					<td><?= $inv['tgl_pesanan'] ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="5" align="right"><strong>Grand Total</strong></td>
				<td align="right"><strong>Rp. <?= number_format($total, 0, ',', '.') ?></strong></td>
			</tr>
		</table>
		<a href="<?= base_url() ?>admin/invoice" class="btn btn-primary">Kembali</a>
	</div>
</div>
<div class="content-wrapper">
	<div class="container-fluid">
		<!-- <div class="row"> -->
		<div class="mx-auto text-center">
			<div class="btn btn-success mt-3">
				Total Belanja Anda Rp. <?= number_format($belanjaan, 0, ',', '.') ?>
			</div>
			<h4 class="my-3 text-center">Input Alamat Penerima</h4>
		</div>
		<!-- <div class="col-md-6"></div> -->
		<?php if (isset($user['nama'])) {
											$string = 'readonly';
										} ?>
		<div class="col-md-8 mx-auto">
			<form action="<?= base_url() ?>dashboard/prosesbayar" method="post">
				<div class="form-group">
					<label>Nama Lengkap</label>
					<input type="text" name="nama" value="<?= $user['nama'] ?>" class="form-control" <?= $string ?>>
				</div>
				<div class="form-group">
					<label>Alamat Lengkap</label>
					<input type="text" name="alamat" placeholder="Alamat Lengkap..." class="form-control" value="<?= $user['alamat'] ?>">
				</div>
				<div class="form-group">
					<label>No. Telepon</label>
					<input type="text" name="no_tlp" placeholder="Nomor Telepon..." class="form-control" value="<?= $user['no_tlp'] ?>">
				</div>
				<div class="form-group">
					<label>Jasa</label>
					<select name="jasa" id="" class="form-control">
						<option value="jne">JNE</option>
						<option value="tiki">TIKI</option>
						<option value="pos">Pos Indonesia</option>
						<option value="gojek">GOJEK</option>
					</select>
				</div>
				<div class="form-group">
					<label>Pilih Bank</label>
					<select name="bank" id="" class="form-control">
						<option value="bca">BCA - XXXXXXXX</option>
						<option value="bni">BNI - XXXXXXXX</option>
						<option value="bri">BRI - XXXXXXXX</option>
						<option value="mandiri">MANDIRI - XXXXXXXX</option>
					</select>
				</div>
				<button type="submit" class="btn btn-primary">BAYAR</button>
			</form>
		</div>
		<!-- <div class="col-md-2"></div> -->
		<!-- </div> -->
	</div>
</div>
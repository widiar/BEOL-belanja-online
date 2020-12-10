<div class="content-wrapper">
    <div class="container-fluid  ml-3">
        <h3><i class="fa fa-edit"></i>EDIT DATA USER</h3>

        <?php foreach ($user as $usr) : ?>
            <form action="<?= base_url('profile/update') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $usr['id'] ?>">
                <input type="hidden" name="gambar_lama" value="<?= $usr['gambar'] ?>">

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= $usr['nama'] ?>">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $usr['email'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <input type="text" name="alamat" class="form-control" value="<?= $usr['alamat'] ?>">
                </div>
                <div class="form-group">
                    <label>Provinsi</label>
                    <input type="text" name="provinsi" class="form-control" value="<?= $usr['provinsi'] ?>">
                </div>
                <div class="form-group">
                    <label>Kota</label>
                    <input type="text" name="kota" class="form-control" value="<?= $usr['kota'] ?>">
                </div>
                <div class="form-group">
                    <label>Kode Pos</label>
                    <input type="text" name="kodepos" class="form-control" value="<?= $usr['kode_pos'] ?>">
                </div>
                <div class="form-group">
                    <label>No Telp.</label>
                    <input type="text" name="no_tlp" class="form-control" value="<?= $usr['no_tlp'] ?>">
                </div>
                <div class="form-group">
                    <label>Gambar</label><br>
                    <img src="<?= base_url('assets/profile/') . $usr['gambar'] ?>" alt="" class="">
                    <input type="file" name="gambar" class="form-control mt-2" value="">
                </div>
                <button type="submit" class="btn btn-primary mb-3">Simpan</button>
            </form>
        <?php endforeach; ?>
    </div>
</div>
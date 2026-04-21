<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-4 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('dashboard_cafe/lihat_menu') ?>"
                        class="btn btn-outline-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <?php foreach ($menu as $m) { ?>
                        <form action="<?php echo site_url('dashboard_cafe/update_menu') ?>" method="post">
                            <input type="hidden" name="id_menu" value="<?php echo $m->id_menu ?>">
                            <div class="form-group">


                                <div class="form-group">
                                    <label>Nama Menu</label>
                                    <input type="text" class="form-control" name="nama_menu"
                                        value="<?php echo $m->nama_menu ?>">
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <input type="text" class="form-control" name="kategori"
                                        value="<?php echo $m->kategori ?>">
                                </div>
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="text" class="form-control" name="stok" value="<?php echo $m->stok ?>">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi"><?php echo $m->deskripsi ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="text" class="form-control" name="harga" value="<?php echo $m->harga ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Gambar saat ini</label><br>
                                    <img src="<?php echo base_url('assets/uploads/' . $m->gambar); ?>" width="100">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Upload Gambar Baru</label>
                                    <input type="file" name="gambar" class="form-control">
                                </div>

                                <div class="form-group"></br>
                                    <button type="submit" class="btn btn-warning btn-sm me-2">Update</button>
                                    <button type="reset" class="btn btn-secondary btn-sm">Batal</button>
                                </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
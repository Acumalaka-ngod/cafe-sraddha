<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-4 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('dashboard_cafe/lihat_menu') ?>"
                        class="btn btn-outline-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <?php if (!empty($menu)): ?>
                        <?php foreach ($menu as $m): ?>
                            <form action="<?php echo site_url('dashboard_cafe/update_menu') ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_menu" value="<?php echo $m->id_menu ?>">
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
                                    <input type="number" class="form-control" name="stok" value="<?php echo $m->stok ?>">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi"><?php echo $m->deskripsi ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" class="form-control" name="harga" value="<?php echo $m->harga ?>">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Gambar saat ini</label><br>
                                    <img src="<?php echo base_url('assets/uploads/' . $m->gambar); ?>" width="100" id="current-img">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Upload Gambar Baru (opsional)</label>
                                    <input type="file" name="gambar" id="gambar-edit" class="form-control" accept="image/*" onchange="previewNewImage(event)">
                                    <img id="preview-edit" class="mt-2" style="max-width: 200px; max-height: 200px; display: none;">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning btn-sm me-2">Update</button>
                                    <button type="reset" class="btn btn-secondary btn-sm">Batal</button>
                                </div>
                            </form>
                        <?php endforeach; ?>
                        <script>
                        function previewNewImage(event) {
                            const reader = new FileReader();
                            reader.onload = function() {
                                const preview = document.getElementById('preview-edit');
                                preview.src = reader.result;
                                preview.style.display = 'block';
                            }
                            reader.readAsDataURL(event.target.files[0]);
                        }
                        </script>
                    <?php else: ?>
                        <div class="alert alert-warning">Menu tidak ditemukan.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

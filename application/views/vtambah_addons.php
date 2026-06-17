<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-4 mt-3">
                <div class="card-header">
                    <a href="<?= site_url('dashboard_cafe/lihat_addons') ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('dashboard_cafe/simpan_addons') ?>" method="post">
                        <div class="form-group mb-3">
                            <label>Nama Addon <span class="text-danger">*</span></label>
                            <input type="text" name="nama_addon" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Harga Tambahan</label>
                            <input type="number" name="harga" class="form-control" min="0" value="0">
                        </div>
                        <div class="form-group mb-3">
                            <label>Kategori</label>
                            <input type="text" name="kategori" class="form-control" placeholder="misal: minuman, coffee, topping">
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="<?= site_url('dashboard_cafe/lihat_addons') ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

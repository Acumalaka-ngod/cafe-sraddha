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
                    <?php foreach ($addon as $a): ?>
                    <form action="<?= site_url('dashboard_cafe/update_addons') ?>" method="post">
                        <input type="hidden" name="id_addon" value="<?= $a->id_addon ?>">
                        <div class="form-group mb-3">
                            <label>Nama Addon <span class="text-danger">*</span></label>
                            <input type="text" name="nama_addon" class="form-control" value="<?= $a->nama_addon ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Harga Tambahan</label>
                            <input type="number" name="harga" class="form-control" min="0" value="<?= $a->harga ?>">
                        </div>
                        <div class="form-group mb-3">
                            <label>Kategori</label>
                            <input type="text" name="kategori" class="form-control" value="<?= $a->kategori ?>" placeholder="misal: minuman, coffee, topping">
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?= site_url('dashboard_cafe/lihat_addons') ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>

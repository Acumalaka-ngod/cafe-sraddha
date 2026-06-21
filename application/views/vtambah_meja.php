<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-4 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('dashboard_cafe/lihat_meja') ?>"
                        class="btn btn-outline-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <?php if ($error = $this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?= $error ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <form action="<?php echo site_url('dashboard_cafe/simpan_meja') ?>" method="post">
                        <div class="form-group">
                            <label for="no_meja">No Meja</label>
                            <input type="text" class="form-control" id="no_meja" name="no_meja" required>
                        </div>
                        <div class="form-group"></br>
                            <button type="submit" class="btn btn-primary">Tambah Meja</button>
                            <button type="reset" class="btn btn-secondary">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-4 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('dashboard_cafe/lihat_meja') ?>"
                        class="btn btn-outline-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <?php foreach ($meja as $mj) { ?>
                    <form action="<?php echo site_url('dashboard_cafe/update_meja') ?>" method="post">
                        <input type="hidden" name="id_meja" value="<?php echo $mj->id_meja ?>">
                        <div class="form-group">
                            <label>No Meja</label>
                            <input type="text" class="form-control" name="no_meja" value="<?php echo $mj->no_meja ?>" required>
                        </div>
                        <div class="form-group"></br>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-secondary">Batal</button>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>


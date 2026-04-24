<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-4 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('dashboard_cafe/lihat_user') ?>"
                        class="btn btn-outline-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <?php foreach ($user as $u) { ?>
                    <form action="<?php echo site_url('dashboard_cafe/update_user') ?>" method="post">
                        <input type="hidden" name="id_user" value="<?php echo $u->id_user ?>">
                        <div class="form-group">
                            <label for="nama">Nama User</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $u->nama ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $u->jabatan ?>" required>
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

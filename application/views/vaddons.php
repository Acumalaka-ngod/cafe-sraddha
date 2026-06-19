<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-4 mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Addons</h5>
                    <a href="<?= site_url('dashboard_cafe/tambah_addons') ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Addon
                    </a>
                </div>
                <div class="card-body">
                    <?php if ($message = $this->session->flashdata('message')): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <?= $message ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Addon</th>
                                    <th>Harga</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($addons as $a): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $a->nama_addon ?></td>
                                    <td>Rp <?= number_format($a->harga_addon, 0, ',', '.') ?></td>
                                    <td class="text-center">
                                        <a href="<?= site_url('dashboard_cafe/edit_addons/' . $a->id_addon) ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= site_url('dashboard_cafe/hapus_addons/' . $a->id_addon) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus addon ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($addons)): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada addon.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

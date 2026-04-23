<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <!-- ALERT -->
            <?php if (!empty($message)): ?>
                <div class="alert alert-success mx-3 mt-3"><?= $message ?></div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger mx-3 mt-3"><?= $error ?></div>
            <?php endif; ?>

            <div class="card mx-3 mt-3">

                <!-- HEADER -->
                <div class="card-header d-flex justify-content-between">
                    <a href="<?= site_url('dashboard_cafe/lihat_transaksi') ?>" class="btn btn-outline-primary btn-sm">
                        ← Kembali
                    </a>
                    <h6 class="mb-0">Detail Transaksi </h6>
                </div>

                <div class="card-body">

                    <!-- 🔥 TABLE DETAIL -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>Menu</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($detail as $d): ?>
                                    <tr>
                                        <td><?= $d->id_transaksi ?></td>
                                        <td><?= $d->nama_menu ?></td>
                                        <td><?= $d->jumlah ?></td>
                                        <td><?= $d->harga ?></td>
                                        <td><?= $d->subtotal ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </main>
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
                    <h6 class="mb-0">Detail Transaksi #<?= $transaksi->id_transaksi ?></h6>
                </div>

                <div class="card-body">

                    <!-- INFO TRANSAKSI -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <strong>Tanggal</strong><br>
                            <?= date('d/m/Y H:i', strtotime($transaksi->tanggal)) ?>
                        </div>

                        <div class="col-md-2">
                            <strong>No Meja</strong><br>
                            <?= $transaksi->no_meja ?>
                        </div>

                        <div class="col-md-3">
                            <strong>Kasir</strong><br>
                            <?= $transaksi->nama_user ?>
                        </div>

                        <div class="col-md-2">
                            <strong>Status</strong><br>
                            <span class="badge bg-info"><?= $transaksi->status_pesanan ?></span>
                        </div>

                        <div class="col-md-2">
                            <strong>Pembayaran</strong><br>
                            <span class="badge bg-success"><?= $transaksi->metode_pembayaran ?></span>
                        </div>
                    </div>

                    <hr>

                    <!-- TABLE DETAIL -->
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Menu</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($detail as $d) { ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $d->nama_menu ?></td>
                                        <td><?= $d->jumlah ?></td>
                                        <td>Rp <?= number_format($d->harga, 0, ',', '.') ?></td>
                                        <td>Rp <?= number_format($d->subtotal, 0, ',', '.') ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>

                            <!-- TOTAL -->
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Total</th>
                                    <th>Rp <?= number_format($transaksi->total_harga, 0, ',', '.') ?></th>
                                </tr>
                            </tfoot>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </main>
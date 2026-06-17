<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="card mx-3 mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <a href="<?= site_url('dashboard_cafe/lihat_transaksi') ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <h6 class="mb-0">Detail Invoice</h6>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th style="width: 140px;">No Invoice</th>
                                    <td>: INV <strong><?= $transaksi->no_invoce ?></strong></td>
                                </tr>
                                <tr>
                                    <th>No Pesanan</th>
                                    <td>: SHD <strong><?= $transaksi->no_pesanan ?></strong></td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>: <?= date('d/m/Y H:i', strtotime($transaksi->tanggal)) ?></td>
                                </tr>
                                <tr>
                                    <th>Meja</th>
                                    <td>: <?= $transaksi->no_meja ?></td>
                                </tr>
                                <tr>
                                    <th>Kasir</th>
                                    <td>: <?= $transaksi->nama_user ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th style="width: 140px;">Status Pesanan</th>
                                    <td>:
                                        <?php if ($transaksi->status_pesanan == 'selesai'): ?>
                                            <span class="badge bg-success">Selesai</span>
                                        <?php elseif ($transaksi->status_pesanan == 'diproses'): ?>
                                            <span class="badge bg-warning text-dark">Diproses</span>
                                        <?php elseif ($transaksi->status_pesanan == 'dibatalkan'): ?>
                                            <span class="badge bg-danger">Dibatalkan</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?= $transaksi->status_pesanan ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status Pembayaran</th>
                                    <td>:
                                        <?php if ($transaksi->status_pembayaran == 'paid'): ?>
                                            <span class="badge bg-success">Lunas</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Metode Bayar</th>
                                    <td>: <?= $transaksi->metode_pembayaran ?: '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <h6 class="mb-3">Pesanan</h6>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Menu</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-end">Harga</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($detail as $d): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $d->nama_menu ?></td>
                                    <td class="text-center"><?= $d->jumlah ?></td>
                                    <td class="text-end">Rp <?= number_format($d->harga, 0, ',', '.') ?></td>
                                    <td class="text-end">Rp <?= number_format($d->subtotal, 0, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="table-active">
                                    <th colspan="4" class="text-end">Total</th>
                                    <th class="text-end">Rp <?= number_format($transaksi->total_harga, 0, ',', '.') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="<?= site_url('dashboard_cafe/cetak_invoice/' . $transaksi->id_transaksi) ?>" class="btn btn-success" target="_blank">
                            <i class="fas fa-print"></i> Cetak Invoice
                        </a>
                        <a href="<?= site_url('dashboard_cafe/lihat_transaksi') ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

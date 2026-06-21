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
                                    <td>: <strong><?= $transaksi->no_invoice ?></strong></td>
                                </tr>
                                <tr>
                                    <th>No Pesanan</th>
                                    <td>: <strong><?= $transaksi->no_pesanan ?></strong></td>
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
                                    <th>Addons</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-end">Harga</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($detail as $d): 
                                    $addon_list = $addon_map[$d->id_detail] ?? [];
                                    $addon_text = '-';
                                    $addon_total = 0;
                                    if ($addon_list) {
                                        $parts = [];
                                        foreach ($addon_list as $a) {
                                            $parts[] = $a->nama_addon . ($a->harga_addon > 0 ? ' (+Rp ' . number_format($a->harga_addon, 0, ',', '.') . ')' : '');
                                            $addon_total += $a->harga_addon;
                                        }
                                        $addon_text = implode('<br>', $parts);
                                    }
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $d->nama_menu ?></td>
                                    <td><?= $addon_text ?></td>
                                    <td class="text-center"><?= $d->jumlah ?></td>
                                    <td class="text-end">Rp <?= number_format($d->harga, 0, ',', '.') ?></td>
                                    <td class="text-end">Rp <?= number_format($d->subtotal + ($addon_total * $d->jumlah), 0, ',', '.') ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="table-active">
                                    <th colspan="5" class="text-end">Total</th>
                                    <th class="text-end">Rp <?= number_format($transaksi->total_harga, 0, ',', '.') ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <?php if ($transaksi->status_pesanan !== 'selesai' && $transaksi->status_pesanan !== 'dibatalkan'): ?>
                            <?php if ($transaksi->metode_pembayaran === 'Tunai' && $transaksi->status_pembayaran === 'pending'): ?>
                                <button class="btn btn-warning btn-pay-print"
                                    data-id="<?= $transaksi->id_transaksi ?>">
                                    <i class="fas fa-cash-register"></i> Selesaikan Pembayaran
                                </button>
                            <?php else: ?>
                                <button class="btn btn-success btn-finish-order"
                                    data-id="<?= $transaksi->id_transaksi ?>">
                                    <i class="fas fa-check"></i> Selesaikan Pesanan
                                </button>
                            <?php endif; ?>
                        <?php endif; ?>
                        <a href="<?= site_url('dashboard_cafe/cetak_invoice/' . $transaksi->id_transaksi) ?>"
                            class="btn btn-success" style="color: #FFFFFF !important;" target="_blank">
                            <i class="fas fa-print"></i> Cetak Struk
                        </a>
                        <a href="<?= site_url('dashboard_cafe/lihat_transaksi') ?>" class="btn btn-secondary" style="color: #FFFFFF !important;">
                            <i class="fas fa-times"></i> Tutup
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.querySelector('.btn-pay-print')?.addEventListener('click', function() {
            if (!confirm('Konfirmasi pembayaran tunai?')) return;
            var btn = this;
            var id = btn.dataset.id;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

            fetch('<?= site_url('dashboard_cafe/quick_update_transaksi') ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
                body: 'id_transaksi=' + id
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.status === 'success') {
                    window.open('<?= site_url('dashboard_cafe/cetak_invoice') ?>/' + id, '_blank');
                    window.location.href = '<?= site_url('dashboard_cafe') ?>';
                } else {
                    alert(data.message);
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-cash-register"></i> Selesaikan Pembayaran';
                }
            })
            .catch(function() {
                alert('Terjadi kesalahan');
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-cash-register"></i> Selesaikan Pembayaran';
            });
        });

        document.querySelector('.btn-finish-order')?.addEventListener('click', function() {
            if (!confirm('Konfirmasi pesanan selesai?')) return;
            var btn = this;
            var id = btn.dataset.id;
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

            fetch('<?= site_url('dashboard_cafe/quick_update_transaksi') ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest' },
                body: 'id_transaksi=' + id
            })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.status === 'success') {
                    window.location.href = '<?= site_url('dashboard_cafe') ?>';
                } else {
                    alert(data.message);
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fas fa-check"></i> Selesaikan Pesanan';
                }
            })
            .catch(function() {
                alert('Terjadi kesalahan');
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-check"></i> Selesaikan Pesanan';
            });
        });
    </script>

<div id="layoutSidenav_content" style="background-color: #F3E7D3;">
    <main>
        <div class="container-fluid px-4 py-4">

            <!-- Greeting Section -->
            <div class="greeting-section mb-4">
                <h2>Selamat Datang, <?= $this->session->userdata('nama') ?? 'Admin' ?> ☕</h2>
                <p>Pantau perkembangan bisnis Sraddha Coffee hari ini.</p>
            </div>

            <!-- Stat Cards -->
            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card h-100">
                        <div class="stat-icon stat-icon-primary">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="stat-label">Total Penjualan</div>
                        <div class="stat-value">Rp <?= number_format($total_pendapatan ?? 0, 0, ',', '.') ?></div>
                        <div class="stat-change" style="color: #7C6A5B;">
                            <i class="fas fa-arrow-up me-1"></i>Hari ini: Rp <?= number_format($pendapatan_hari_ini ?? 0, 0, ',', '.') ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card h-100">
                        <div class="stat-icon stat-icon-dark">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="stat-label">Total Pesanan</div>
                        <div class="stat-value"><?= number_format($total_transaksi ?? 0, 0, ',', '.') ?></div>
                        <div class="stat-change" style="color: #7C6A5B;">
                            <i class="fas fa-clock me-1"></i>Hari ini: <?= $pesanan_hari_ini ?? 0 ?> pesanan
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card h-100">
                        <div class="stat-icon stat-icon-sidebar">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="stat-label">Total Meja</div>
                        <div class="stat-value"><?= number_format($total_meja ?? 0, 0, ',', '.') ?></div>

                        <div class="stat-change" style="color: #7C6A5B;">
                            <i class="fas fa-book-check me-1"></i>Terdaftar
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card stat-card h-100">
                        <div class="stat-icon stat-icon-hover">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div class="stat-label">Total Produk</div>
                        <div class="stat-value"><?= number_format($total_menu ?? 0, 0, ',', '.') ?></div>
                        <div class="stat-change" style="color: #7C6A5B;">
                            <i class="fas fa-box me-1"></i>Menu tersedia
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart & Produk Terlaris -->
            <div class="row g-4 mb-4">
                <div class="col-xl-8">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-chart-line me-2" style="color: #9B673A;"></i>Grafik Penjualan</span>
                            <span class="badge bg-primary">Tahunan</span>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="salesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <i class="fas fa-fire me-2" style="color: #D39D38;"></i>Produk Terlaris
                        </div>
                        <div class="card-body">
                            <?php if (!empty($produk_terlaris)): ?>
                                <?php $no = 1; foreach ($produk_terlaris as $p): ?>
                                <div class="product-item">
                                    <img src="<?= base_url('assets/uploads/' . ($p->gambar ?: 'default.png')) ?>"
                                         class="product-img"
                                         alt="<?= $p->nama_menu ?>"
                                         onerror="this.src='https://via.placeholder.com/48/E7D9C7/7C6A5B?text=+'">
                                    <div class="product-info flex-grow-1">
                                        <h6><?= $p->nama_menu ?></h6>
                                        <small><?= $p->total_terjual ?> terjual &middot; Rp <?= number_format($p->total_penjualan, 0, ',', '.') ?></small>
                                    </div>
                                    <span class="badge bg-primary">#<?= $no++ ?></span>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-4 text-secondary">
                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                    <p class="mb-0">Belum ada data penjualan</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Pesanan Terbaru -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-clock me-2" style="color: #9B673A;"></i>Pesanan Terbaru</span>
                    <!-- <a href="<?= site_url('dashboard_cafe/lihat_transaksi') ?>" class="btn btn-outline-primary btn-sm">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a> -->
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Meja</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Pembayaran</th>
                                    <th class="text-end">Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transaksi ?? [] as $t): ?>
                                <tr>
                                    <td><strong><?= $t->no_invoice ?: 'INV-' . str_pad($t->id_transaksi, 4, '0', STR_PAD_LEFT) ?></strong></td>
                                    <td>Meja <?= $t->no_meja ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($t->tanggal)) ?></td>
                                    <td>
                                        <?php if ($t->status_pesanan == 'selesai'): ?>
                                            <span class="badge bg-success">Selesai</span>
                                        <?php elseif ($t->status_pesanan == 'diproses'): ?>
                                            <span class="badge bg-warning">Diproses</span>
                                        <?php elseif ($t->status_pesanan == 'dibatalkan'): ?>
                                            <span class="badge bg-danger">Dibatalkan</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary"><?= $t->status_pesanan ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($t->status_pembayaran == 'paid'): ?>
                                            <span class="badge bg-success">Lunas</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning">Pending</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end fw-bold">Rp <?= number_format($t->total_harga, 0, ',', '.') ?></td>
                                    <td>
                                        <a href="<?php echo site_url('dashboard_cafe/edit_transaksi/' . $t->id_transaksi); ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-sync"></i> Update Status
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </main>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
(function() {
    var salesData = <?= json_encode($monthly_sales ?? []) ?>;
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
    var labels = [];
    var values = [];

    salesData.forEach(function(row) {
        labels.push(monthNames[row.month - 1] + ' ' + row.year);
        values.push(parseFloat(row.sales) || 0);
    });

    labels.reverse();
    values.reverse();

    if (values.length === 0) {
        labels = monthNames;
        values = new Array(12).fill(0);
    }

    var ctx = document.getElementById('salesChart').getContext('2d');
    var gradient = ctx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(155, 103, 58, 0.3)');
    gradient.addColorStop(1, 'rgba(155, 103, 58, 0.01)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Penjualan',
                data: values,
                borderColor: '#9B673A',
                backgroundColor: gradient,
                borderWidth: 3,
                pointBackgroundColor: '#9B673A',
                pointBorderColor: '#FAF7F2',
                pointBorderWidth: 3,
                pointRadius: 5,
                pointHoverRadius: 7,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(231, 217, 199, 0.5)' },
                    ticks: {
                        callback: function(v) { return 'Rp ' + v.toLocaleString(); },
                        color: '#7C6A5B'
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#7C6A5B' }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
})();
</script>

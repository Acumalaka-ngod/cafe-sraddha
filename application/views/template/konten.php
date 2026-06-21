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
                            <i class="fas fa-arrow-up me-1"></i>Hari ini: Rp
                            <?= number_format($pendapatan_hari_ini ?? 0, 0, ',', '.') ?>
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
                            <i class="fas fa-book me-1"></i>Terdaftar
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
                                <?php $no = 1;
                                foreach ($produk_terlaris as $p): ?>
                                    <div class="product-item">
                                        <img src="<?= base_url('assets/uploads/' . ($p->gambar ?: 'default.png')) ?>"
                                            class="product-img" alt="<?= $p->nama_menu ?>"
                                            onerror="this.src='https://via.placeholder.com/48/E7D9C7/7C6A5B?text=+'">
                                        <div class="product-info flex-grow-1">
                                            <h6><?= $p->nama_menu ?></h6>
                                            <small><?= $p->total_terjual ?> terjual &middot; Rp
                                                <?= number_format($p->total_penjualan, 0, ',', '.') ?></small>
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
            <div class="card mb-4" id="pesanan-terbaru">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="fas fa-clock me-2" style="color: #9B673A;"></i>Pesanan Terbaru</span>
                    <!-- <a href="<?= site_url('dashboard_cafe/lihat_transaksi') ?>" class="btn btn-outline-primary btn-sm">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a> -->
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Meja</th>
                                    <th>Tanggal</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Status Pesanan</th>
                                    <th>Pembayaran</th>
                                    <th class="text-end">Total</th>
                                    <th>Update Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transaksi ?? [] as $t): ?>
                                    <tr>
                                        <td><strong><?= $t->no_invoice ?: 'INV-' . str_pad($t->id_transaksi, 4, '0', STR_PAD_LEFT) ?></strong>
                                        </td>
                                        <td>Meja <?= $t->no_meja ?></td>
                                        <td><?= date('d/m/Y H:i', strtotime($t->tanggal)) ?></td>
                                        <td><?= $t->metode_pembayaran ?></td>
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
                                        <td class="text-end fw-bold">Rp <?= number_format($t->total_harga, 0, ',', '.') ?>
                                        </td>
                                        <td>
                                            <?php if ($t->status_pesanan !== 'selesai' && $t->status_pesanan !== 'dibatalkan'): ?>
                                                <?php if ($t->metode_pembayaran === 'Tunai' && $t->status_pembayaran === 'pending'): ?>
                                                    <a href="<?= site_url('dashboard_cafe/detail_pesanan_masuk/' . $t->id_transaksi) ?>"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-cash-register"></i> Selesaikan Pembayaran
                                                    </a>
                                                <?php else: ?>
                                                    <button class="btn btn-success btn-sm btn-quick-update"
                                                        data-id="<?= $t->id_transaksi ?>">
                                                        <i class="fas fa-check"></i> Selesaikan Pesanan
                                                    </button>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-muted small">—</span>
                                            <?php endif; ?>
                                        </td>
                                        <td style="white-space:nowrap;">
                                            <a href="<?= site_url('dashboard_cafe/detail_pesanan_masuk/' . $t->id_transaksi) ?>"
                                                class="btn btn-info btn-sm me-1" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <!-- <a href="<?= site_url('dashboard_cafe/cetak_invoice/' . $t->id_transaksi) ?>"
                                                target="_blank" class="btn btn-success btn-sm" title="Cetak Invoice">
                                                <i class="fas fa-print"></i>
                                            </a> -->
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <style>
        #dataTable_wrapper {
            padding: 16px 12px;
        }

        #dataTable_filter {
            margin-bottom: 12px;
        }

        #dataTable_length {
            margin-bottom: 12px;
        }

        /* ini teksnya */
        #dataTable thead th {
            background-color: #945916 !important;
            color: #ffffff;
            padding: 14px 18px !important;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            border-bottom: none;
        }

        #dataTable tbody td {
            padding: 14px 18px !important;
            vertical-align: middle !important;
            font-size: 14px;
            border-bottom: 1px solid #6e3f0a;
            color: #3d2e1e;
        }

        #dataTable tbody tr {
            background-color: #fff;
        }

        #dataTable .btn-quick-update {
            font-size: 13px;
            padding: 4px 12px;
            line-height: 1.5;
        }

        #dataTable tbody tr:nth-child(even) {
            background-color: #fdfaf6;
        }

        #dataTable tbody tr:hover {
            background-color: #f5ede3;
            transition: background-color 0.2s ease;
        }

        #dataTable {
            border-collapse: separate;
            border-spacing: 0;
            width: 100% !important;
        }

        #dataTable_info,
        #dataTable_paginate {
            padding: 12px 18px 6px;
            font-size: 13px;
            color: #5a4a3a;
        }

        #dataTable_paginate .paginate_button {
            padding: 6px 14px;
            margin: 0 2px;
            border-radius: 6px;
            border: 1px solid #c4b09a;
            background: #f5ede3;
            color: #5a4a3a !important;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        #dataTable_paginate .paginate_button:hover {
            background: #9B673A;
            border-color: #9B673A;
            color: #fff !important;
        }

        #dataTable_paginate .paginate_button.current {
            background: #9B673A;
            border-color: #9B673A;
            color: #fff !important;
        }

        #dataTable_filter input {
            border: 1px solid #dccfc0;
            border-radius: 8px;
            padding: 8px 14px;
            font-size: 13px;
            outline: none;
            transition: border 0.2s ease;
            background: #fdfaf6;
        }

        #dataTable_filter input:focus {
            border-color: #9B673A;
            box-shadow: 0 0 0 3px rgba(155, 103, 58, 0.12);
        }

        #dataTable_length select {
            border: 1px solid #dccfc0;
            border-radius: 8px;
            padding: 6px 10px;
            font-size: 13px;
            outline: none;
            background: #fdfaf6;
        }
    </style>

    <script>
        $('#dataTable').DataTable({
            pageLength: 10,
            lengthMenu: [10],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/Indonesian.json"
            },
            dom: '<"row"<"col-sm-6"l><"col-sm-6"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row"<"col-sm-5"i><"col-sm-7"p>>'
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        (function () {
            var salesData = <?= json_encode($monthly_sales ?? []) ?>;
            var monthNames = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
            var labels = [];
            var values = [];

            salesData.forEach(function (row) {
                labels.push(monthNames[row.month - 1] + ' ' + row.year);
                values.push(parseFloat(row.sales) || 0);
            });

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
                                callback: function (v) { return 'Rp ' + v.toLocaleString(); },
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

    <script>
        function showToast(type, message) {
            var toast = document.createElement('div');
            toast.className = 'alert alert-' + (type === 'success' ? 'success' : 'danger') +
                ' position-fixed bottom-0 end-0 m-3 shadow';
            toast.style.zIndex = '9999';
            toast.style.minWidth = '250px';
            toast.innerHTML = '<i class="fas fa-' + (type === 'success' ? 'check-circle' : 'times-circle') + ' me-2"></i>' + message;
            document.body.appendChild(toast);
            setTimeout(function() {
                toast.remove();
            }, 3000);
        }

        document.querySelectorAll('.btn-quick-update').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var idTransaksi = this.dataset.id;
                var tombol = this;
                var originalText = tombol.innerHTML;

                if (!confirm('Konfirmasi pesanan selesai?'))
                    return;

                tombol.disabled = true;
                tombol.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

                fetch('<?= site_url('dashboard_cafe/quick_update_transaksi') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: 'id_transaksi=' + idTransaksi
                    })
                    .then(function(res) { return res.json(); })
                    .then(function(data) {
                        if (data.status === 'success') {
                            var row = tombol.closest('tr');
                            row.style.transition = 'opacity 0.5s ease';
                            row.style.opacity = '0';
                            setTimeout(function() {
                                row.remove();
                                var tbody = document.querySelector('table tbody');
                                if (tbody && tbody.querySelectorAll('tr').length === 0) {
                                    tbody.innerHTML =
                                        '<tr><td colspan="8" class="text-center py-4 text-muted"><i class="fas fa-check-circle fa-2x mb-2 d-block text-success"></i>Semua pesanan telah selesai</td></tr>';
                                }
                            }, 500);
                            showToast('success', data.message);
                        } else {
                            showToast('error', data.message);
                            tombol.disabled = false;
                            tombol.innerHTML = originalText;
                        }
                    })
                    .catch(function() {
                        showToast('error', 'Terjadi kesalahan, coba lagi.');
                        tombol.disabled = false;
                        tombol.innerHTML = originalText;
                    });
            });
        });
    </script>
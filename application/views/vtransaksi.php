<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <?php if (isset($message) && $message): ?>
                <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                    <?php echo $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
            <?php if (isset($error) && $error): ?>
                <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
                    <?php echo $error; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="row mx-3 mt-3 g-4">
                <div class="col-12 col-md-6">
                    <div class="card stat-card h-100">
                        <div class="stat-icon stat-icon-primary">
                            <i class="fas fa-coins"></i>
                        </div>
                        <div class="stat-label">Total Pendapatan</div>
                        <div class="stat-value">Rp <?php echo number_format($total_pendapatan ?? 0, 0, ',', '.'); ?></div>
                        <div class="stat-change" style="color: #7C6A5B;">
                            <i class="fas fa-arrow-up me-1"></i>Ringkasan transaksi
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card stat-card h-100">
                        <div class="stat-icon stat-icon-dark">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="stat-label">Total Transaksi</div>
                        <div class="stat-value"><?php echo isset($total_transaksi) ? (int) $total_transaksi : (isset($transaksi) ? count($transaksi) : 0); ?></div>
                        <div class="stat-change" style="color: #7C6A5B;">
                            <i class="fas fa-clock me-1"></i>Jumlah seluruh transaksi
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mx-3 mt-3">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>No Pesanan</th>
                                    <th>Tanggal</th>
                                    <th>No Meja</th>
                                    <th>Kasir</th>
                                    <th>Status Pesanan</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Status Pembayaran</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach (($transaksi ?? $transaksi_model ?? []) as $t) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo "SHD - " . $t->no_pesanan; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($t->tanggal)); ?></td>
                                        <td><?php echo $t->no_meja; ?></td>
                                        <td><?php echo $t->nama_user; ?></td>
                                        <td><?php echo $t->status_pesanan; ?></td>
                                        <td><?php echo $t->metode_pembayaran; ?></td>
                                        <td><?php echo $t->status_pembayaran; ?></td>
                                        <td>Rp <?php echo number_format($t->total_harga, 0, ',', '.'); ?></td>
                                        <td>
                                            <a href="<?php echo site_url('dashboard_cafe/detail_transaksi/' . $t->id_transaksi) ?>"
                                                class="btn btn-primary btn-sm" title="Cek Invoice">
                                                <i class="fas fa-eye"></i></a>
                                            <a href="<?php echo site_url('dashboard_cafe/hapus_transaksi/' . $t->id_transaksi) ?>"
                                                class="btn btn-danger btn-sm" title="Hapus Transaksi"
                                                onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
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
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                responsive: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/Indonesian.json"
                },
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }]
            });
        });
    </script>
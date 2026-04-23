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
            <div class="card mx-3 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('dashboard_cafe/tambah_transaksi') ?>"
                        class="btn btn-outline-primary btn-sm"> <i class="fas fa-plus"></i> Tambah Transaksi</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>No Meja</th>
                                    <th>Kasir</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($transaksi as $t) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($t->tanggal)); ?></td>
                                        <td><?php echo $t->no_meja ?></td>
                                        <td><?php echo $t->nama_user ?></td>
                                        <td><?php echo $t->status_pesanan ?></td>
                                        <td>Rp <?php echo number_format($t->total_harga, 0, ',', '.'); ?></td>
                                        <td>
                                            <a href="<?php echo site_url('dashboard_cafe/edit_transaksi/' . $t->id_transaksi) ?>"
                                                class="btn btn-warning btn-sm" title="Edit Transaksi"><i
                                                    class="fas fa-pencil"></i> </a>
                                            <a href="<?php echo site_url('dashboard_cafe/hapus_transaksi/' . $t->id_transaksi) ?>"
                                                class="btn btn-danger btn-sm" title="Hapus Transaksi"
                                                onclick="return confirm('Yakin ingin menghapus transaksi ini?')"><i
                                                    class="fas fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
    </main>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                responsive: true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/Indonesian.json"
                },
                columnDefs: [{
                    orderable: false,
                    targets: -1
                }]
            });
        });
    </script>
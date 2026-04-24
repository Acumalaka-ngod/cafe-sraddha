<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
<<<<<<< HEAD

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
=======
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
                    <a href="<?php echo site_url('dashboard_cafe/tambah_detail_pesanan') ?>"
                        class="btn btn-outline-primary btn-sm"> <i class="fas fa-plus"></i> Tambah Detail Pesanan</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Pesanan</th>
                                    <th>ID Menu</th>
                                    <th>Menu</th>
                                    <th>No Meja</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($detail_pesanan as $dp) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $dp->id_pesanan ?></td>
                                        <td><?php echo $dp->id_menu ?></td>
                                        <td><?php echo $dp->menu_dipesan ?></td>
                                        <td><?php echo $dp->no_meja ?></td>
                                        <td><?php echo $dp->jumlah_dipesan ?></td>
                                        <td>Rp <?php echo number_format($dp->total_pembayaran, 0, ',', '.'); ?></td>
                                        <td><?php echo ucfirst($dp->metode_pembayaran) ?></td>
                                        <td>
                                            <a href="<?php echo site_url('dashboard_cafe/edit_detail_pesanan/' . $dp->id_detail) ?>"
                                                class="btn btn-warning btn-sm" title="Edit"><i
                                                    class="fas fa-pencil"></i> </a>
                                            <a href="<?php echo site_url('dashboard_cafe/hapus_detail_pesanan/' . $dp->id_detail_pesanan) ?>"
                                                class="btn btn-danger btn-sm" title="Hapus"
                                                onclick="return confirm('Yakin ingin menghapus?')"><i
                                                    class="fas fa-trash"></i> </a>
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
>>>>>>> 2e20cddf34c6fcf448714230eba0b44f83c5b897

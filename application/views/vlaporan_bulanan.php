<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-3 mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Laporan Pendapatan</h6>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('dashboard_cafe/laporan_bulanan') ?>" method="get" class="row g-3 mb-4">
                        <div class="col-md-3">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="date" name="tanggal_mulai" class="form-control" value="<?= $tanggal_mulai ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" name="tanggal_selesai" class="form-control" value="<?= $tanggal_selesai ?>" required>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-filter"></i> Tampilkan
                            </button>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <a href="<?= site_url('dashboard_cafe/laporan_bulanan?tanggal_mulai=' . $tanggal_mulai . '&tanggal_selesai=' . $tanggal_selesai) ?>"
                                class="btn btn-success w-100"
                                onclick="window.open('<?= site_url('dashboard_cafe/laporan_bulanan?tanggal_mulai=' . $tanggal_mulai . '&tanggal_selesai=' . $tanggal_selesai) ?>', '_blank'); return false;">
                                <i class="fas fa-print"></i> Print
                            </a>
                        </div>
                    </form>

                    <?php if ($total_pendapatan > 0): ?>
                        <div class="row mb-4 justify-content-center">
                            <div class="col-md-4">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center">
                                        <h5>Total Pendapatan</h5>
                                        <h3>Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></h3>
                                        <small>Periode <?= date('d/m/Y', strtotime($tanggal_mulai)) ?> - <?= date('d/m/Y', strtotime($tanggal_selesai)) ?></small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-info text-white">
                                    <div class="card-body text-center">
                                        <h5>Jumlah Transaksi</h5>
                                        <h3><?= count($transaksi) ?></h3>
                                        <small>Transaksi berhasil</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Invoice</th>
                                        <th>Tanggal</th>
                                        <th>Meja</th>
                                        <th>Kasir</th>
                                        <th>Metode Bayar</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($transaksi as $t): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $t->no_invoice ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($t->tanggal)) ?></td>
                                            <td><?= $t->no_meja ?></td>
                                            <td><?= $t->nama_user ?></td>
                                            <td><?= $t->metode_pembayaran ?></td>
                                            <td>Rp <?= number_format($t->total_harga, 0, ',', '.') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table-success">
                                        <th colspan="6" class="text-end">TOTAL</th>
                                        <th>Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info">Tidak ada transaksi pada periode ini.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script>
$(document).ready(function () {
    $('#dataTable').DataTable({
        responsive: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/Indonesian.json"
        }
    });
});
</script>

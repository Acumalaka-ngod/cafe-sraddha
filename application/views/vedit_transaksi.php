<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="card mx-4 mt-3">
                <div class="card-header">
                    <a href="<?= site_url('dashboard_cafe/') ?>" class="btn btn-outline-primary btn-sm">
                        ← Kembali
                    </a>
                </div>

                <div class="card-body">

                    <form action="<?= site_url('dashboard_cafe/update_transaksi') ?>" method="post">
                        <input type="hidden" name="id_transaksi" value="<?= $tr->id_transaksi ?>">

                        <div class="form-group mb-3">
                            <label>Status Pesanan</label>
                            <select name="status_pesanan" class="form-control" required>
                                <option value="diproses" <?= $tr->status_pesanan == 'diproses' ? 'selected' : '' ?>>Diproses</option>
                                <option value="selesai" <?= $tr->status_pesanan == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                <option value="dibatalkan" <?= $tr->status_pesanan == 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>Status Pembayaran</label>
                            <select name="status_pembayaran" class="form-control" required>
                                <option value="pending" <?= $tr->status_pembayaran == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="paid" <?= $tr->status_pembayaran == 'paid' ? 'selected' : '' ?>>Paid / Lunas</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">Update Status</button>
                            <a href="<?= site_url('dashboard_cafe/') ?>" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
    
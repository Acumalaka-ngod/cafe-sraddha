<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-4 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('dashboard_cafe/lihat_transaksi') ?>"
                        class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url('dashboard_cafe/simpan_transaksi') ?>" method="post">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" required>
                        </div>
                        <div class="form-group">
                            <label>User</label>
                            <select name="user" class="form-control" required>
                                <option value="">-- Pilih User --</option>
                                <?php foreach ($user as $u) { ?>
                                    <option value="<?= $u->id_user ?>"><?= $u->nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Meja</label>
                            <select name="meja" class="form-control" required>
                                <option value="">-- Pilih Meja --</option>
                                <?php foreach ($meja as $mj) { ?>
                                    <option value="<?= $mj->id_meja ?>">Meja <?= $mj->no_meja ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No Meja</label>
                            <input type="text" class="form-control" name="no_meja" required>
                        </div>
                        <div class="form-group">
                            <label>Menu</label>
                            <select name="menu" class="form-control" required>
                                <option value="">-- Pilih Menu --</option>
                                <?php foreach ($menu as $m) { ?>
                                    <option value="<?= $m->id_menu ?>"><?= $m->nama_menu ?> (Rp <?= number_format($m->harga,0,',','.') ?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" required min="1">
                        </div>
                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <select name="metode_pembayaran" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Tunai">Tunai</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </div>
                        <div class="form-group mt-3"></br>
                            <button type="submit" class="btn btn-primary">Tambah Transaksi</button>
                            <button type="reset" class="btn btn-secondary">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>


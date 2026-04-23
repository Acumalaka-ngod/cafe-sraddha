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
                    <?php if ($tr): ?>
                    <form action="<?php echo site_url('dashboard_cafe/update_transaksi') ?>" method="post">
                        <input type="hidden" name="id_transaksi" value="<?php echo $tr->id_transaksi ?>">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="<?php echo date('Y-m-d', strtotime($tr->tanggal)) ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Meja</label>
                            <select name="meja" class="form-control" required>
                                <option value="">-- Pilih Meja --</option>
                                <?php foreach ($meja as $mj) { ?>
                                    <option value="<?= $mj->id_meja ?>" <?= $mj->id_meja == $tr->id_meja ? 'selected' : '' ?>>Meja <?= $mj->no_meja ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Menu Saat ini: <?php echo $tr->nama_menu; ?></label>
                            <select name="menu" class="form-control" required>
                                <option value="">-- Pilih Menu --</option>
                                <?php foreach ($menu as $m) { ?>
                                    <option value="<?= $m->id_menu ?>" <?= $m->id_menu == $tr->id_menu ? 'selected' : '' ?>><?= $m->nama_menu ?> (Rp <?= number_format($m->harga,0,',','.') ?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" class="form-control" name="jumlah_dipesan" value="<?= $tr->jumlah_dipesan ?>" required min="1" id="jumlah_dipesan">
                        </div>
                        <div class="form-group">
                            <label>Metode Pembayaran</label>
                            <select name="metode_pembayaran" class="form-control" required>
                                <option value="">-- Pilih --</option>
                                <option value="Tunai" <?= $tr->metode_pembayaran == 'Tunai' ? 'selected' : '' ?>>Tunai</option>
                                <option value="QRIS" <?= $tr->metode_pembayaran == 'QRIS' ? 'selected' : '' ?>>QRIS</option>
                            </select>
                        </div>
                        <div class="form-group mt-3"></br>
                            <button type="submit" class="btn btn-primary">Update Transaksi</button>
                            <button type="reset" class="btn btn-secondary">Batal</button>
                        </div>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>


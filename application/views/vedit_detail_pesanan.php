<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-4 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('dashboard_cafe/lihat_detail_pesanan') ?>"
                        class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <?php if (isset($detail) && $detail): ?>
                        <form action="<?php echo site_url('dashboard_cafe/update_detail_pesanan') ?>" method="post">
                            <input type="hidden" name="id_detail_pesanan" value="<?= $detail->id_detail_pesanan ?>">
                            <div class="form-group mb-3">
                                <label>ID Pesanan <span class="text-danger">*</span></label>
                                <select name="id_pesanan" class="form-control" required>
                                    <option value="">-- Pilih Pesanan --</option>
                                    <?php foreach ($pesanan as $p): ?>
                                        <option value="<?= $p->id_pesanan ?>" <?= $detail->id_pesanan == $p->id_pesanan ? 'selected' : '' ?>>Pesanan #<?= $p->id_pesanan ?> (Meja <?= $p->no_meja ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>ID Menu <span class="text-danger">*</span></label>
                                <select name="id_menu" id="id_menu" class="form-control" required onchange="calculateTotal()">
                                    <option value="">-- Pilih Menu --</option>
                                    <?php foreach ($menu as $m): ?>
                                        <option value="<?= $m->id_menu ?>" data-nama="<?= $m->nama_menu ?>" data-harga="<?= $m->harga ?>" <?= $detail->id_menu == $m->id_menu ? 'selected' : '' ?>><?= $m->nama_menu ?> (Rp <?= number_format($m->harga, 0, ',', '.') ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>ID Meja <span class="text-danger">*</span></label>
                                <select name="id_meja" id="id_meja" class="form-control" required onchange="updateNoMeja()">
                                    <option value="">-- Pilih Meja --</option>
                                    <?php foreach ($meja as $mj): ?>
                                        <option value="<?= $mj->id_meja ?>" data-no="<?= $mj->no_meja ?>" <?= $detail->id_meja == $mj->id_meja ? 'selected' : '' ?>>Meja <?= $mj->no_meja ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Jumlah Dipesan <span class="text-danger">*</span></label>
                                <input type="number" name="jumlah_dipesan" id="jumlah_dipesan" class="form-control" min="1" value="<?= $detail->jumlah_dipesan ?>" required onchange="calculateTotal()">
                            </div>
                            <div class="form-group mb-3">
                                <label>Metode Pembayaran <span class="text-danger">*</span></label>
                                <select name="metode_pembayaran" class="form-control" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="Tunai" <?= $detail->metode_pembayaran == 'Tunai' ? 'selected' : '' ?>>Tunai</option>
                                    <option value="Qris" <?= $detail->metode_pembayaran == 'Qris' ? 'selected' : '' ?>>QRIS</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>No Meja</label>
                                <input type="text" id="no_meja" class="form-control" readonly value="<?= $detail->no_meja ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label>Total Pembayaran</label>
                                <input type="text" id="total_pembayaran" class="form-control" readonly value="Rp <?= number_format($detail->total_pembayaran, 0, ',', '.') ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Detail Pesanan</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </form>
                        <script>
                            function calculateTotal() {
                                const idMenu = document.getElementById('id_menu').value;
                                const jumlah = parseInt(document.getElementById('jumlah_dipesan').value) || 0;
                                if (idMenu && jumlah > 0) {
                                    const harga = parseInt(document.querySelector(`#id_menu option[value="${idMenu}"]`).dataset.harga) || 0;
                                    const total = jumlah * harga;
                                    document.getElementById('total_pembayaran').value = 'Rp ' + total.toLocaleString('id-ID');
                                } else {
                                    document.getElementById('total_pembayaran').value = '';
                                }
                            }

                            function updateNoMeja() {
                                const idMeja = document.getElementById('id_meja').value;
                                if (idMeja) {
                                    const option = document.querySelector(`#id_meja option[value="${idMeja}"]`);
                                    document.getElementById('no_meja').value = option.dataset.no;
                                } else {
                                    document.getElementById('no_meja').value = '';
                                }
                            }
                        </script>
                    <?php else: ?>
                        <div class="alert alert-warning">Detail pesanan tidak ditemukan.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>


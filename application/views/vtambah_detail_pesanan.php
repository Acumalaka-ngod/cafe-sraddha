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
                    <form action="<?php echo site_url('dashboard_cafe/simpan_detail_pesanan') ?>" method="post">
                        <div class="form-group mb-3">
                            <label>ID Pesanan <span class="text-danger">*</span></label>
                            <select name="id_pesanan" class="form-control" required>
                                <option value="">-- Pilih Pesanan --</option>
                                <?php foreach ($pesanan as $p): ?>
                                    <option value="<?php echo $p->id_pesanan; ?>" data-menu-id="<?php echo $p->menu ?? ''; ?>" data-jumlah="<?php echo $p->jumlah ?? ''; ?>" data-no-meja="<?php echo $p->no_meja; ?>">Pesanan #<?php echo $p->id_pesanan; ?> (Meja <?php echo $p->no_meja; ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Menu <span class="text-danger">*</span></label>
                            <select name="id_menu" id="id_menu" class="form-control" required onchange="calculateTotal()">
                                <option value="">-</option>
                                <?php foreach ($menu as $m): ?>
                                    <option value="<?= $m->id_menu ?>" data-nama="<?= $m->nama_menu ?>" data-harga="<?= $m->harga ?>"><?= $m->nama_menu ?> (Rp <?= number_format($m->harga, 0, ',', '.') ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- <div class="form-group mb-3">
                            <label>ID Meja <span class="text-danger">*</span></label>
                            <select name="id_meja" id="id_meja" class="form-control" required onchange="updateNoMeja()">
                                <option value="">-- Pilih Meja --</option>
                                <?php foreach ($meja as $mj): ?>
                                    <option value="<?= $mj->id_meja ?>" data-no="<?= $mj->no_meja ?>">Meja <?= $mj->no_meja ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> -->
                        <div class="form-group mb-3">
                            <label>Jumlah Dipesan <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah_dipesan" id="jumlah_dipesan" class="form-control" min="1" required onchange="calculateTotal()" value="1">
                        </div>
                        <div class="form-group mb-3">
                            <label>Metode Pembayaran <span class="text-danger">*</span></label>
                            <select name="metode_pembayaran" class="form-control" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="Tunai">Tunai</option>
                                <option value="Qris">QRIS</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <input type="hidden" id="no_meja" class="form-control" readonly>
                        </div>
                        <div class="form-group mb-3">
                            <label>Total Pembayaran</label>
                            <input type="text" id="total_pembayaran" class="form-control" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Detail Pesanan</button>
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

                        // Auto fill from pesanan
                        document.querySelector('[name="id_pesanan"]').addEventListener('change', function() {
                            const idPesanan = this.value;
                            if (idPesanan) {
                                const option = this.options[this.selectedIndex];
                                const menuId = option.dataset.menuId;
                                const jumlah = option.dataset.jumlah;
                                const noMeja = option.dataset.noMeja;

                                document.getElementById('id_menu').value = menuId || '';
                                document.getElementById('jumlah_dipesan').value = jumlah || 1;
                                document.getElementById('no_meja').value = noMeja || '';

                                calculateTotal();
                            } else {
                                document.getElementById('id_menu').value = '';
                                document.getElementById('jumlah_dipesan').value = 1;
                                document.getElementById('no_meja').value = '';
                                document.getElementById('total_pembayaran').value = '';
                            }
                        });
                    </script>

                </div>
            </div>
        </div>
    </main>
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
                            <label>Meja</label>
                            <select name="meja" id="meja" class="form-control" required onchange="setNoMeja()">
                                <option value="">-- Pilih Meja --</option>
                                <?php foreach ($meja as $mj) { ?>
                                    <option value="<?= $mj->id_meja ?>" data-no-meja="<?= $mj->no_meja ?>">Meja <?= $mj->no_meja ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="hidden" name="no_meja" id="no_meja" value="">
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
                            <input type="number" class="form-control" name="jumlah_dipesan" required min="1">
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
                            <button type="reset" class="btn btn-secondary" onclick="clearNoMeja()">Batal</button>
                        </div>
                    </form>
                    <script>
                    function setNoMeja() {
                        const mejaSelect = document.getElementById('meja');
                        const noMejaInput = document.getElementById('no_meja');
                        if (mejaSelect.value) {
                            const selectedOption = mejaSelect.options[mejaSelect.selectedIndex];
                            noMejaInput.value = selectedOption.getAttribute('data-no-meja');
                        } else {
                            noMejaInput.value = '';
                        }
                    }
                    function clearNoMeja() {
                        document.getElementById('no_meja').value = '';
                        document.getElementById('meja').value = '';
                    }
                    </script>
                </div>
            </div>
        </div>
    </main>
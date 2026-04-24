<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
<<<<<<< HEAD

            <div class="card shadow mt-3">
                <div class="card-header d-flex justify-content-between">
                    <a href="<?= site_url('dashboard_cafe/lihat_transaksi') ?>" class="btn btn-outline-primary btn-sm">
                        ← Kembali
                    </a>
                    <h6 class="mb-0">Tambah Transaksi</h6>
                </div>

                <div class="card-body">

                    <form id="pesananForm" action="<?= site_url('dashboard_cafe/simpan_transaksi') ?>" method="post">

                        <input type="hidden" name="cart_data" id="cart_data">

                        <!-- PEMESAN -->
                        <div class="mb-4">
                            <label class="fw-semibold">Nama Pemesan</label>
                            <input type="text"
                                name="pemesan"
                                class="form-control form-control-lg"
                                placeholder="Nama pemesan"
                                required>
                        </div>

                        <!-- MEJA -->
                        <div class="mb-4">
                            <label class="fw-semibold">Meja</label>
                            <select name="meja" id="meja" class="form-control form-control-lg" required onchange="toggleSubmitBtn()">
                                <option value="">-- Pilih Meja --</option>
                                <?php foreach ($meja as $mj) { ?>
                                    <option value="<?= $mj->id_meja ?>">Meja <?= $mj->no_meja ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- INPUT ITEM -->
                        <div class="row g-3 align-items-end mb-4">

                            <div class="col-md-5">
                                <label>Menu</label>
                                <select id="cart_menu" class="form-control form-control-lg">
                                    <option value="">-- Pilih Menu --</option>
                                    <?php foreach ($menu as $m) { ?>
                                        <option value="<?= $m->id_menu ?>" data-harga="<?= $m->harga ?>">
                                            <?= $m->nama_menu ?> (Rp <?= number_format($m->harga) ?>)
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label>Qty</label>
                                <input type="number" id="cart_qty" class="form-control form-control-lg text-center" min="1" value="1">
                            </div>

                            <div class="col-md-3">
                                <label>Pembayaran</label>
                                <select name="metode_pembayaran" class="form-control form-control-lg" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Tunai">Tunai</option>
                                    <option value="QRIS">QRIS</option>
                                </select>
                            </div>

                            <div class="col-md-2 d-grid">
                                <button type="button" id="addItemBtn" class="btn btn-success btn-lg" disabled>
                                    + Tambah
                                </button>
                            </div>

                        </div>

                        <!-- CART -->
                        <div class="card shadow-sm mb-3">
                            <div class="card-header d-flex justify-content-between">
                                <strong>Daftar Pesanan</strong>
                                <button type="button" id="clearCartBtn" class="btn btn-sm btn-danger" style="display:none;">Clear</button>
                            </div>

                            <div class="card-body p-0">
                                <table class="table table-hover mb-0 text-center">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Menu</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="cartTableBody">
                                        <tr>
                                            <td colspan="5" class="text-muted">Belum ada pesanan</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- TOTAL -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h4>Total: <span id="grandTotal" class="text-success">Rp 0</span></h4>

                            <div>
                                <button type="submit" id="submitBtn" class="btn btn-primary btn-lg" disabled>
                                    Simpan Transaksi
                                </button>
                                <button type="button" class="btn btn-secondary btn-lg" onclick="clearAll()">
                                    Batal
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        let cart = [];

        // enable tombol tambah
        function toggleAddBtn() {
            const menu = document.getElementById('cart_menu').value;
            const qty = document.getElementById('cart_qty').value;
            document.getElementById('addItemBtn').disabled = !menu || qty < 1;
        }

        document.getElementById('cart_menu').addEventListener('change', toggleAddBtn);
        document.getElementById('cart_qty').addEventListener('input', toggleAddBtn);

        // tambah item
        document.getElementById('addItemBtn').addEventListener('click', function() {

            const menuSelect = document.getElementById('cart_menu');
            const id = menuSelect.value;
            const text = menuSelect.options[menuSelect.selectedIndex].text;
            const harga = parseInt(menuSelect.options[menuSelect.selectedIndex].dataset.harga);
            const qty = parseInt(document.getElementById('cart_qty').value);

            cart.push({
                menu: id,
                nama: text,
                harga: harga,
                jumlah: qty,
                subtotal: harga * qty
            });

            renderCart();
            resetInput();
            toggleSubmitBtn();
        });

        // render cart
        function renderCart() {
            const tbody = document.getElementById('cartTableBody');
            const clearBtn = document.getElementById('clearCartBtn');

            if (cart.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="text-muted">Belum ada pesanan</td></tr>`;
                clearBtn.style.display = 'none';
                document.getElementById('grandTotal').innerText = 'Rp 0';
                return;
            }

            clearBtn.style.display = 'inline-block';

            let total = 0;

            tbody.innerHTML = cart.map((item, i) => {
                total += item.subtotal;
                return `
        <tr>
            <td>${item.nama}</td>
            <td>${item.jumlah}</td>
            <td>Rp ${item.harga.toLocaleString()}</td>
            <td>Rp ${item.subtotal.toLocaleString()}</td>
            <td><button class="btn btn-sm btn-danger" onclick="removeItem(${i})">Hapus</button></td>
        </tr>
        `;
            }).join('');

            document.getElementById('grandTotal').innerText = 'Rp ' + total.toLocaleString();
            toggleSubmitBtn();
        }

        // hapus item
        function removeItem(i) {
            cart.splice(i, 1);
            renderCart();
            toggleSubmitBtn();
        }

        // reset input
        function resetInput() {
            document.getElementById('cart_menu').value = '';
            document.getElementById('cart_qty').value = 1;
            toggleAddBtn();
        }

        // clear semua
        function clearAll() {
            cart = [];
            renderCart();
            document.getElementById('meja').value = '';
            toggleSubmitBtn();
        }

        // enable submit
        function toggleSubmitBtn() {
            document.querySelector('input[name="pemesan"]').addEventListener('input', toggleSubmitBtn);
            const meja = document.getElementById('meja').value;
            const pemesan = document.querySelector('input[name="pemesan"]').value.trim();

            document.getElementById('submitBtn').disabled = !meja || cart.length === 0 || !pemesan;
        }

        // submit
        document.getElementById('pesananForm').addEventListener('submit', function(e) {
            if (cart.length === 0) {
                e.preventDefault();
                alert('Tambahkan item dulu!');
                return;
            }

            document.getElementById('cart_data').value = JSON.stringify(cart.map(i => ({
                menu: i.menu,
                jumlah: i.jumlah
            })));
        });

        // clear cart
        document.getElementById('clearCartBtn').addEventListener('click', function() {
            cart = [];
            renderCart();
            toggleSubmitBtn();
        });
    </script>
=======
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
>>>>>>> 2e20cddf34c6fcf448714230eba0b44f83c5b897

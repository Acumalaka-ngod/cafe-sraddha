<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
<<<<<<< HEAD

            <div class="card mx-4 mt-3">
                <div class="card-header">
                    <a href="<?= site_url('dashboard_cafe/lihat_transaksi') ?>"
                        class="btn btn-outline-primary btn-sm">
                        ← Kembali
                    </a>
                </div>

                <div class="card-body">

                    <form id="formEdit" action="<?= site_url('dashboard_cafe/update_transaksi') ?>" method="post">

                        <input type="hidden" name="id_transaksi" value="<?= $tr->id_transaksi ?>">
                        <input type="hidden" name="cart_data" id="cart_data">

                        <!-- PEMESAN -->
                        <div class="form-group mb-3">
                            <label>Nama Pemesan</label>
                            <input type="text" name="pemesan" class="form-control"
                                value="<?= $tr->pemesan ?>" required>
                        </div>

                        <!-- MEJA -->
                        <div class="form-group mb-3">
                            <label>Meja</label>
                            <select name="meja" id="meja" class="form-control" required>
                                <?php foreach ($meja as $mj): ?>
                                    <option value="<?= $mj->id_meja ?>"
                                        <?= $mj->id_meja == $tr->id_meja ? 'selected' : '' ?>>
                                        Meja <?= $mj->no_meja ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- METODE -->
                        <div class="form-group mb-3">
                            <label>Metode Pembayaran</label>
                            <select name="metode_pembayaran" class="form-control" required>
=======
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
>>>>>>> 2e20cddf34c6fcf448714230eba0b44f83c5b897
                                <option value="Tunai" <?= $tr->metode_pembayaran == 'Tunai' ? 'selected' : '' ?>>Tunai</option>
                                <option value="QRIS" <?= $tr->metode_pembayaran == 'QRIS' ? 'selected' : '' ?>>QRIS</option>
                            </select>
                        </div>
<<<<<<< HEAD

                        <!-- METODE -->
                        <div class="form-group mb-3">
                            <label>Status Pesanan</label>
                            <select name="status_pesanan" class="form-control" required>
                                <option value="Pending" <?= $tr->status_pesanan == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Diproses" <?= $tr->status_pesanan == 'Diproses' ? 'selected' : '' ?>>Diproses</option>
                                <option value="Selesai" <?= $tr->status_pesanan == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                            </select>
                        </div>

                        <hr>

                        <!-- INPUT MENU -->
                        <div class="row mb-3">
                            <div class="col-md-5">
                                <select id="menu" class="form-control">
                                    <option value="">-- Pilih Menu --</option>
                                    <?php foreach ($menu as $m): ?>
                                        <option value="<?= $m->id_menu ?>" data-harga="<?= $m->harga ?>">
                                            <?= $m->nama_menu ?> (Rp <?= number_format($m->harga) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <input type="number" id="qty" class="form-control" value="1" min="1">
                            </div>

                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" onclick="addItem()">Tambah</button>
                            </div>
                        </div>

                        <!-- TABLE -->
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="cartTable"></tbody>
                        </table>

                        <h5>Total: <span id="total">Rp </span></h5>

                        <button type="submit" class="btn btn-primary mt-3">Update</button>

                    </form>
=======
                        <div class="form-group mt-3"></br>
                            <button type="submit" class="btn btn-primary">Update Transaksi</button>
                            <button type="reset" class="btn btn-secondary">Batal</button>
                        </div>
                    </form>
                    <?php endif; ?>
>>>>>>> 2e20cddf34c6fcf448714230eba0b44f83c5b897
                </div>
            </div>
        </div>
    </main>

<<<<<<< HEAD
    <script>
        let cart = [];

        //  LOAD DATA LAMA
        cart = <?= json_encode(array_map(function ($d) {
                    return [
                        'menu' => $d->id_menu,
                        'nama' => $d->nama_menu,
                        'harga' => $d->harga,
                        'jumlah' => $d->jumlah,
                        'subtotal' => $d->subtotal
                    ];
                }, $detail)); ?>;

        render();

        // tambah item
        function addItem() {
            const select = document.getElementById('menu');
            const id = select.value;
            const text = select.options[select.selectedIndex].text;
            const harga = parseInt(select.options[select.selectedIndex].dataset.harga);
            const qty = parseInt(document.getElementById('qty').value);

            cart.push({
                menu: id,
                nama: text,
                harga: harga,
                jumlah: qty,
                subtotal: harga * qty
            });

            render();
        }

        // render
        function render() {
            let html = '';
            let total = 0;

            cart.forEach((item, i) => {

                const harga = Number(item.harga);
                const subtotal = Number(item.subtotal);

                total += subtotal;

                html += `
        <tr>
            <td>${item.nama}</td>
            <td>${item.jumlah}</td>
            <td>Rp ${harga.toLocaleString('id-ID')}</td>
            <td>Rp ${subtotal.toLocaleString('id-ID')}</td>
            <td>
                <button onclick="hapus(${i})" class="btn btn-danger btn-sm">Hapus</button>
            </td>
        </tr>`;
            });

            document.getElementById('cartTable').innerHTML = html;

            document.getElementById('total').innerText =
                'Rp ' + total.toLocaleString('id-ID');
        }

        // hapus
        function hapus(i) {
            cart.splice(i, 1);
            render();
        }

        // submit
        document.getElementById('formEdit').addEventListener('submit', function() {
            document.getElementById('cart_data').value = JSON.stringify(
                cart.map(i => ({
                    menu: i.menu,
                    jumlah: i.jumlah
                }))
            );
        });
    </script>
=======
>>>>>>> 2e20cddf34c6fcf448714230eba0b44f83c5b897

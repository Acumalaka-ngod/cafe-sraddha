<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-4 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('dashboard_cafe/lihat_pesanan') ?>"
                        class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form id="pesananForm" action="<?php echo site_url('dashboard_cafe/simpan_pesanan') ?>" method="post">
                        <input type="hidden" name="no_meja" id="no_meja">
                        <input type="hidden" name="cart_data" id="cart_data">
                        <div class="form-group mb-4">
                            <label>Meja <span class="text-danger">*</span></label>
                            <select name="meja" id="meja" class="form-control" required onchange="setNoMeja()">
                                <option value="">-- Pilih Meja --</option>
                                <?php foreach ($meja as $mj) { ?>
                                    <option value="<?= $mj->id_meja ?>" data-no-meja="<?= $mj->no_meja ?>">Meja <?= $mj->no_meja ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        <!-- Add Item Section -->
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <label>Menu</label>
                                <select id="cart_menu" class="form-control">
                                    <option value="">-- Pilih Menu --</option>
                                    <?php foreach ($menu as $m) { ?>
                                        <option value="<?= $m->id_menu ?>" data-harga="<?= $m->harga ?>"><?= $m->nama_menu ?> (Rp <?= number_format($m->harga) ?>)</option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Jumlah <span class="text-danger">*</span></label>
                                <input type="number" id="cart_qty" class="form-control" min="1" value="1">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="button" id="addItemBtn" class="btn btn-success me-2" disabled>
                                    <i class="fas fa-plus"></i> Tambah Item
                                </button>
                                <button type="button" id="clearCartBtn" class="btn btn-warning" style="display:none;">
                                    Clear Cart
                                </button>
                            </div>
                        </div>
                        
                        <!-- Cart Preview -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6>Daftar Pesanan <span id="cartCount">(0 items)</span></h6>
                               </div>
                            <div class="card-body">
                                <table class="table table-sm" id="cartTable">
                                    <thead>
                                        <tr>
                                            <th>Menu</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                <p id="emptyCart" class="text-muted">Keranjang kosong. Tambahkan item terlebih dahulu.</p>
                            </div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <?php if (empty($meja) || empty($menu)): ?>
                                <div class="alert alert-warning">Tambahkan data meja dan menu terlebih dahulu.</div>
                            <?php else: ?>
                                <button type="submit" id="submitBtn" class="btn btn-primary" disabled>Tambah Semua Pesanan</button>
                                <button type="button" class="btn btn-secondary" onclick="clearAll()">Batal</button>
                            <?php endif; ?>
                        </div>
                    </form>
                    
                    <script>
                    let cart = [];
                    
                    // Enable add button when selections made
                    document.getElementById('cart_menu').addEventListener('change', toggleAddBtn);
                    document.getElementById('cart_qty').addEventListener('input', toggleAddBtn);
                    
                    function toggleAddBtn() {
                        const menu = document.getElementById('cart_menu').value;
                        const qty = document.getElementById('cart_qty').value;
                        document.getElementById('addItemBtn').disabled = !menu || !qty || qty < 1;
                    }
                    
                    // Add item to cart
                    document.getElementById('addItemBtn').addEventListener('click', function() {
                        const menuId = document.getElementById('cart_menu').value;
                        const menuText = document.getElementById('cart_menu').options[document.getElementById('cart_menu').selectedIndex].text;
                        const qty = parseInt(document.getElementById('cart_qty').value);
                        const selectedOpt = document.querySelector('#cart_menu option[value="' + menuId + '"]');
                        const harga = selectedOpt ? parseInt(selectedOpt.dataset.harga) : 0;
                        
                        const item = {
                            menu: menuId,
                            nama_menu: menuText,
                            jumlah: qty,
                            harga: harga,
                            total: qty * harga
                        };
                        
                        cart.push(item);
                        renderCart();
                        clearInputs();
                        toggleSubmitBtn();
                    });
                    
                    // Remove item
                    function removeItem(index) {
                        cart.splice(index, 1);
                        renderCart();
                        toggleSubmitBtn();
                    }
                    
                    function renderCart() {
                        const tbody = document.querySelector('#cartTable tbody');
                        const emptyMsg = document.getElementById('emptyCart');
                        const count = document.getElementById('cartCount');
                        const clearBtn = document.getElementById('clearCartBtn');
                        
                        if (cart.length === 0) {
                            tbody.innerHTML = '';
                            emptyMsg.style.display = 'block';
                            count.textContent = '(0 items)';
                            clearBtn.style.display = 'none';
                            return;
                        }
                        
                        emptyMsg.style.display = 'none';
                        clearBtn.style.display = 'inline-block';
                        count.textContent = `(${cart.length} items)`;
                        
                        tbody.innerHTML = cart.map((item, index) => `
                            <tr>
                                <td>${item.nama_menu}</td>
                                <td>${item.jumlah}</td>
                                <td>Rp ${item.harga.toLocaleString()}</td>
                                <td>Rp ${item.total.toLocaleString()}</td>
                                <td><button type="button" class="btn btn-sm btn-danger" onclick="removeItem(${index})">Hapus</button></td>
                            </tr>
                        `).join('');
                    }
                    
                    function clearInputs() {
                        document.getElementById('cart_menu').value = '';
                        document.getElementById('cart_qty').value = '1';
                        toggleAddBtn();
                    }
                    
                    function clearAll() {
                        cart = [];
                        renderCart();
                        document.getElementById('meja').value = '';
                        document.getElementById('no_meja').value = '';
                        document.getElementById('cart_data').value = '';
                        toggleSubmitBtn();
                    }
                    
                    function toggleSubmitBtn() {
                        const meja = document.getElementById('meja').value;
                        document.getElementById('submitBtn').disabled = !meja || cart.length === 0;
                    }
                    
                    // Form submit
                    document.getElementById('pesananForm').addEventListener('submit', function(e) {
                        if (cart.length === 0) {
                            e.preventDefault();
                            alert('Tambahkan minimal 1 item!');
                            return;
                        }
                        document.getElementById('cart_data').value = JSON.stringify(cart.map(item => ({
                            menu: item.menu,
                            jumlah: item.jumlah
                        })));
                    });
                    
                    // Meja change
                    function setNoMeja() {
                        const mejaSelect = document.getElementById('meja');
                        const noMejaInput = document.getElementById('no_meja');
                        if (mejaSelect.value) {
                            const selectedOption = mejaSelect.options[mejaSelect.selectedIndex];
                            noMejaInput.value = selectedOption.getAttribute('data-no-meja');
                        } else {
                            noMejaInput.value = '';
                        }
                        toggleSubmitBtn();
                    }
                    
                    document.getElementById('clearCartBtn').addEventListener('click', function() {
                        cart = [];
                        renderCart();
                        toggleSubmitBtn();
                    });
                    </script>
                </div>
            </div>
        </div>
    </main>

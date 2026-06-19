<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sraddha - Menu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/vmenu.css') ?>">
</head>

<body>

    <div class="container-fluid p-0">

        <!-- ================================================================
             HEADER
             ================================================================ -->
        <div class="site-header py-1">
            <header class="site-header__inner py-3 px-3">
                <h1 class="site-header__brand">Sraddha Coffee</h1>

                <button type="button" class="site-header__search-btn" id="toggleSearch">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </header>

            <div class="px-3 pb-2 d-none" id="searchContainer">
                <input
                    type="text"
                    id="searchMenu"
                    class="form-control"
                    placeholder="Cari menu...">
            </div>
        </div>

        <!-- ================================================================
             HERO
             ================================================================ -->
        <div class="hero-section">
            <img src="<?php echo base_url('assets/assets/img/hero.png') ?>"
                alt="Hero Image"
                class="hero__image">
        </div>

        <!-- ================================================================
             OPERATIONAL HOURS
             ================================================================ -->
        <div class="container py-3">
            <div class="card ops-card">
                <div class="card-body">

                    <h5 class="ops-card__title">Jam Operasional</h5>

                    <?php if ($jam_operasional): ?>
                        <?php
                        date_default_timezone_set('Asia/Jakarta');
                        $sekarang = date('H:i:s');
                        $status = (
                            $sekarang >= $jam_operasional->jam_buka &&
                            $sekarang <= $jam_operasional->jam_tutup
                        ) ? 'Buka hari ini' : 'Tutup';
                        ?>
                        <p class="ops-card__subtitle">
                            <?= $status; ?>,
                            <?= date('H:i', strtotime($jam_operasional->jam_buka)); ?>
                            -
                            <?= date('H:i', strtotime($jam_operasional->jam_tutup)); ?>
                        </p>
                    <?php else: ?>
                        <p class="ops-card__subtitle">Jam operasional belum tersedia</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <!-- ================================================================
             TABLE NUMBER
             ================================================================ -->
        <div class="container">
            <div class="card table-card">
                <div class="card-body py-1">
                    <h5 class="table-card__label">
                        Nomor Meja: <?= $this->session->userdata('no_meja'); ?>
                    </h5>
                </div>
            </div>
        </div>

        <!-- ================================================================
             CATEGORY DROPDOWN
             ================================================================ -->
        <div class="container py-3">
            <div class="dropdown">

                <button class="btn category-dropdown"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <span>Kategori</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>


                <ul class="dropdown-menu w-100 category-dropdown__menu">
                    <?php foreach ($kategori as $k): ?>
                        <li>
                            <a class="dropdown-item category-dropdown__item"
                                href="#kategori-<?= $k->id_kategori ?>">
                                <?= $k->nama_kategori ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>


            </div>
        </div>

        <!-- ================================================================
             FEATURED MENU  (Menu Andalan)
             ================================================================ -->
        <section class="container py-3 p-3">
            <h2 class="section__title mb-3">Menu Andalan</h2>

            <div class="featured-menu__scroll">
                <?php foreach ($menu_andalan as $m): ?>
                    <div class="card featured-menu__card">

                        <img src="<?= base_url('assets/uploads/' . $m->gambar) ?>"
                            class="card-img-top featured-menu__image"
                            alt="Menu">

                        <div class="card-body"
                            data-bs-toggle="modal"
                            data-bs-target="#detail-menu-modal"
                            data-id="<?= $m->id_menu ?>"
                            data-nama="<?= $m->nama_menu ?>"
                            data-harga="<?= $m->harga ?>"
                            data-gambar="<?= base_url('assets/uploads/' . $m->gambar) ?>"
                            data-deskripsi="<?= $m->deskripsi ?>">
                            <h5 class="featured-menu__name mb-1"><?= $m->nama_menu ?></h5>
                            <p class="featured-menu__price">
                                Rp <?= number_format($m->harga, 0, ',', '.') ?>
                            </p>
                        </div>

                        <div class="card-body p-1">
                            <button class="btn-add w-100" data-id="<?= $m->id_menu ?>">
                                Tambah
                            </button>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- ================================================================
             MENU LIST  (per-category)
             ================================================================ -->
        <div id="searchResult"></div>

        <div id="menuByCategory">
            <?php foreach ($kategori as $k): ?>
                <section id="kategori-<?= $k->id_kategori ?>" class="container-fluid px-2 py-3">

                    <div class="section__heading-row mb-3">
                        <h2 class="section__heading-text"><?= $k->nama_kategori ?></h2>
                        <div class="section__heading-line"></div>
                    </div>

                    <div class="card menu-list border-0 rounded-0">
                        <?php foreach ($menu as $m): ?>
                            <?php if ($m->id_kategori == $k->id_kategori): ?>

                                <div class="menu-list__item border-bottom menu-item">

                                    <div class="menu-list__clickable"
                                        data-bs-toggle="modal"
                                        data-bs-target="#detail-menu-modal"
                                        data-id="<?= $m->id_menu ?>"
                                        data-nama="<?= $m->nama_menu ?>"
                                        data-harga="<?= $m->harga ?>"
                                        data-gambar="<?= base_url('assets/uploads/' . $m->gambar) ?>"
                                        data-deskripsi="<?= $m->deskripsi ?>">

                                        <img src="<?= base_url('assets/uploads/' . $m->gambar) ?>"
                                            alt="<?= $m->nama_menu ?>"
                                            class="menu-list__image">

                                        <div class="menu-list__info">
                                            <h3 class="menu-list__name"><?= $m->nama_menu ?></h3>
                                            <p class="menu-list__price">
                                                Rp<?= number_format($m->harga, 0, ',', '.') ?>
                                            </p>
                                        </div>

                                    </div>

                                    <div class="menu-list__action">
                                        <button type="button"
                                            class="btn-add btn-add--list"
                                            data-id="<?= $m->id_menu ?>">
                                            Tambah
                                        </button>
                                    </div>

                                </div>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>

                </section>
            <?php endforeach; ?>
        </div>

        <!-- ================================================================
             CART BAR  (fixed bottom)
             ================================================================ -->
        <?php
        $cart       = $this->session->userdata('cart') ?? [];
        $total_harga = 0;
        $total_qty   = 0;
        foreach ($cart as $item) {
            $total_qty   += $item['qty'];
            $total_harga += ((float)$item['harga'] * $item['qty']);
        }
        ?>

        <div id="cart-bar"
            class="cart-bar <?= empty($cart) ? 'd-none' : '' ?>"
            data-bs-toggle="modal"
            data-bs-target="#cart-modal">

            <div class="cart-bar__icon-wrap">
                <i class="fa fa-shopping-cart"></i>
            </div>

            <div class="cart-bar__info">
                <h5 class="cart-bar__info-label">Total</h5>
                <h4 class="cart-bar__info-total">
                    Rp<?= number_format($total_harga, 0, ',', '.') ?>
                </h4>
            </div>

            <div class="cart-bar__action">
                <button type="button"
                    class="cart-bar__checkout-btn"
                    data-bs-toggle="modal"
                    data-bs-target="#cart-modal">
                    Checkout
                </button>
            </div>

        </div>


        <!-- ================================================================
             DETAIL MENU MODAL
             ================================================================ -->
        <div class="modal fade" id="detail-menu-modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-bottom modal-fullscreen-sm-down modal-dialog-scrollable">
                <div class="modal-content">

                    <form action="<?= base_url('customer/add_to_cart') ?>" method="post">

                        <!-- hidden fields -->
                        <input type="hidden" name="menu_id" id="menu_id">
                        <input type="hidden" name="menu_name" id="menu_name">
                        <input type="hidden" name="menu_price" id="menu_price">

                        <div class="modal-body">

                            <!-- Image -->
                            <div class="detail-modal__image-wrap">
                                <img id="modal_gambar" src="" alt="Menu Image">
                            </div>

                            <!-- Info -->
                            <div class="detail-modal__info">
                                <h3 class="detail-modal__name mb-1" id="modal_nama"></h3>
                                <p class="detail-modal__price mb-4" id="modal_harga"></p>
                                <p class="detail-modal__deskripsi mb-4" id="modal_deskripsi"></p>
                            </div>

                            <!-- Add-ons -->
                            <div class="detail-modal__addons">
                                <h4 class="detail-modal__addons-title">Add-ons</h4>

                                <div class="addon-row">
                                    <div class="addon-row__left">
                                        <h5 class="addon-row__name">Ice</h5>
                                        <span class="addon-row__price">(+Rp2.000)</span>
                                    </div>
                                    <div class="addon-row__qty">
                                        <input type="hidden" name="addon_ice" value="0">
                                        <button type="button" class="addon-row__btn">-</button>
                                        <span class="addon-row__count">0</span>
                                        <button type="button" class="addon-row__btn">+</button>
                                    </div>
                                </div>

                                <div class="addon-row">
                                    <div class="addon-row__left">
                                        <h5 class="addon-row__name">Ice</h5>
                                        <span class="addon-row__price">(+Rp2.000)</span>
                                    </div>
                                    <div class="addon-row__qty">
                                        <input type="hidden" name="addon_ice2" value="0">
                                        <button type="button" class="addon-row__btn">-</button>
                                        <span class="addon-row__count">0</span>
                                        <button type="button" class="addon-row__btn">+</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="detail-modal__notes">
                                <h4 class="detail-modal__notes-title mb-2">Catatan</h4>
                                <div class="input-group">
                                    <textarea class="form-control"
                                        name="note"
                                        placeholder="Contoh: Tambahkan sedikit gula"
                                        rows="3"></textarea>
                                </div>
                            </div>

                            <!-- Footer controls -->
                            <div class="detail-modal__footer">

                                <div class="detail-modal__qty-row">
                                    <h4 class="detail-modal__qty-label">Jumlah Pesanan</h4>
                                    <div class="detail-modal__qty-controls">
                                        <button type="button" class="detail-modal__qty-btn btn-minus">-</button>
                                        <span id="qty-text">1</span>
                                        <button type="button" class="detail-modal__qty-btn btn-plus">+</button>
                                    </div>
                                </div>

                                <button type="submit" class="btn-add w-100">
                                    Tambah ke Pesanan -
                                    <span class="detail-modal__submit-price">Rp 30.000</span>
                                </button>

                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>


        <!-- ================================================================
             CART MODAL
             ================================================================ -->
        <div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="cart-modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-bottom modal-fullscreen-sm-down modal-dialog-scrollable">
                <div class="modal-content">

                    <form id="checkout-form" action="/checkout" method="POST">

                        <!-- Header -->
                        <div class="modal-header cart-modal__header">
                            <button type="button"
                                class="cart-modal__back-btn"
                                data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                            <h5 class="modal-title cart-modal__title" id="cart-modal-title">
                                Pesanan
                            </h5>
                        </div>

                        <!-- Body -->
                        <div class="modal-body">

                            <!-- Table number -->
                            <div class="mb-4">
                                <label class="cart-modal__table-label">Nomor meja</label>
                                <div class="cart-modal__table-box">
                                    <img src="assets/assets/icons/tableIcons.svg"
                                        alt="Table Icon"
                                        class="cart-modal__table-icon">
                                    <span>01</span>
                                    <input type="hidden" name="table_number" value="01">
                                </div>
                            </div>

                            <!-- Items header row -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 cart-modal__items-header">
                                    Item yang Dipesan (1)
                                </h6>
                                <button type="button"
                                    class="cart-modal__add-item-btn"
                                    data-bs-dismiss="modal">
                                    <i class="fa-solid fa-plus"></i>
                                    <span>Tambah Pesanan</span>
                                </button>
                            </div>

                            <!-- Cart items -->
                            <div class="cart-items">

                                <div class="cart-item">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="mb-1">MALA</h6>
                                            <small class="text-muted">Tidak ada catatan</small>
                                            <div class="fw-bold mt-1">Rp25.000</div>
                                        </div>
                                        <div class="cart-item__qty">
                                            <button type="button" class="cart-item__qty-btn">−</button>
                                            <span class="cart-item__qty-value">1</span>
                                            <button type="button" class="cart-item__qty-btn">+</button>
                                            <input type="hidden" name="items[0][id]" value="1">
                                            <input type="hidden" name="items[0][qty]" value="1">
                                        </div>
                                    </div>
                                </div>

                                <div class="cart-item">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="mb-1">MALA</h6>
                                            <small class="text-muted">Tidak ada catatan</small>
                                            <div class="fw-bold mt-1">Rp25.000</div>
                                        </div>
                                        <div class="cart-item__qty">
                                            <button type="button" class="cart-item__qty-btn">−</button>
                                            <span class="cart-item__qty-value">1</span>
                                            <button type="button" class="cart-item__qty-btn">+</button>
                                            <input type="hidden" name="items[0][id]" value="1">
                                            <input type="hidden" name="items[0][qty]" value="1">
                                        </div>
                                    </div>
                                </div>

                                <div class="cart-modal__divider"></div>

                                <!-- Payment summary -->
                                <div class="payment-summary">
                                    <h5 class="payment-summary__title">Rincian Pembayaran</h5>

                                    <div class="payment-summary__row">
                                        <div>
                                            <span class="payment-summary__label">Subtotal</span>
                                            <span class="payment-summary__sub">(1 menu)</span>
                                        </div>
                                        <span class="payment-summary__value">Rp25.000</span>
                                    </div>

                                    <div class="payment-summary__divider"></div>

                                    <div class="payment-summary__row">
                                        <span class="payment-summary__label">Biaya Layanan</span>
                                        <span class="payment-summary__value">Rp1.000</span>
                                    </div>

                                    <div class="payment-summary__row payment-summary__row--total">
                                        <span class="payment-summary__label">Total</span>
                                        <span class="payment-summary__value--total">Rp26.000</span>
                                    </div>

                                    <input type="hidden" name="subtotal" value="25000">
                                    <input type="hidden" name="service_fee" value="1000">
                                    <input type="hidden" name="total" value="26000">
                                </div>

                                <!-- Payment method -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Metode Pembayaran</label>
                                    <div class="row g-3">

                                        <div class="col-6">
                                            <input type="radio"
                                                class="btn-check"
                                                name="payment_method"
                                                id="payment-qris"
                                                value="qris"
                                                required>
                                            <label class="payment-method__card" for="payment-qris">
                                                <div class="payment-method__icon">
                                                    <img src="<?= base_url('assets/assets/icons/paymentIcons.svg') ?>" alt="QRIS">
                                                </div>
                                                <div class="payment-method__label">QRIS</div>
                                            </label>
                                        </div>

                                        <div class="col-6">
                                            <input type="radio"
                                                class="btn-check"
                                                name="payment_method"
                                                id="payment-cashier"
                                                value="cashier"
                                                required>
                                            <label class="payment-method__card" for="payment-cashier">
                                                <div class="payment-method__icon">
                                                    <img src="<?= base_url('assets/assets/icons/payIcons.svg') ?>" alt="Bayar di Kasir">
                                                </div>
                                                <div class="payment-method__label">Bayar di Kasir</div>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <!-- Footer -->
                            <div class="cart-modal__footer">
                                <div class="cart-modal__footer-info">
                                    <span class="cart-modal__footer-label">Total Pembayaran</span>
                                    <h4 class="cart-modal__footer-total">Rp26.000</h4>
                                </div>
                                <button type="submit" class="btn cart-modal__pay-btn">
                                    Bayar
                                </button>
                            </div>

                        </div><!-- /.modal-body -->

                    </form>

                </div>
            </div>
        </div>

    </div><!-- /.container-fluid -->


    <!-- ====================================================================
         SCRIPTS
         ==================================================================== -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // Search
        document.getElementById('toggleSearch').addEventListener('click', function() {
            document.getElementById('searchContainer').classList.toggle('d-none');

            const input = document.getElementById('searchMenu');

            if (!document.getElementById('searchContainer').classList.contains('d-none')) {
                input.focus();
            }
        });

        document.getElementById('searchMenu').addEventListener('keyup', function() {

            let keyword = this.value.toLowerCase();

            document.querySelectorAll('section[id^="kategori-"]').forEach(function(section) {

                let hasVisibleMenu = false;

                section.querySelectorAll('.menu-item').forEach(function(item) {

                    let nama = item.querySelector('.menu-list__name')
                        .textContent
                        .toLowerCase();

                    if (nama.includes(keyword)) {
                        item.style.display = '';
                        hasVisibleMenu = true;
                    } else {
                        item.style.display = 'none';
                    }

                });

                section.style.display = hasVisibleMenu || keyword === '' ?
                    '' :
                    'none';
            });

        });

        /* ── Add to cart (AJAX) ─────────────────────────────────────────── */
        $(document).on('click', '.btn-add', function() {

            const id_menu = $(this).data('id');

            $.ajax({
                url: "<?= base_url('tambah-cart') ?>",
                type: 'POST',
                data: {
                    id_menu
                },
                dataType: 'json',

                success: function(res) {

                    if (res.status) {

                        if (res.total_qty > 0) {
                            $('.cart-bar').removeClass('d-none');
                        } else {
                            $('.cart-bar').addClass('d-none');
                        }

                        $('.cart-bar__info-total').text('Rp' + res.total_harga);
                    }
                },

                error: function(xhr, status, error) {
                    console.error('AJAX error:', status, error, xhr.responseText);
                }
            });

        });


        /* ── Hide cart bar while a modal is open ────────────────────────── */
        document.addEventListener('DOMContentLoaded', function() {

            const cartBar = document.getElementById('cart-bar');

            ['cart-modal', 'detail-menu-modal'].forEach(function(id) {
                const modal = document.getElementById(id);
                if (!modal) return;

                modal.addEventListener('shown.bs.modal', () => cartBar.classList.add('cart-bar--hidden'));
                modal.addEventListener('hidden.bs.modal', () => cartBar.classList.remove('cart-bar--hidden'));
            });

        });


        /* ── Populate detail menu modal ─────────────────────────────────── */
        document.addEventListener('DOMContentLoaded', function() {

            const modal = document.getElementById('detail-menu-modal');

            modal.addEventListener('show.bs.modal', function(event) {

                const trigger = event.relatedTarget;

                const id = trigger.getAttribute('data-id');
                const nama = trigger.getAttribute('data-nama');
                const harga = trigger.getAttribute('data-harga');
                const gambar = trigger.getAttribute('data-gambar');
                const deskripsi = trigger.getAttribute('data-deskripsi');

                document.getElementById('menu_id').value = id;
                document.getElementById('menu_name').value = nama;
                document.getElementById('menu_price').value = harga;

                document.getElementById('modal_nama').innerText = nama;
                document.getElementById('modal_harga').innerText = 'Rp ' + Number(harga).toLocaleString('id-ID');
                document.getElementById('modal_deskripsi').innerText = deskripsi;
                document.getElementById('modal_gambar').src = gambar;
            });

        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>

</html>
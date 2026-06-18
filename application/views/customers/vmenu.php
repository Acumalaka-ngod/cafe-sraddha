<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sraddha - Menu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alan+Sans:wght@700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/vmenu.css') ?>">
</head>

<!-- <style>

</style> -->

<body>


    <div class="container-fluid p-0">

        <!-- Header  -->
        <div class="header-wrapper py-1">

            <header class="d-flex justify-content-between align-items-center py-3 px-3">

                <h1 class="mb-0 fw-semibold brand-title">
                    Sraddha Coffee
                </h1>

                <i class="fa-solid fa-magnifying-glass search-icon"></i>

            </header>

        </div>
        <!-- End of Header -->

        <!-- Hero -->
        <div class="hero-section">
            <img src="<?php echo base_url('assets/assets/img/hero.png') ?>" alt="Hero Image" class="hero-image">
        </div>
        <!-- End of Hero -->

        <!-- Operational Hours -->
        <div class="container py-3">
            <div class="card operational-card">
                <div class="card-body">

                    <h5 class="mb-1 operational-title">
                        Jam Operasional
                    </h5>

                    <p class="mb-0 operational-subtitle">
                        Buka hari ini, 14:00 - 22:00
                    </p>
                </div>
            </div>
        </div>
        <!-- End of Operational Hours -->

        <!-- Table Number -->
        <div class="container">
            <div class="card table-card">
                <div class="card-body py-1">

                    <h5 class="table-title text-center">
                        Nomor Meja: <?= $this->session->userdata('no_meja'); ?>
                    </h5>

                </div>
            </div>
        </div>
        <!-- End of Table Number -->

        <!-- Kategori -->
        <div class="container py-3">

            <div class="dropdown">

                <button class="btn category-dropdown d-flex justify-content-between align-items-center"
                    type="button"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">

                    <span>Kategori</span>

                    <i class="fa-solid fa-chevron-down"></i>

                </button>

                <ul class="dropdown-menu w-100 category-menu">

                    <li>
                        <a class="dropdown-item" href="#">
                            Coffee
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            Non Coffee
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            Dessert
                        </a>
                    </li>

                </ul>

            </div>

        </div>
        <!-- End of Kategori -->

        <!-- Menu Andalan -->
        <section class="container py-3 p-3">
            <h2 class="section-title mb-3">
                Menu Andalan
            </h2>

            <div class="menu-scroll">
                <!-- Menu Card -->
                <?php foreach ($menu_andalan as $m): ?>
                    <div class="card menu-card">
                        <img src="<?= base_url('assets/uploads/' . $m->gambar) ?>" class="card-img-top menu-image" alt="Menu">
                        <div class="card-body" data-bs-toggle="modal" data-bs-target="#detailMenuModal">
                            <h5 class="menu-title mb-1">
                                <?= $m->nama_menu ?>
                            </h5>
                            <p class="menu-price">
                                Rp <?= number_format($m->harga, 0, ',', '.') ?>
                            </p>

                        </div>
                        <div class="card-body p-1">
                            <button class=" btn-tambah w-100" data-id="<?= $m->id_menu ?>">
                                Tambah
                            </button>
                            <!-- <button id="btnKosongkanCart" class="btn btn-danger">
                                Kosongkan Cart
                            </button> -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <!-- End of Menu Andalan -->

        <!-- Makanan Berat -->
        <section class="container-fluid px-2 py-3">

            <!-- Title -->
            <div class="section-menu mb-3">

                <h2 class="menu-heading">
                    Makanan Berat
                </h2>

                <div class="section-line"></div>

            </div>


            <!-- Menu List -->
            <div class="card makanan-card border-0 rounded-0">

                <!-- Item -->
                <div class="menu-item border-bottom">

                    <img src="<?php echo base_url('assets/assets/img/mala.png') ?>" alt="Menu" class="menu-item-image">

                    <div class="menu-item-content">
                        <h3 class="menu-item-title">
                            Nasi Goreng Sraddha
                        </h3>
                        <div class="menu-bottom">
                            <p class="menu-item-price">
                                Rp20.000
                            </p>
                            <button class="btn btn-tambah-list" data-bs-toggle="modal" data-bs-target="#detailMenuModal">
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of Makanan Berat -->

        <!-- Coffee -->
        <section class="container-fluid px-2 py-3">

            <!-- Title -->
            <div class="section-menu mb-3">

                <h2 class="menu-heading">
                    Coffee
                </h2>

                <div class="section-line"></div>

            </div>


            <!-- Menu List -->
            <div class="card makanan-card border-0 rounded-0">

                <!-- Item -->
                <div class="menu-item border-bottom">

                    <img src="<?php echo base_url('assets/assets/img/mala.png') ?>" alt="Menu" class="menu-item-image">

                    <div class="menu-item-content">
                        <h3 class="menu-item-title">
                            Nasi Goreng Sraddha
                        </h3>
                        <div class="menu-bottom">
                            <p class="menu-item-price">
                                Rp20.000
                            </p>
                            <button class="btn btn-tambah-list" data-bs-toggle="modal" data-bs-target="#detailMenuModal">
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of Coffee -->

        <!-- Non Coffee -->
        <section class="container-fluid px-2 py-3">

            <!-- Title -->
            <div class="section-menu mb-3">

                <h2 class="menu-heading">
                    Non Coffee
                </h2>

                <div class="section-line"></div>

            </div>


            <!-- Menu List -->
            <div class="card makanan-card border-0 rounded-0">

                <!-- Item -->
                <div class="menu-item border-bottom">

                    <img src="<?php echo base_url('assets/assets/img/mala.png') ?>" alt="Menu" class="menu-item-image">

                    <div class="menu-item-content">
                        <h3 class="menu-item-title">
                            Nasi Goreng Sraddha
                        </h3>
                        <div class="menu-bottom">
                            <p class="menu-item-price">
                                Rp20.000
                            </p>
                            <button class="btn btn-tambah-list" data-bs-toggle="modal" data-bs-target="#detailMenuModal">
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of Non Coffee -->

        <!-- Cart Checkout -->
        <?php

        $cart = $this->session->userdata('cart') ?? [];

        $total_harga = 0;
        $total_qty = 0;

        foreach ($cart as $item) {

            $total_qty += $item['qty'];

            $total_harga +=
                ((float)$item['harga'] * $item['qty']);
        }
        ?>

        <div
            id="checkoutCart"
            class="checkout-cart <?= empty($cart) ? 'd-none' : '' ?>"
            data-bs-toggle="modal"
            data-bs-target="#cartModal">

            <div class="checkout-icon">
                <i class="fa fa-shopping-cart"></i>
            </div>

            <div class="checkout-info">
                <h5 class="checkout-title">Total</h5>
                <h4 class="total-hrg"> Rp<?= number_format($total_harga, 0, ',', '.') ?></h4>
            </div>

            <div class="checkout-action">
                <button
                    type="button"
                    class="btn-checkout"
                    data-bs-toggle="modal"
                    data-bs-target="#cartModal">
                    Checkout
                </button>
            </div>

        </div>



        <!-- Detail Menu/Modal -->
        <div class="modal fade" id="detailMenuModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-bottom modal-fullscreen-sm-down modal-dialog-scrollable">
                <div class="modal-content custom-modal">

                    <form action="<?= base_url('customer/add_to_cart') ?>" method="post">

                        <!-- data menu -->
                        <input type="hidden" name="menu_id" value="1">
                        <input type="hidden" name="menu_name" value="MALA">
                        <input type="hidden" name="menu_price" value="28000">
                        <input type="hidden" name="qty" id="qty" value="1">
                        <div class="modal-body p-0">

                            <div class="modal-img">
                                <img src="<?php echo base_url('assets/assets/img/mala.png') ?>" alt="Menu Image" class="img-fluid">
                            </div>


                            <div class="menu-detail-card">
                                <h3 class="menu-detail-title mb-1">
                                    MALA
                                </h3>
                                <p class="menu-detail-price mb-2">
                                    Rp 28.000
                                </p>
                                <p class="menu-detail-description mb-4">
                                    MALA adalah Matcha Latte. Rasanya Lembut , creamy , dan penuh energi untuk setiap momen santai
                                </p>
                            </div>

                            <div class="menu-addons-card">

                                <h4 class="menu-addons-title">
                                    Add-ons
                                </h4>

                                <div class="addon-item">

                                    <div class="addon-left">

                                        <h5 class="addon-name">
                                            Ice
                                        </h5>

                                        <span class="addon-price">
                                            (+Rp2.000)
                                        </span>

                                    </div>

                                    <div class="addon-qty">

                                        <input type="hidden" name="addon_ice" value="0">

                                        <button type="button" class="addon-btn">
                                            -
                                        </button>

                                        <span class="addon-count">
                                            0
                                        </span>

                                        <button type="button" class="addon-btn">
                                            +
                                        </button>

                                    </div>
                                </div>

                                <div class="addon-item">

                                    <div class="addon-left">

                                        <h5 class="addon-name">
                                            Ice
                                        </h5>

                                        <span class="addon-price">
                                            (+Rp2.000)
                                        </span>

                                    </div>

                                    <div class="addon-qty">

                                        <input type="hidden" name="addon_ice2" value="0">

                                        <button type="button" class="addon-btn">
                                            -
                                        </button>

                                        <span class="addon-count">
                                            0
                                        </span>

                                        <button type="button" class="addon-btn">
                                            +
                                        </button>

                                    </div>
                                </div>

                            </div>

                            <div class="menu-note-card">
                                <h4 class="menu-note-title mb-2">
                                    Catatan
                                </h4>

                                <div class="input-group">
                                    <textarea
                                        class="form-control"
                                        name="note"
                                        placeholder="Contoh: Tambahkan sedikit gula"
                                        rows="3"></textarea>
                                </div>

                            </div>

                            <div class="menu-footer-card">

                                <div class="footer-qty">

                                    <h4 class="footer-title">
                                        Jumlah Pesanan
                                    </h4>

                                    <div class="footer-action">

                                        <button type="button" class="footer-btn btn-minus">
                                            -
                                        </button>

                                        <span class="footer-count" id="qty-text">
                                            1
                                        </span>

                                        <button type="button" class="footer-btn btn-plus">
                                            +
                                        </button>

                                    </div>

                                </div>

                                <!-- <div class="footer-btn-add"> -->

                                <button type="submit" class="btn btn-tambah w-100">
                                    Tambah ke Pesanan -
                                    <span class="footer-total-price">
                                        Rp 30.000
                                    </span>
                                </button>

                                <!-- </div> -->

                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>


        <!-- Modal Cart -->
        <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-bottom modal-fullscreen-sm-down modal-dialog-scrollable">
                <div class="modal-content">

                    <form id="checkoutForm" action="/checkout" method="POST">

                        <!-- Header -->
                        <div class="modal-header">
                            <button
                                type="button"
                                class="modal-back-btn"
                                data-bs-dismiss="modal"
                                aria-label="Close">

                                <i class="fa-solid fa-arrow-left"></i>

                            </button>
                            <h5 class="modal-title text-center" id="cartModalLabel">
                                Pesanan
                            </h5>
                        </div>

                        <!-- Body -->
                        <div class="modal-body">

                            <!-- Nomor Meja -->
                            <div class="mb-4">
                                <label class="table-label">Nomor meja</label>

                                <div class="table-number-box">
                                    <img src="assets/assets/icons/tableIcons.svg"
                                        alt="Table Icon"
                                        class="table-icon">

                                    <span>01</span>

                                    <input type="hidden" name="table_number" value="01">
                                </div>
                            </div>

                            <!-- Item Pesanan -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 item-dipesan">
                                    Item yang Dipesan (1)
                                </h6>

                                <button type="button" class="btn-tambah-pesanan" data-bs-dismiss="modal">
                                    <i class="fa-solid fa-plus"></i>
                                    <span>Tambah Pesanan</span>
                                </button>
                            </div>

                            <!-- Item -->
                            <div class="cart-items">
                                <div class="cart-item">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="mb-1">MALA</h6>
                                            <small class="text-muted">Tidak ada catatan</small>
                                            <div class="fw-bold mt-1">Rp25.000</div>
                                        </div>

                                        <div class="qty-control">
                                            <button type="button" class="qty-btn">−</button>
                                            <span class="qty-value">1</span>
                                            <button type="button" class="qty-btn">+</button>

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

                                        <div class="qty-control">
                                            <button type="button" class="qty-btn">−</button>
                                            <span class="qty-value">1</span>
                                            <button type="button" class="qty-btn">+</button>

                                            <input type="hidden" name="items[0][id]" value="1">
                                            <input type="hidden" name="items[0][qty]" value="1">
                                        </div>
                                    </div>
                                </div>

                                <div class="divider-line"></div>

                                <!-- Rincian Pembayaran -->
                                <div class="payment-summary-card">
                                    <h5 class="payment-title">
                                        Rincian Pembayaran
                                    </h5>

                                    <div class="summary-row">
                                        <div>
                                            <span class="summary-label">Subtotal</span>
                                            <span class="summary-sub">(1 menu)</span>
                                        </div>
                                        <span class="summary-price">Rp25.000</span>
                                    </div>

                                    <div class="summary-divider"></div>

                                    <div class="summary-row">
                                        <span class="summary-label">Biaya Layanan</span>
                                        <span class="summary-price">Rp1.000</span>
                                    </div>

                                    <div class="summary-row total-row">
                                        <span class="summary-label">Total</span>
                                        <span class="total-price">Rp26.000</span>
                                    </div>

                                    <input type="hidden" name="subtotal" value="25000">
                                    <input type="hidden" name="service_fee" value="1000">
                                    <input type="hidden" name="total" value="26000">
                                </div>

                                <!-- Metode Pembayaran -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Metode Pembayaran
                                    </label>

                                    <div class="row g-3">

                                        <!-- QRIS -->
                                        <div class="col-6 col-md-6">
                                            <input type="radio"
                                                class="btn-check"
                                                name="payment_method"
                                                id="paymentQris"
                                                value="qris"
                                                required>

                                            <label class="payment-card" for="paymentQris">

                                                <div class="payment-icon">
                                                    <img src="<?= base_url('assets/assets/icons/paymentIcons.svg') ?>"
                                                        alt="QRIS">
                                                </div>

                                                <div class="payment-label">
                                                    QRIS
                                                </div>

                                            </label>
                                        </div>

                                        <!-- Bayar di Kasir -->
                                        <div class="col-6 col-md-6">
                                            <input type="radio"
                                                class="btn-check"
                                                name="payment_method"
                                                id="paymentCashier"
                                                value="cashier"
                                                required>

                                            <label class="payment-card" for="paymentCashier">

                                                <div class="payment-icon">
                                                    <img src="<?= base_url('assets/assets/icons/payIcons.svg') ?>"
                                                        alt="Bayar di Kasir">
                                                </div>

                                                <div class="payment-label">
                                                    Bayar di Kasir
                                                </div>

                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <!-- Catatan -->
                                <!-- <div class="mb-3">
                                    <label class="form-label">Catatan Pesanan</label>
                                    <textarea class="form-control"
                                        name="notes"
                                        rows="3"
                                        placeholder="Tambahkan catatan jika ada"></textarea>
                                </div> -->

                            </div>

                            <!-- Footer -->
                            <div class="checkout-footer-card">

                                <div class="checkout-footer-info">
                                    <span class="checkout-footer-label">
                                        Total Pembayaran
                                    </span>

                                    <h4 class="checkout-footer-total">
                                        Rp26.000
                                    </h4>
                                </div>

                                <button type="submit" class="btn checkout-footer-btn">
                                    Bayar
                                </button>

                            </div>

                    </form>

                </div>
            </div>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // Cart
        $(document).on('click', '.btn-tambah', function() {

            let id_menu = $(this).data('id');

            console.log('Klik Menu ID :', id_menu);

            $.ajax({

                url: "<?= base_url('tambah-cart') ?>",

                type: "POST",

                data: {
                    id_menu: id_menu
                },

                dataType: "json",

                beforeSend: function() {
                    console.log('Mengirim request...');
                },

                success: function(res) {

                    console.log('Response:', res);

                    if (res.status) {

                        $('#checkoutCart').removeClass('d-none');

                        $('.total-hrg').text(
                            'Rp' + res.total_harga
                        );

                    } else {

                        console.log('Menu tidak ditemukan');

                    }
                },

                error: function(xhr, status, error) {

                    console.log('AJAX ERROR');
                    console.log('Status:', status);
                    console.log('Error:', error);
                    console.log(xhr.responseText);

                }

            });

        });

        // Kosongkan Cart
        // $(document).on('click', '#btnKosongkanCart', function() {

        //     $.ajax({

        //         url: "base_url('kosongkan-cart')",

        //         type: "POST",

        //         dataType: "json",

        //         success: function(res) {

        //             if (res.status) {

        //                 $('#checkoutCart').addClass('d-none');

        //                 $('.total-hrg').text('Rp0');

        //                 console.log('Cart berhasil dikosongkan');

        //             }

        //         }

        //     });

        // });

        // Modal
        document.addEventListener('DOMContentLoaded', function() {

            const checkoutCart = document.querySelector('.checkout-cart');

            const modals = [
                document.getElementById('cartModal'),
                document.getElementById('detailMenuModal')
            ];

            modals.forEach(modal => {
                if (!modal) return;

                modal.addEventListener('shown.bs.modal', () => {
                    checkoutCart.classList.add('hide');
                });

                modal.addEventListener('hidden.bs.modal', () => {
                    checkoutCart.classList.remove('hide');
                });
            });

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
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

<style>

</style>

<body>


    <div class="container-fluid p-0">

        <!-- Header -->
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
                        Nomor Meja: 1
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
                <div class="card menu-card">
                    <img src="<?php echo base_url('assets/assets/img/mala.png') ?>" class="card-img-top menu-image" alt="Menu">
                    <div class="card-body">
                        <h5 class="menu-title mb-1">
                            MALA
                        </h5>
                        <p class="menu-price">
                            Rp 28.000
                        </p>
                        <div class="card-body p-1">
                            <button class=" btn-tambah w-100" data-bs-toggle="modal" data-bs-target="#detailMenuModal">
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card menu-card">
                    <img src="<?php echo base_url('assets/assets/img/mala.png') ?>" class="card-img-top menu-image" alt="Menu">
                    <div class="card-body">
                        <h5 class="menu-title mb-1">
                            MALA
                        </h5>
                        <p class="menu-price">
                            Rp 28.000
                        </p>
                        <div class="card-body p-1">
                            <button class=" btn-tambah w-100" data-bs-toggle="modal" data-bs-target="#detailMenuModal">
                                Tambah
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card menu-card">
                    <img src="<?php echo base_url('assets/assets/img/mala.png') ?>" class="card-img-top menu-image" alt="Menu">
                    <div class="card-body">
                        <h5 class="menu-title mb-1">
                            MALA
                        </h5>
                        <p class="menu-price">
                            Rp 28.000
                        </p>
                        <div class="card-body p-1">
                            <button class=" btn-tambah w-100" data-bs-toggle="modal" data-bs-target="#detailMenuModal">
                                Tambah
                            </button>
                        </div>
                    </div>
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
        <div class="checkout-cart">
            <div class="checkout-icon">
                <i class="fa fa-shopping-cart"></i>
            </div>

            <div class="checkout-info">
                <h5 class="checkout-title">Total</h5>
                <h4 class="total-hrg">Rp50.000</h4>
            </div>

            <div class="checkout-action">
                <a href="#" class="btn-checkout">Checkout</a>
            </div>
        </div>







        <!-- Detail Menu/Modal -->
        <div class="modal fade" id="detailMenuModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-bottom modal-fullscreen-sm-down">
                <div class="modal-content custom-modal">

                    <form action="<?= base_url('customer/add_to_cart') ?>" method="post">

                        <!-- data menu -->
                        <input type="hidden" name="menu_id" value="1">
                        <input type="hidden" name="menu_name" value="MALA">
                        <input type="hidden" name="menu_price" value="28000">
                        <input type="hidden" name="qty" id="qty" value="1">

                        <div class="modal-img">
                            <img src="<?php echo base_url('assets/assets/img/mala.png') ?>" alt="Menu Image" class="img-fluid">
                        </div>

                        <div class="modal-body p-0">

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

                                <div class="footer-btn-add">

                                    <button type="submit" class="btn btn-tambah w-100">
                                        Tambah ke Pesanan -
                                        <span class="footer-total-price">
                                            Rp 30.000
                                        </span>
                                    </button>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Menu Utama</div>
                    <a class="nav-link" href="<?php echo site_url('dashboard_cafe') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-th-large"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMenu"
                        aria-expanded="false" aria-controls="collapseMenu">
                        <div class="sb-nav-link-icon"><i class="fas fa-mug-hot"></i></div>
                        Menu
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseMenu" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?php echo site_url('dashboard_cafe/lihat_menu') ?>">
                                <i class="fas fa-list me-2"></i>Daftar Menu
                            </a>
                            <a class="nav-link" href="<?php echo site_url('dashboard_cafe/tambah_menu') ?>">
                                <i class="fas fa-plus me-2"></i>Tambah Menu
                            </a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseMeja"
                        aria-expanded="false" aria-controls="collapseMeja">
                        <div class="sb-nav-link-icon"><i class="fas fa-chair"></i></div>
                        Meja
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseMeja" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?php echo site_url('dashboard_cafe/lihat_meja') ?>">
                                <i class="fas fa-list me-2"></i>Daftar Meja
                            </a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseUser"
                        aria-expanded="false" aria-controls="collapseUser">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        User
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseUser" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?php echo site_url('dashboard_cafe/lihat_user') ?>">
                                <i class="fas fa-list me-2"></i>Daftar User
                            </a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTransaksi"
                        aria-expanded="false" aria-controls="collapseTransaksi">
                        <div class="sb-nav-link-icon"><i class="fas fa-receipt"></i></div>
                        Transaksi
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseTransaksi" aria-labelledby="headingTwo"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?php echo site_url('dashboard_cafe/lihat_transaksi') ?>">
                                <i class="fas fa-list me-2"></i>Daftar Transaksi
                            </a>
                            <a class="nav-link" href="<?php echo site_url('dashboard_cafe/laporan_bulanan') ?>">
                                <i class="fas fa-chart-bar me-2"></i>Laporan
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="sb-sidenav-footer text-center">
                <small>&copy; 2026 Sraddha Coffee</small>
            </div>
        </nav>
    </div>

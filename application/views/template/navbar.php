<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand">
        <div class="container-fluid px-4">
            <a class="navbar-brand ps-2 fw-bold">
                <i class="fas fa-mug-hot me-2"></i>Sraddha Coffee
            </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
                <i class="fas fa-bars" style="color: #7C6A5B;"></i>
            </button>

            <form class="d-none d-md-inline-block ms-auto me-3">
                <div class="search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input class="form-control py-2" type="text" placeholder="Cari pesanan, menu..." />
                </div>
            </form>

            <ul class="navbar-nav">
                <li class="nav-item dropdown position-relative me-2">
                    <a class="nav-link" href="#" role="button">
                        <i class="fas fa-bell fs-6"></i>
                        <span class="notif-badge"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div style="width: 32px; height: 32px; border-radius: 10px; background-color: #9B673A; display: flex; align-items: center; justify-content: center; color: white; font-size: 14px; font-weight: 600;">
                            <?= strtoupper(substr($this->session->userdata('nama') ?? 'A', 0, 1)) ?>
                        </div>
                        <span class="d-none d-md-inline" style="color: #3E2A1E; font-weight: 500; font-size: 14px;">
                            <?= $this->session->userdata('nama') ?? 'Admin' ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" style="border-radius: 16px; border: 1px solid #E7D9C7; box-shadow: 0 8px 30px rgba(62,42,30,0.1);">
                        <li><a class="dropdown-item" href="<?php echo site_url('dashboard_cafe/logout') ?>"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

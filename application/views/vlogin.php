<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
    <style>

    </style>
</head>

<body>

    <div class="container d-flex align-items-center justify-content-center login-wrapper">
        <div class="col-md-4">

            <div class="text-center mb-4">
                <img src="<?= base_url('assets/assets/img/logo.png') ?>" class="logo mb-2">
                <h5 class="title">Login</h5>
                <small class="text-muted">Fokus, konsisten, dan selesaikan targetmu hari ini</small>
            </div>

            <div class="login-card">

                <form action="<?php echo site_url('dashboard_cafe/proses_login') ?>" method="post">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        <label for="username">Username</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>

                    <div class="d-grid mb-3">
                        <button class="btn btn-cozi">Login</button>
                    </div>

                    <div class="text-center">
                        <small class="text-muted footer-text">© 2026 Sraddha Coffe</small>
                    </div>

                </form>

            </div>

        </div>
    </div>

</body>

</html>
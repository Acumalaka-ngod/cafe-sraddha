<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Diterima</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/sukses.css') ?>">
</head>

<body>

    <div class="success-page">
        <div class="success-content">

            <img src="<?= base_url('assets/assets/icons/success.svg') ?>" class="success-icon" alt="Sukses">

            <h2 class="success-title">Pesanan Diterima</h2>

            <p class="success-desc">
                Pesanan mu sudah diterima dan akan segera dipersiapkan,
                silahkan menunggu dengan santuy ya...
            </p>

            <div class="order-number">
                No. Pesanan
                <strong><?= htmlspecialchars($no_pesanan) ?></strong>
            </div>

            <div class="success-buttons d-grid gap-3">
                <a href="<?= site_url('customers/DetailPesanan/' . htmlspecialchars($no_pesanan)) ?>" class="btn btn-order">
                    Lihat Pesanan
                </a>
                <a href="<?= site_url('customers/Menu') ?>" class="btn btn-again">
                    Pesan Lainnya
                </a>
            </div>

        </div>
    </div>

</body>

</html>
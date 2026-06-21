<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            background: #f5f5f5;
            font-family: "Poppins", sans-serif;
        }

        .detail-page {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 24px 16px;
        }

        .detail-card {
            width: 100%;
            max-width: 480px;
            background: #fff;
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        /* Header */
        .detail-header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px dashed #e0e0e0;
        }

        .detail-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: #2e7d32;
            margin-bottom: 4px;
        }

        .no-pesanan {
            font-size: 28px;
            font-weight: 700;
            color: #1b5e20;
            letter-spacing: 1px;
        }

        /* Badge status */
        .badge-status {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 8px;
        }

        .badge-diproses {
            background: #fff8e1;
            color: #f57f17;
        }

        .badge-selesai {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .badge-dibatalkan {
            background: #ffebee;
            color: #c62828;
        }

        .badge-pending {
            background: #e3f2fd;
            color: #1565c0;
        }

        .badge-lunas {
            background: #e8f5e9;
            color: #2e7d32;
        }

        /* Info row */
        .info-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 6px;
            color: #555;
        }

        .info-row span:last-child {
            font-weight: 600;
            color: #222;
        }

        /* Section title */
        .section-title {
            font-size: 13px;
            font-weight: 700;
            color: #2e7d32;
            text-transform: uppercase;
            letter-spacing: .5px;
            margin: 16px 0 10px;
        }

        /* Item pesanan */
        .item-row {
            background: #f9f9f9;
            border-radius: 12px;
            padding: 12px;
            margin-bottom: 8px;
        }

        .item-name {
            font-size: 14px;
            font-weight: 600;
            color: #222;
            margin-bottom: 2px;
        }

        .item-qty-harga {
            font-size: 12px;
            color: #777;
            margin-bottom: 4px;
        }

        .item-subtotal {
            font-size: 13px;
            font-weight: 700;
            color: #2e7d32;
            text-align: right;
        }

        .addon-row {
            font-size: 12px;
            color: #888;
            padding-left: 8px;
            border-left: 2px solid #c8e6c9;
            margin: 4px 0;
        }

        /* Total */
        .total-section {
            border-top: 1px dashed #e0e0e0;
            margin-top: 16px;
            padding-top: 12px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #555;
            margin-bottom: 6px;
        }

        .total-row.grand {
            font-size: 16px;
            font-weight: 700;
            color: #1b5e20;
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px solid #c8e6c9;
        }

        /* Tombol */
        .btn-again {
            display: block;
            width: 100%;
            background: #2e7d32;
            color: #fff;
            border-radius: 14px;
            padding: 14px;
            font-weight: 600;
            font-size: 15px;
            text-align: center;
            text-decoration: none;
            margin-top: 20px;
            border: none;
        }

        .btn-again:hover {
            background: #256628;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="detail-page">
        <div class="detail-card">

            <!-- Header -->
            <div class="detail-header">
                <h2>Detail Pesanan</h2>
                <div class="no-pesanan"><?= htmlspecialchars($transaksi->no_pesanan) ?></div>

                <?php
                $status_pesanan = $transaksi->status_pesanan;
                $badge_pesanan  = [
                    'diproses'   => 'badge-diproses',
                    'selesai'    => 'badge-selesai',
                    'dibatalkan' => 'badge-dibatalkan',
                ];
                $badge_bayar = [
                    'pending' => 'badge-pending',
                    'lunas'   => 'badge-lunas',
                ];
                ?>
                <div class="mt-2">
                    <span class="badge-status <?= $badge_pesanan[$transaksi->status_pesanan] ?? 'badge-pending' ?>">
                        <?= ucfirst(htmlspecialchars($transaksi->status_pesanan)) ?>
                    </span>
                    <span class="badge-status <?= $badge_bayar[$transaksi->status_pembayaran] ?? 'badge-pending' ?>">
                        <?= ucfirst(htmlspecialchars($transaksi->status_pembayaran)) ?>
                    </span>
                </div>
            </div>

            <!-- Info Pesanan -->
            <div class="info-row">
                <span>No. Meja</span>
                <span><?= htmlspecialchars($transaksi->id_meja) ?></span>
            </div>
            <div class="info-row">
                <span>Tanggal</span>
                <span><?= date('d M Y, H:i', strtotime($transaksi->tanggal)) ?></span>
            </div>
            <div class="info-row">
                <span>Metode Bayar</span>
                <span><?= ucfirst(htmlspecialchars($transaksi->metode_pembayaran)) ?></span>
            </div>
            <?php if (!empty($transaksi->catatan)): ?>
                <div class="info-row">
                    <span>Catatan</span>
                    <span><?= htmlspecialchars($transaksi->catatan) ?></span>
                </div>
            <?php endif; ?>

            <!-- Daftar Item -->
            <div class="section-title">Item Pesanan</div>

            <?php foreach ($detail as $item): ?>
                <div class="item-row">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="item-name"><?= htmlspecialchars($item->nama_menu) ?></div>
                            <div class="item-qty-harga">
                                <?= $item->jumlah ?>x &times;
                                Rp <?= number_format($item->harga, 0, ',', '.') ?>
                            </div>

                            <?php foreach ($item->addons as $addon): ?>
                                <div class="addon-row">
                                    + <?= htmlspecialchars($addon->nama_addon) ?>
                                    (<?= $addon->qty ?>x Rp <?= number_format($addon->harga_addon, 0, ',', '.') ?>)
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="item-subtotal">
                            Rp <?= number_format($item->subtotal, 0, ',', '.') ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Total -->
            <div class="total-section">
                <div class="total-row">
                    <span>Subtotal</span>
                    <span>Rp <?= number_format($transaksi->total_harga, 0, ',', '.') ?></span>
                </div>
                <div class="total-row">
                    <span>Service Fee</span>
                    <span>Rp <?= number_format($service_fee, 0, ',', '.') ?></span>
                </div>
                <div class="total-row grand">
                    <span>Total</span>
                    <span>Rp <?= number_format($transaksi->total_harga + $service_fee, 0, ',', '.') ?></span>
                </div>
            </div>

            <!-- Tombol -->
            <a href="<?= site_url('customers/menu') ?>" class="btn-again">
                Pesan Lainnya
            </a>

        </div>
    </div>
</body>

</html>
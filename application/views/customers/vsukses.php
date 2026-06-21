<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Berhasil</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }
        .card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
            text-align: center;
        }
        .icon {
            font-size: 64px;
            margin-bottom: 16px;
        }
        h1 {
            color: #2d3748;
            margin: 0 0 8px;
            font-size: 28px;
        }
        p {
            color: #718096;
            margin: 4px 0;
            font-size: 16px;
        }
        .detail {
            background: #f7fafc;
            border-radius: 12px;
            padding: 20px;
            margin: 24px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e2e8f0;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .label {
            color: #718096;
        }
        .value {
            color: #2d3748;
            font-weight: 600;
        }
        .btn {
            display: inline-block;
            background: #667eea;
            color: white;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            transition: background 0.2s;
        }
        .btn:hover {
            background: #5a67d8;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon">&#10003;</div>
        <h1>Pesanan Berhasil!</h1>
        <p>Terima kasih, pesananmu sedang diproses</p>

        <div class="detail">
            <div class="detail-row">
                <span class="label">No. Invoice</span>
                <span class="value"><?= $no_invoice ?></span>
            </div>
            <div class="detail-row">
                <span class="label">Meja</span>
                <span class="value">Meja <?= $no_meja ?></span>
            </div>
            <div class="detail-row">
                <span class="label">Total</span>
                <span class="value">Rp <?= number_format($total, 0, ',', '.') ?></span>
            </div>
        </div>

        <a href="<?= site_url('menu') ?>" class="btn">Pesan Lagi</a>
    </div>
</body>
</html>
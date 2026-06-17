<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - <?= $transaksi->no_invoce ?></title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            font-size: 20px;
            margin: 0;
            padding: 30px;
            width: 90mm;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100vh;
        }
        .header {
            text-align: center;
            border-bottom: 2px dashed #000;
            padding-bottom: 12px;
            margin-bottom: 12px;
        }
        .header h2 {
            margin: 0;
            font-size: 26px;
        }
        .header p {
            margin: 3px 0;
            font-size: 18px;
        }
        .info {
            margin-bottom: 12px;
            font-size: 19px;
        }
        .info table {
            width: 100%;
        }
        .info td {
            padding: 3px 0;
        }
        .items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }
        .items th {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 6px 0;
            text-align: left;
            font-size: 19px;
        }
        .items td {
            padding: 4px 0;
            font-size: 19px;
        }
        .items .text-right {
            text-align: right;
        }
        .items .text-center {
            text-align: center;
        }
        .total {
            border-top: 2px solid #000;
            padding-top: 6px;
            margin-top: 6px;
            text-align: right;
            font-size: 22px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 12px;
            border-top: 1px dashed #000;
            font-size: 18px;
        }
        @media print {
            body { margin: 0; padding: 15px; min-height: auto; justify-content: flex-start; }
        }
    </style>
</head>
<body onload="window.print(); window.onafterprint = function() { window.close(); }">
    <div class="header">
        <h2>CAFE SRADDHA</h2>
        <p>Jl. Pariwisata Raya No.12 </p>
        <p>@sraddha.coffee</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td>No Invoice</td>
                <td>: NV <?= $transaksi->no_invoce ?></td>
            </tr>
            <tr>
                <td>No Pesanan</td>
                <td>: SHD <?= $transaksi->no_pesanan ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>: <?= date('d/m/Y H:i', strtotime($transaksi->tanggal)) ?></td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td>: <?= $transaksi->nama_user ?></td>
            </tr>
            <tr>
                <td>Meja</td>
                <td>: <?= $transaksi->no_meja ?></td>
            </tr>
        </table>
    </div>

    <table class="items">
        <thead>
            <tr>
                <th>Menu</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Harga</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($detail as $d): ?>
            <tr>
                <td><?= $d->nama_menu ?></td>
                <td class="text-center"><?= $d->jumlah ?></td>
                <td class="text-right">Rp <?= number_format($d->harga, 0, ',', '.') ?></td>
                <td class="text-right">Rp <?= number_format($d->subtotal, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="total">
        Total: Rp <?= number_format($transaksi->total_harga, 0, ',', '.') ?>
    </div>

    <div style="margin-top: 10px; font-size: 17px;">
        <strong>Metode Pembayaran:</strong> <?= $transaksi->metode_pembayaran ?>
    </div>

    <div class="footer">
        <p>Terima kasih telah berkunjung!</p>
    </div>
</body>
</html>

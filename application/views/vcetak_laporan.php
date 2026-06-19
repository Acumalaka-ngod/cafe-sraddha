<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan - Sraddha Coffee</title>
    <style>
        body { font-family: 'Courier New', monospace; font-size: 14px; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 15px; }
        .header h2 { margin: 0; font-size: 22px; }
        .header p { margin: 3px 0; font-size: 14px; }
        .periode { text-align: center; font-size: 15px; margin-bottom: 15px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #000; padding: 6px 8px; text-align: left; font-size: 13px; }
        th { background-color: #eee; }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .total-row td { font-weight: bold; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; border-top: 1px dashed #000; padding-top: 10px; }
        @media print { body { padding: 10px; } }
    </style>
</head>
<body onload="window.print(); window.onafterprint = function() { window.close(); }">
    <div class="header">
        <h2>CAFE SRADDHA</h2>
        <p>Jl. Pariwisata Raya No.12</p>
        <p>@sraddha.coffee</p>
    </div>

    <div class="periode">
        Laporan Pendapatan Periode <?= date('d/m/Y', strtotime($tanggal_mulai)) ?> - <?= date('d/m/Y', strtotime($tanggal_selesai)) ?>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Invoice</th>
                <th>Tanggal</th>
                <th>Meja</th>
                <th>Kasir</th>
                <th>Metode Bayar</th>
                <th class="text-end">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($transaksi as $t): ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= $t->no_invoce ?></td>
                <td><?= date('d/m/Y H:i', strtotime($t->tanggal)) ?></td>
                <td><?= $t->no_meja ?></td>
                <td><?= $t->nama_user ?></td>
                <td><?= $t->metode_pembayaran ?></td>
                <td class="text-end">Rp <?= number_format($t->total_harga, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="6" class="text-end">TOTAL</td>
                <td class="text-end">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Terima kasih telah berkunjung!</p>
    </div>
</body>
</html>

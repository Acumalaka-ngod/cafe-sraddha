<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">
                            Total Menu: <?php echo $total_menu; ?>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link"
                                href="<?php echo site_url('dashboard_cafe/lihat_menu'); ?>">Lihat Menu</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">
                            Total User: <?php echo $total_user; ?>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link"
                                href="<?php echo site_url('dashboard_cafe/lihat_user'); ?>">Lihat User</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            Total Transaksi: <?php echo $total_transaksi; ?>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link"
                                href="<?php echo site_url('dashboard_cafe/lihat_transaksi'); ?>">Lihat Transaksi</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Total Pendapatan: Rp
                            <?php echo number_format($total_pendapatan, 0, ',', '.'); ?>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link"
                                href="<?php echo site_url('dashboard_cafe/lihat_transaksi'); ?>">Lihat Detail</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Pendapatan
                        </div>
                        <div class="card-body">
                            <canvas id="myAreaChart" width="100%" height="40"></canvas>
                            <script>
                                (function() {
                                    var script = document.createElement('script');
                                    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js';
                                    script.onload = function() {
                                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                                        Chart.defaults.global.defaultFontColor = '#292b2c';

                                        var canvas = document.getElementById("myAreaChart");
                                        var ctxArea = canvas.getContext('2d');
                                        var salesData = <?php echo json_encode($monthly_sales ?? []); ?>;
                                        var labels = [],
                                            areaData = [];
                                        var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                                        salesData.forEach(function(row) {
                                            labels.push(monthNames[row.month - 1] + (row.year ? " " + row.year : ""));
                                            areaData.push(row.sales || 0);
                                        });
                                        while (labels.length < 12) {
                                            labels.push("");
                                            areaData.push(0);
                                        }
                                        var allZeroArea = areaData.every(function(v) {
                                            return v == 0;
                                        });

                                        if (!allZeroArea) {
                                            new Chart(canvas, {
                                                type: 'line',
                                                data: {
                                                    labels: labels,
                                                    datasets: [{
                                                        label: "Penjualan",
                                                        data: areaData,
                                                        borderColor: "rgba(2,117,216,1)",
                                                        backgroundColor: "rgba(2,117,216,0.2)",
                                                        lineTension: 0.3
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        yAxes: [{
                                                            ticks: {
                                                                min: 0,
                                                                callback: function(v) {
                                                                    return 'Rp ' + v.toLocaleString();
                                                                }
                                                            }
                                                        }],
                                                        xAxes: [{
                                                            ticks: {
                                                                maxTicksLimit: 12
                                                            }
                                                        }]
                                                    },
                                                    legend: {
                                                        display: false
                                                    }
                                                }
                                            });
                                        } else {
                                            ctxArea.font = "16px Arial";
                                            ctxArea.fillStyle = "#6c757d";
                                            ctxArea.textAlign = "center";
                                            ctxArea.textBaseline = "middle";
                                            ctxArea.fillText("No data penjualan tersedia", canvas.width / 2, canvas.height / 2);
                                        }
                                    };
                                    document.head.appendChild(script);
                                })();
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Transaksi
                        </div>
                        <div class="card-body">
                            <canvas id="myBarChart" width="100%" height="40"></canvas>
                            <script>
                                (function() {
                                    var script = document.createElement('script');
                                    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js';
                                    script.onload = function() {
                                        var canvas = document.getElementById("myBarChart");
                                        var ctxBar = canvas.getContext('2d');
                                        var purchasesData = <?php echo json_encode($monthly_purchases ?? []); ?>;
                                        var labels = [],
                                            barData = [];
                                        var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                                        purchasesData.forEach(function(row) {
                                            labels.push(monthNames[row.month - 1] + (row.year ? " " + row.year : ""));
                                            barData.push(row.count || 0);
                                        });
                                        while (labels.length < 12) {
                                            labels.push("");
                                            barData.push(0);
                                        }
                                        var allZeroBar = barData.every(function(v) {
                                            return v == 0;
                                        });

                                        if (!allZeroBar) {
                                            new Chart(canvas, {
                                                type: 'bar',
                                                data: {
                                                    labels: labels,
                                                    datasets: [{
                                                        label: "Barang Keluar",
                                                        data: barData,
                                                        backgroundColor: "rgba(2,117,216,1)"
                                                    }]
                                                },
                                                options: {
                                                    scales: {
                                                        yAxes: [{
                                                            ticks: {
                                                                min: 0
                                                            }
                                                        }],
                                                        xAxes: [{
                                                            ticks: {
                                                                maxTicksLimit: 12
                                                            }
                                                        }]
                                                    },
                                                    legend: {
                                                        display: false
                                                    }
                                                }
                                            });
                                        } else {
                                            ctxBar.font = "16px Arial";
                                            ctxBar.fillStyle = "#6c757d";
                                            ctxBar.textAlign = "center";
                                            ctxBar.textBaseline = "middle";
                                            ctxBar.fillText("No data transaksi tersedia", canvas.width / 2, canvas.height / 2);
                                        }
                                    };
                                    document.head.appendChild(script);
                                })();
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Data Transaksi
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>No Transaksi</th>
<<<<<<< HEAD
                                <th>No Meja</th>
                                <th>Customer</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <!-- <tfoot>
                            <tr>
                                <th>No Transaksi</th>
                                <th>No Meja</th>
                                <th>Customer</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Aksi</th>

                            </tr>
                        </tfoot> -->

                        <tbody>
                            <?php foreach ($transaksi as $t) : ?>
                                <tr>
                                    <td><?php echo $t->id_transaksi; ?></td>
                                    <td><?php echo $t->no_meja; ?></td>
                                    <td><?php echo $t->pemesan; ?></td>
                                    <td><?php echo $t->tanggal; ?></td>
                                    <td><?php echo $t->status_pesanan; ?></td>
                                    <td>Rp <?php echo number_format($t->total_harga, 0, ',', '.'); ?></td>
                                    <td>
                                        <a href="<?php echo site_url('dashboard_cafe/detail_transaksi/' . $t->id_transaksi); ?>"
                                            class="btn btn-info btn-sm">Detail</a>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

=======
                                <th>Tanggal</th>
                                <th>Customer</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No Transaksi</th>
                                <th>Tanggal</th>
                                <th>Customer</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($transaksi as $tr): ?>
                                <tr>
                                    <td><?php echo $bk->no_transaksi; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($bk->tanggal)); ?></td>
                                    <td><?php echo $bk->nama_customer; ?></td>
                                    <td><?php echo $bk->nama_produk; ?></td>
                                    <td><?php echo $bk->jumlah_barang; ?></td>
                                    <td>Rp <?php echo number_format($bk->jumlah_barang * $bk->harga, 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
>>>>>>> 2e20cddf34c6fcf448714230eba0b44f83c5b897
                    </table>
                </div>
            </div>
        </div>
    </main>
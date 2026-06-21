<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-3 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('dashboard_cafe/tambah_meja') ?>"
                        class="btn btn-outline-primary btn-sm"> <i class="fas fa-plus"></i> Tambah Meja</a>
                </div>
                <div class="card-body">
                    <?php if ($message = $this->session->flashdata('message')): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <?= $message ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <?php if ($error = $this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?= $error ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Meja</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Batasan: meja hanya sampai max 20
                                $no = 1;
                                foreach ($meja as $mj) {
                                    if ((int) $mj->no_meja > 20) {
                                        continue;
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td>Meja <?php echo $mj->no_meja ?></td>
                                        <td>
                                            <a href="<?php echo site_url('dashboard_cafe/edit_meja/' . $mj->id_meja) ?>"
                                                class="btn btn-warning btn-sm" title="Edit Meja"><i
                                                    class="fas fa-pencil"></i> </a>
                                            <a href="<?php echo site_url('dashboard_cafe/hapus_meja/' . $mj->id_meja) ?>"
                                                class="btn btn-danger btn-sm" title="Hapus Meja"
                                                onclick="return confirm('Yakin ingin menghapus meja ini?')"><i
                                                    class="fas fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $('#dataTable').DataTable({
            responsive: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/Indonesian.json"
            },
            columnDefs: [{
                orderable: false,
                targets: -1
            }]
        });
    </script>
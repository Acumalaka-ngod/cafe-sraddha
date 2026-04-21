<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <?php if(isset($message) && $message): ?>
            <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php endif; ?>
            <div class="card mx-3 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('dashboard_cafe/tambah_menu') ?>"
                        class="btn btn-outline-primary btn-sm"> <i class="fas fa-plus"></i> Tambah Menu</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>

                                    <th>No</th>
                                    <th>Nama Menu</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($menu as $m) {
                                    ?>
                                    <tr>

                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $m->nama_menu ?></td>
                                        <td><?php echo $m->kategori ?></td>
                                        <td><?php echo $m->stok ?></td>
                                        <td><?php echo $m->deskripsi ?></td>
                                        <td><?php echo "Rp. " . number_format($m->harga, 0, ',', '.'); ?></td>
                                        <td><img src="<?php echo base_url('/assets/uploads/' . $m->gambar) ?>" width="100"
                                                height="100"></td>
                                        <td>
                                            <a href="<?php echo site_url('dashboard_cafe/edit_menu/' . $m->id_menu) ?>"
                                                class="btn btn-warning btn-sm" title="Edit Menu"><i
                                                    class="fas fa-pencil"></i> </a>
                                            <a href="<?php echo site_url('dashboard_cafe/hapus_menu/' . $m->id_menu) ?>"
                                                class="btn btn-danger btn-sm" title="Hapus Menu" onclick="return confirm('Yakin ingin menghapus menu ini?')"><i
                                                    class="fas fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
    </main>
    <!-- Pustaka DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <!-- Script JS DataTable -->
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/Indonesian.json"
                }
            });
        });
    </script>

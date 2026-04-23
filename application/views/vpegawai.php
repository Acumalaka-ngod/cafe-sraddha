<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-3 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('dashboard_cafe/tambah_pegawai') ?>"
                        class="btn btn-outline-primary btn-sm"> <i class="fas fa-plus"></i> Tambah Pegawai</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($pegawai as $pg) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $pg->nama ?></td>
                                        <td><?php echo $pg->jabatan ?></td>
                                        <td>
                                            <a href="<?php echo site_url('dashboard_cafe/edit_pegawai/' . $pg->id_pegawai) ?>"
                                                class="btn btn-warning btn-sm" title="Edit Pegawai"><i
                                                    class="fas fa-pencil"></i> </a>
                                            <a href="<?php echo site_url('dashboard_cafe/hapus_pegawai/' . $pg->id_pegawai) ?>"
                                                class="btn btn-danger btn-sm" title="Hapus Pegawai"
                                                onclick="return confirm('Yakin ingin menghapus pegawai ini?')"><i
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
        $(document).ready(function () {
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.4/i18n/Indonesian.json"
                }
            });
        });
    </script>


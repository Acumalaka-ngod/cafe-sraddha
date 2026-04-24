<div class="container">
    <div class="card-header">
        <a href="<?php echo site_url('dashboard/tambah_produk'); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Produk Baru
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($produk): foreach($produk as $u): ?>
                    <tr>
                        <td><?php echo $u->id ?? 'N/A'; ?></td>
                        <td><?php echo htmlspecialchars($u->nama_produk); ?></td>
                        <td><?php echo htmlspecialchars($u->deskripsi); ?></td>
                        <td>Rp <?php echo number_format($u->harga, 0, ',', '.'); ?></td>
                        <td>
                            <?php if(isset($u->nama_file) && $u->nama_file): ?>
                                <img src="<?php echo base_url('uploads/' . $u->nama_file); ?>" alt="Produk" width="100" height="100" class="img-thumbnail">
                            <?php else: ?>
                                <span class="text-muted">No image</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo site_url('dashboard/edit_produk/' . ($u->id ?? '')); ?>" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?php echo site_url('dashboard/hapus_produk/' . ($u->id ?? '')); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada produk</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


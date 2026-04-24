<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">
            <a href="<?php echo site_url('dashboard/lihat_produk'); ?>">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="<?php echo site_url('dashboard/simpan_produk'); ?>" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="text" id="nama_produk" name="nm_produk" class="form-control"
                            placeholder="Nama Produk" required="required">
                        <label for="nama_produk">Nama Produk</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <textarea name="Deskripsi" id="Deskripsi" class="form-control" placeholder="Deskripsi" rows="5"
                            required="required"></textarea>
                        <label for="Deskripsi">Deskripsi</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="number" id="harga" name="harga" class="form-control" placeholder="Harga (Rp)"
                            required="required">
                        <label for="harga">Harga</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="file" id="foto" name="foto" class="form-control" accept="image/*"
                            required="required">
                        <label for="foto">Foto Produk</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Simpan Produk</button>
            </form>
        </div>
    </div>
</div>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-4 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('dashboard_cafe/lihat_menu') ?>"
                        class="btn btn-outline-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url('dashboard_cafe/simpan_menu') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">


                        <div class="form-group">
                            <label for="nama_menu">Nama Menu</label>
                            <input type="text" class="form-control" id="nama_menu" name="nama_menu" required>
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" required>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="text" class="form-control" id="stok" name="stok" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga" required>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar Menu</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" onchange="previewImage(event)">
                            </br>
                            <img id="preview" class="mt-2" style="max-width: 200px; max-height: 200px; display: none;">
                        </div>
                        <div class="form-group"></br>
                            <button type="submit" class="btn btn-primary">Tambah</button>
                            <button type="reset" class="btn btn-secondary">Batal</button>
                        </div>
                    </form>
                    <script>
                    function previewImage(event) {
                        const reader = new FileReader();
                        reader.onload = function() {
                            const preview = document.getElementById('preview');
                            preview.src = reader.result;
                            preview.style.display = 'block';
                        }
                        reader.readAsDataURL(event.target.files[0]);
                    }
                    </script>
                </div>
            </div>
        </div>
    </main>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-4 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('dashboard_cafe/lihat_menu') ?>"
                        class="btn btn-outline-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form action="<?php echo site_url('dashboard_cafe/simpan_menu') ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="nama_menu">Nama Menu</label>
                                <input type="text" class="form-control" id="nama_menu" name="nama_menu" required>
                            </div>
                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-control" name="id_kategori" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php foreach ($kategori_list as $k): ?>
                                        <option value="<?= $k->id_kategori ?>"><?= $k->nama_kategori ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok" min="0" required oninput="validateStok(this)">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga" min="0" required oninput="validateHarga(this)">
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar Menu</label>
                                <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*"
                                    onchange="previewImage(event)">
                                </br>
                                <img id="preview" class="mt-2"
                                    style="max-width: 200px; max-height: 200px; display: none;">
                            </div>
                            <!-- <div class="form-group mt-3">
                                <label>Addons</label>
                                <div id="addonCheckboxes" class="border p-3 rounded" style="min-height: 50px;">
                                    <small class="text-muted">Pilih kategori terlebih dahulu</small>
                                </div>
                            </div> -->
                            <div class="form-group"></br>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                                <button type="reset" class="btn btn-secondary">Batal</button>
                            </div>
                    </form>
                    <script>
                        const allAddons = <?= json_encode($addons_list) ?>;
                        const kategoriGrup = <?= json_encode($kategori_grup) ?>;

                        document.querySelector('[name="id_kategori"]').addEventListener('change', function() {
                            const kid = parseInt(this.value);
                            const grup = kategoriGrup[kid] || '';
                            const container = document.getElementById('addonCheckboxes');
                            const filtered = allAddons.filter(a => a.grup === grup);
                            if (!filtered.length) {
                                container.innerHTML = '<small class="text-muted">Tidak ada addon untuk kategori ini</small>';
                                return;
                            }
                            container.innerHTML = filtered.map(a =>
                                `<label class="form-check-label me-3" style="cursor:pointer;font-weight:normal;">
                                    <input type="checkbox" name="addons[]" value="${a.id_addon}" class="form-check-input">
                                    ${a.nama_addon} (+Rp${Number(a.harga_addon).toLocaleString('id-ID')})
                                </label>`
                            ).join('');
                        });

                        function previewImage(event) {
                            const reader = new FileReader();
                            reader.onload = function () {
                                const preview = document.getElementById('preview');
                                preview.src = reader.result;
                                preview.style.display = 'block';
                            }
                            reader.readAsDataURL(event.target.files[0]);
                        }
                        function validateStok(input) {
                            if (parseInt(input.value) < 0) {
                                alert('Stok tidak boleh negatif!');
                                input.value = '';
                            }
                        }
                        function validateHarga(input) {
                            if (parseInt(input.value) < 0) {
                                alert('Harga tidak boleh negatif!');
                                input.value = '';
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </main>

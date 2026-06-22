<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="card mx-4 mt-3">
                <div class="card-header">
                    <a href="<?php echo site_url('dashboard_cafe/lihat_menu') ?>"
                        class="btn btn-outline-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($menu)): ?>
                        <?php foreach ($menu as $m): ?>
                            <form action="<?php echo site_url('dashboard_cafe/update_menu') ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_menu" value="<?php echo $m->id_menu ?>">
                                <div class="form-group">
                                    <label>Nama Menu</label>
                                    <input type="text" class="form-control" name="nama_menu"
                                        value="<?php echo $m->nama_menu ?>">
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="id_kategori" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php foreach ($kategori_list as $k): ?>
                                            <option value="<?= $k->id_kategori ?>" <?= ($m->id_kategori == $k->id_kategori) ? 'selected' : '' ?>>
                                                <?= $k->nama_kategori ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="number" class="form-control" name="stok" min="0" value="<?php echo $m->stok ?>" oninput="validateStok(this)">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi"><?php echo $m->deskripsi ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" class="form-control" name="harga" min="0" value="<?php echo $m->harga ?>" oninput="validateHarga(this)">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Gambar saat ini</label><br>
                                    <img src="<?php echo base_url('assets/uploads/' . $m->gambar); ?>" width="100" id="current-img">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Upload Gambar Baru (opsional)</label>
                                    <input type="file" name="gambar" id="gambar-edit" class="form-control" accept="image/*" onchange="previewNewImage(event)">
                                    <img id="preview-edit" class="mt-2" style="max-width: 200px; max-height: 200px; display: none;">
                                </div>

                                <!-- <div class="form-group mb-3">
                                    <label>Addons</label>
                                    <div id="addonCheckboxes" class="border p-3 rounded" style="min-height: 50px;">
                                        <small class="text-muted">Pilih kategori terlebih dahulu</small>
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning btn-sm me-2">Update</button>
                                    <button type="reset" class="btn btn-secondary btn-sm">Batal</button>
                                </div>
                            </form>
                        <?php endforeach; ?>
                        <script>
                        const allAddons = <?= json_encode($addons_list) ?>;
                        const kategoriGrup = <?= json_encode($kategori_grup) ?>;
                        const selectedAddons = <?= json_encode($menu_addons_selected) ?>;

                        function renderAddonCheckboxes() {
                            const kid = parseInt(document.querySelector('[name="id_kategori"]').value);
                            const grup = kategoriGrup[kid] || '';
                            const container = document.getElementById('addonCheckboxes');
                            const filtered = allAddons.filter(a => a.grup === grup);
                            if (!filtered.length) {
                                container.innerHTML = '<small class="text-muted">Tidak ada addon untuk kategori ini</small>';
                                return;
                            }
                            container.innerHTML = filtered.map(a =>
                                `<label class="form-check-label me-3" style="cursor:pointer;font-weight:normal;">
                                    <input type="checkbox" name="addons[]" value="${a.id_addon}" class="form-check-input" ${selectedAddons.includes(a.id_addon) ? 'checked' : ''}>
                                    ${a.nama_addon} (+Rp${Number(a.harga_addon).toLocaleString('id-ID')})
                                </label>`
                            ).join('');
                        }

                        document.querySelector('[name="id_kategori"]').addEventListener('change', function() {
                            // Clear selections when kategori changes — keep old selections for items that still match
                            renderAddonCheckboxes();
                        });

                        renderAddonCheckboxes();

                        function previewNewImage(event) {
                            const reader = new FileReader();
                            reader.onload = function() {
                                const preview = document.getElementById('preview-edit');
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
                    <?php else: ?>
                        <div class="alert alert-warning">Menu tidak ditemukan.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

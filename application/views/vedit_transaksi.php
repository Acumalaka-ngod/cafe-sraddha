<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="card mx-4 mt-3">
                <div class="card-header">
                    <a href="<?= site_url('dashboard_cafe/lihat_transaksi') ?>" class="btn btn-outline-primary btn-sm">
                        ← Kembali
                    </a>
                </div>

                <div class="card-body">

                    <form id="formEdit" action="<?= site_url('dashboard_cafe/update_transaksi') ?>" method="post">
                        <input type="hidden" name="id_transaksi" value="<?= $tr->id_transaksi ?>">

                        <div class="form-group mb-3">
                            <label>Status Pesanan</label>
                            <select name="status_pesanan" class="form-control" required>
                                <option value="Pending" <?= $tr->status_pesanan == 'Pending' ? 'selected' : '' ?>>Pending
                                </option>
                                <option value="Diproses" <?= $tr->status_pesanan == 'Diproses' ? 'selected' : '' ?>>
                                    Diproses</option>
                                <option value="Selesai" <?= $tr->status_pesanan == 'Selesai' ? 'selected' : '' ?>>Selesai
                                </option>
                            </select>
                        </div>


                    </form>
                    <div class="form-group mt-3"></br>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-secondary">Batal</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </main>
    

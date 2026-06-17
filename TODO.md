# TODO - Perbaikan Hapus Menu (cafe-sraddha)

- [ ] Analisis sumber error: hapus menu memanggil `Menu_model::hapus_data()`
- [x] Edit `application/models/Menu_model.php`:
  - [x] Hapus query salah `delete('transaksi', ['id_menu' => $id_menu])`
  - [x] Ganti dengan penghapusan yang benar via `detail_transaksi` berdasarkan `id_menu`
  - [x] Pastikan `detail_pesanan` (jika relevan) juga dibersihkan
- [x] Cari apakah ada query serupa lain yang menghapus transaksi berdasarkan `id_menu`
- [ ] Testing manual: hapus menu dari halaman `vmenu.php`
- [ ] Pastikan tidak ada query lain yang mengakses tabel `detail_pesanan` (jika memang tabelnya tidak ada di DB target)


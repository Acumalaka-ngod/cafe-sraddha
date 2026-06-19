<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	function lihat_data()
	{
		$this->db->select('menu.*, kategori.nama_kategori');
		$this->db->from('menu');
		$this->db->join(
			'kategori',
			'kategori.id_kategori = menu.id_kategori',
			'left'
		);

		return $this->db->get();
	}

	function simpan_addons_menu($id_menu, $addons)
	{
		foreach ($addons as $id_addon) {

			$this->db->insert('menu_addons', [

				'id_menu'  => $id_menu,

				'id_addon' => $id_addon

			]);
		}
	}
	function simpan_data($data)
	{
		$this->db->insert('menu', $data);
		return $this->db->insert_id();
	}

	function hapus_data($id_menu)
	{
		// Delete related records first.
		// Relasi menu -> transaksi terjadi lewat detail_transaksi (bukan kolom id_menu di tabel transaksi).
		$this->db->delete('detail_transaksi', ['id_menu' => $id_menu]);
		// detail_pesanan tidak selalu ada di skema DB target, jadi buat aman.
		// Jika tabel tidak ada, operasi ini akan tetap gagal dengan error DB.
		// Untuk menghindari error, kita hanya jalankan penghapusan ketika tabel ada.
		$tables = $this->db->query("SHOW TABLES LIKE 'detail_pesanan'")->num_rows();
		if ($tables > 0) {
			$this->db->delete('detail_pesanan', ['id_menu' => $id_menu]);
		}

		// Get image to delete
		$menu = $this->db->get_where('menu', ['id_menu' => $id_menu])->row();
		if ($menu && $menu->gambar && file_exists('./assets/uploads/' . $menu->gambar)) {
			unlink('./assets/uploads/' . $menu->gambar);
		}

		// Delete menu
		return $this->db->delete('menu', ['id_menu' => $id_menu]);
	}

	function edit_data($where, $table)
	{
		return $this->db->get_where($table, $where);
	}
	function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	function get_stok($id_menu)
	{
		$this->db->select('stok');
		$this->db->where('id_menu', $id_menu);
		$query = $this->db->get('menu');
		return $query->row() ? (int)$query->row()->stok : 0;
	}

	function kurangi_stok($id_menu, $jumlah)
	{
		$stok = $this->get_stok($id_menu);
		if ($stok < $jumlah) {
			return false;
		}
		$this->db->set('stok', 'stok - ' . $jumlah, FALSE);
		$this->db->where('id_menu', $id_menu);
		return $this->db->update('menu');
	}

	function tambah_stok($id_menu, $jumlah)
	{
		$this->db->set('stok', 'stok + ' . $jumlah, FALSE);
		$this->db->where('id_menu', $id_menu);
		return $this->db->update('menu');
	}
}

<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	function lihat_data()
	{
		$this->db->select("menu.*, kategori.nama_kategori as kategori,
			(SELECT GROUP_CONCAT(a.nama_addon SEPARATOR ', ')
			 FROM menu_addons ma
			 JOIN addons a ON ma.id_addon = a.id_addon
			 WHERE ma.id_menu = menu.id_menu) as addons_list");
		$this->db->from('menu');
		$this->db->join('kategori', 'menu.id_kategori = kategori.id_kategori', 'left');
		return $this->db->get();
	}
	function simpan_data($data)
	{
		$ins=$this->db->insert('menu',$data);
		return $ins;
	}

	function hapus_data($id_menu)
	{
		// Delete related records first (FK chain: menu → menu_addons, detail_transaksi → detail_transaksi_addons)
		$this->db->delete('menu_addons', ['id_menu' => $id_menu]);

		$detail_rows = $this->db->get_where('detail_transaksi', ['id_menu' => $id_menu])->result();
		$detail_ids = array_map(function($d) { return $d->id_detail; }, $detail_rows);
		if (!empty($detail_ids)) {
			$this->db->where_in('id_detail', $detail_ids);
			$this->db->delete('detail_transaksi_addons');
		}
		$this->db->delete('detail_transaksi', ['id_menu' => $id_menu]);
		
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
	function update_data ($where,$data, $table)
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
?>


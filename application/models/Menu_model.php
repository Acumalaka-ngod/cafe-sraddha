<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	function lihat_data()
	{
		return $this->db->get('menu'); 
	}
	function simpan_data($data)
	{
		$ins=$this->db->insert('menu',$data);
		return $ins;
	}

	function hapus_data($id_menu)
	{
		// Delete related records first
		$this->db->delete('transaksi', ['id_menu' => $id_menu]);
		$this->db->delete('detail_pesanan', ['id_menu' => $id_menu]);
		
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


<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_model extends CI_Model
{
	function lihat_data()
	{
		$this->db->select('p.*, m.nama_menu, mj.no_meja');
		$this->db->from('pesanan p');
$this->db->join('menu m', 'p.menu = m.id_menu', 'left');
		$this->db->join('meja mj', 'p.id_meja = mj.id_meja', 'left');
		return $this->db->get();
	}
	
	function simpan_data($data)
	{
		$ins = $this->db->insert('pesanan', $data);
		return $ins;
	}

	function hapus_data($id_pesanan)
	{
		$this->db->where('id_pesanan', $id_pesanan);
		$this->db->delete('pesanan');
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
}

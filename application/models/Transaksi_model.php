<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
	function lihat_data()
	{
$this->db->select('t.*, u.nama as nama_user, m.nama_menu');
		$this->db->from('transaksi t');
$this->db->join('user u', 't.id_pegawai = u.id_user', 'left');
		$this->db->join('menu m', 't.menu_dipesan = m.id_menu', 'left');
		return $this->db->get();
	}
	function simpan_data($data)
	{
		$ins=$this->db->insert('transaksi',$data);
		return $ins;
	}

	function hapus_data($id_transaksi)
	{
		$this->db->where('id_transaksi',$id_transaksi);
		$this->db->delete('transaksi');
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
}
?>


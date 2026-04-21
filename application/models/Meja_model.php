<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Meja_model extends CI_Model
{
	function lihat_data()
	{
		return $this->db->get('meja'); 
	}
	function simpan_data($data)
	{
		$ins=$this->db->insert('meja',$data);
		return $ins;
	}

	function hapus_data($id_meja)
	{
		$this->db->where('id_meja',$id_meja);
		$this->db->delete('meja');
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


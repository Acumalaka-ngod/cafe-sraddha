<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
	function lihat_data()
	{
		return $this->db->get('user'); 
	}
	function simpan_data($data)
	{
		$ins=$this->db->insert('user',$data);
		return $ins;
	}

	function hapus_data($id_user)
	{
		$this->db->where('id_user',$id_user);
		$this->db->delete('user');
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

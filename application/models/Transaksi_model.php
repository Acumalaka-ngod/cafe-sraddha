	<?php
<<<<<<< HEAD
	defined('BASEPATH') or exit('No direct script access allowed');

	class Transaksi_model extends CI_Model
	{
		function lihat_data()
		{
			$this->db->select('
        					t.*,
        					mj.no_meja,
        					u.nama as nama_user,
        					GROUP_CONCAT(m.nama_menu SEPARATOR ", ") as menu_list
    ');
			$this->db->from('transaksi t');
			$this->db->join('meja mj', 't.id_meja = mj.id_meja', 'left');
			$this->db->join('user u', 't.id_user = u.id_user', 'left');
			$this->db->join('detail_transaksi dt', 't.id_transaksi = dt.id_transaksi', 'left');
			$this->db->join('menu m', 'dt.id_menu = m.id_menu', 'left');
			$this->db->group_by('t.id_transaksi');

			return $this->db->get();
		}
		function simpan_data($data)
		{
			$ins = $this->db->insert('transaksi', $data);
			return $ins;
		}

		function hapus_data($id_transaksi)
		{
			$this->db->where('id_transaksi', $id_transaksi);
			$this->db->delete('transaksi');
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
=======
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
	function lihat_data()
	{
$this->db->select('t.*, m.nama_menu as nama_menu, t.id_transaksi as id_pesanan');
		$this->db->from('transaksi t');
		$this->db->join('menu m', 't.menu_dipesan = m.id_menu', 'left');
		return $this->db->get();	
	}
	function simpan_data($data)
	{
		$ins = $this->db->insert('transaksi', $data);
		return $ins;
	}

	function hapus_data($id_transaksi)
	{
		$this->db->where('id_transaksi', $id_transaksi);
		$this->db->delete('transaksi');
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
>>>>>>> 2e20cddf34c6fcf448714230eba0b44f83c5b897

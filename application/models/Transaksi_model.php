	<?php
	defined('BASEPATH') or exit('No direct script access allowed');

	class Transaksi_model extends CI_Model
	{
		function lihat_data()
		{
			$this->db->select('
        					t.*,
        					mj.no_meja,
        					u.nama as nama_user,
        					GROUP_CONCAT(m.nama_menu SEPARATOR ", ") as menu_list,
        					MAX(CASE WHEN da.id_detail IS NOT NULL THEN 1 ELSE 0 END) as has_addons
    ');
			$this->db->from('transaksi t');
			$this->db->join('meja mj', 't.id_meja = mj.id_meja', 'left');
			$this->db->join('user u', 't.id_user = u.id_user', 'left');
			$this->db->join('detail_transaksi dt', 't.id_transaksi = dt.id_transaksi', 'left');
			$this->db->join('detail_transaksi_addons da', 'dt.id_detail = da.id_detail', 'left');
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

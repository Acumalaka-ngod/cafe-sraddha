<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_pesanan_model extends CI_Model
{
    function lihat_data()
    {
        $this->db->select('dp.*, m.nama_menu as menu_dipesan, mj.no_meja, p.*');  // p.* if need from pesanan
        $this->db->from('detail_pesanan dp');
        $this->db->join('menu m', 'dp.id_menu = m.id_menu', 'left');
// $this->db->join('meja mj', 'dp.id_meja = mj.id_meja', 'left');
        $this->db->join('pesanan p', 'dp.id_pesanan = p.id_pesanan', 'left');
        return $this->db->get();
    }
    
    function simpan_data($data)
    {
        // Auto-fill menu_dipesan and total_pembayaran? Handled in controller
        return $this->db->insert('detail_pesanan', $data);
    }

    function hapus_data($id_detail)
    {
$this->db->where('id_detail_pesanan', $id_detail);
        $this->db->delete('detail_pesanan');
    }

    function edit_data($where, $table = 'detail_pesanan')
    {
        return $this->db->get_where($table, $where);
    }

    function update_data($where, $data, $table = 'detail_pesanan')
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
?>


<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Addons_model extends CI_Model
{
    function lihat_data()
    {
        $this->db->select('addons.*');
        $this->db->from('addons');
        return $this->db->get();
    }

    function simpan_data($data)
    {
        return $this->db->insert('addons', $data);
    }

    function hapus_data($id)
    {
        $this->db->delete('detail_transaksi_addons', ['id_addon' => $id]);
        $this->db->delete('menu_addons', ['id_addon' => $id]);
        $this->db->delete('addons', ['id_addon' => $id]);
    }

    function edit_data($where)
    {
        $this->db->where($where);
        return $this->db->get('addons');
    }

    function update_data($where, $data)
    {
        $this->db->where($where);
        $this->db->update('addons', $data);
    }

    function get_all()
    {
        return $this->db->get('addons')->result();
    }

    function get_by_kategori($id_kategori)
    {
        return $this->db->get_where('addons', ['id_kategori' => $id_kategori])->result();
    }

    function get_by_grup($grup)
    {
        return $this->db->get_where('addons', ['grup' => $grup])->result();
    }
}

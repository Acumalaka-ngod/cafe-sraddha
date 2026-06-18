<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Addons_model extends CI_Model
{
    function lihat_data()
    {
        return $this->db->get('addons');
    }

    function simpan_data($data)
    {
        return $this->db->insert('addons', $data);
    }

    function hapus_data($id)
    {
        $this->db->delete('addons', ['id_addon' => $id]);
    }

    function edit_data($where)
    {
        return $this->db->get_where('addons', $where);
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
}

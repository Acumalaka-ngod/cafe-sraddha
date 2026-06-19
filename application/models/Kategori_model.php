<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{

    function get_all()
    {
        return $this->db->get('kategori')->result();
    }
    function simpan_data($data)
    {
        return $this->db->insert('kategori', $data);
    }

    function hapus_data($id)
    {
        $this->db->delete('kategori', ['id_kategori' => $id]);
    }

    function edit_data($where)
    {
        return $this->db->get_where('kategori', $where);
    }

    function update_data($where, $data)
    {
        $this->db->where($where);
        $this->db->update('kategori', $data);
    }
}

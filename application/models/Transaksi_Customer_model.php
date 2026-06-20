<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_Customer_model extends CI_Model
{

    public function simpan_transaksi($data)
    {
        $this->db->insert('transaksi', $data);

        return $this->db->insert_id();
    }

    public function simpan_detail($data)
    {
        $this->db->insert('detail_transaksi', $data);

        return $this->db->insert_id();
    }

    public function simpan_detail_addon($data)
    {
        return $this->db->insert('detail_transaksi_addons', $data);
    }

    public function generate_no_pesanan()
    {
        $this->db->select('no_pesanan');
        $this->db->order_by('id_transaksi', 'DESC');
        $this->db->limit(1);

        $row = $this->db->get('transaksi')->row();

        if (!$row) {
            return '00001';
        }

        return str_pad(((int)$row->no_pesanan) + 1, 5, '0', STR_PAD_LEFT);
    }
}

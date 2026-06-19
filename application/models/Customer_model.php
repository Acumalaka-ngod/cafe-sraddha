<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer_model extends CI_Model
{


    public function get_menu()
    {
        $this->db->select('
        menu.*,
        kategori.nama_kategori
    ');

        $this->db->from('menu');
        $this->db->join(
            'kategori',
            'kategori.id_kategori = menu.id_kategori',
            'left'
        );

        $this->db->order_by('kategori.nama_kategori', 'ASC');
        $this->db->order_by('menu.nama_menu', 'ASC');

        return $this->db->get()->result();
    }
    public function menu_andalan()
    {
        $this->db->select('menu.*, SUM(detail_transaksi.jumlah) as total_terjual');
        $this->db->from('menu');
        $this->db->join('detail_transaksi', 'detail_transaksi.id_menu = menu.id_menu');
        $this->db->group_by('menu.id_menu');
        $this->db->order_by('total_terjual', 'DESC');
        $this->db->limit(5);

        return $this->db->get();
    }

    public function get_jam_hari_ini()
    {
        $hariInggris = date('l');

        $hariIndonesia = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            'Sunday'    => 'Minggu'
        ];

        $hari = $hariIndonesia[$hariInggris];

        return $this->db
            ->where('hari', $hari)
            ->get('jam_operasional')
            ->row();
    }

    public function get_addons_by_menu($id_menu)
    {
        return $this->db
            ->select('a.*')
            ->from('menu_addons ma')
            ->join('addons a', 'a.id_addon = ma.id_addon')
            ->where('ma.id_menu', (int)$id_menu)
            ->get()
            ->result();
    }
}

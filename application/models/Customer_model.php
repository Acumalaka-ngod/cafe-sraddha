<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {


    public function get_menu(){
        return $this->db->get('menu');
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
}
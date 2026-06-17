<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');

        $method = $this->router->fetch_method();

        if (
            !$this->session->userdata('id_meja')
            && $method != 'set_meja'
        ) {
            show_error(
                'Silakan scan QR meja terlebih dahulu.',
                403,
                'Akses Ditolak'
            );
        }
    }

    public function set_meja($id_meja)
    {
        $meja = $this->db
            ->where('id_meja', $id_meja)
            ->get('meja')
            ->row();

        if (!$meja) {
            show_404();
        }

        $this->session->set_userdata([
            'id_meja' => $meja->id_meja,
            'no_meja' => $meja->no_meja
        ]);

        redirect('menu');
    }

    public function index()
    {
        $data['menu'] = $this->Customer_model->get_menu()->result();
        $data['menu_andalan'] = $this->Customer_model->menu_andalan()->result();

        $this->load->view('customers/vmenu', $data);
    }
}


<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->model('Kategori_model');

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
        $data['menu'] = $this->Customer_model->get_menu();
        $data['kategori'] = $this->Kategori_model->get_all();
        $data['jam_operasional'] = $this->Customer_model->get_jam_hari_ini();
        $data['menu_andalan'] = $this->Customer_model->menu_andalan()->result();
        
        $this->load->view('customers/vmenu', $data);
    }

    public function tambah_cart()
    {
        $id_menu = $this->input->post('id_menu');

        $menu = $this->db
            ->where('id_menu', $id_menu)
            ->get('menu')
            ->row();

        if (!$menu) {
            echo json_encode([
                'status' => false
            ]);
            return;
        }

        $cart = $this->session->userdata('cart') ?? [];

        if (isset($cart[$id_menu])) {

            $cart[$id_menu]['qty']++;
        } else {

            $cart[$id_menu] = [
                'id_menu' => $menu->id_menu,
                'nama'    => $menu->nama_menu,
                'harga'   => $menu->harga,
                'qty'     => 1
            ];
        }

        $this->session->set_userdata('cart', $cart);

        $total_qty = 0;
        $total_harga = 0;

        foreach ($cart as $item) {

            $total_qty += $item['qty'];

            $total_harga +=
                ($item['harga'] * $item['qty']);
        }

        echo json_encode([
            'status' => true,
            'total_qty' => $total_qty,
            'total_harga' => number_format(
                $total_harga,
                0,
                ',',
                '.'
            )
        ]);
    }

    // public function kosongkan_cart()
    // {
    //     $this->session->unset_userdata('cart');

    //     echo json_encode([
    //         'status' => true
    //     ]);
    // }


    function lihat_pembayaran()
    {
        $this->load->view('customers/vsukses');
    }
}


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
            && $method != 'clear_cart'
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
        $addons  = $this->input->post('addons') ?? [];

        $menu = $this->db
            ->where('id_menu', $id_menu)
            ->get('menu')
            ->row();

        if (!$menu) {
            echo json_encode(['status' => false]);
            return;
        }

        $selected_addons = [];
        foreach ($addons as $id_addon => $qty) {
            $qty = (int)$qty;
            if ($qty <= 0) continue;

            $addon = $this->db
                ->where('id_addon', $id_addon)
                ->get('addons')
                ->row();

            if ($addon) {
                $selected_addons[$id_addon] = [
                    'id_addon'    => $addon->id_addon,
                    'nama_addon'  => $addon->nama_addon,
                    'harga_addon' => (float)$addon->harga_addon,
                    'qty'         => $qty
                ];
            }
        }

        $cart     = $this->session->userdata('cart') ?? [];
        $cart_key = $id_menu . '_' . md5(json_encode($selected_addons));

        if (isset($cart[$cart_key])) {
            $cart[$cart_key]['qty'] += (int)$this->input->post('qty') ?: 1;
        } else {
            $cart[$cart_key] = [
                'id_menu' => $menu->id_menu,
                'nama'    => $menu->nama_menu,
                'harga'   => (float)$menu->harga,
                'qty'     => (int)$this->input->post('qty') ?: 1,
                'addons'  => $selected_addons // selalu array, bisa []
            ];
        }

        $this->session->set_userdata('cart', $cart);

        $total_qty   = 0;
        $total_harga = 0;

        foreach ($cart as $item) {
            $total_qty   += $item['qty'];
            $total_harga += $item['harga'] * $item['qty'];

            foreach (($item['addons'] ?? []) as $addon) {
                $total_harga += $addon['harga_addon'] * $addon['qty'] * $item['qty'];
            }
        }

        echo json_encode([
            'status'      => true,
            'total_qty'   => $total_qty,
            'total_harga' => number_format($total_harga, 0, ',', '.')
        ]);
    }


    // public function kosongkan_cart()
    // {
    //     $this->session->unset_userdata('cart');

    //     echo json_encode([
    //         'status' => true
    //     ]);
    // }

    public function get_cart()
    {
        $cart        = $this->session->userdata('cart') ?? [];
        $total_harga = 0;
        $total_qty   = 0;

        foreach ($cart as $item) {
            $total_qty   += $item['qty'];
            $total_harga += $item['harga'] * $item['qty'];

            foreach (($item['addons'] ?? []) as $addon) { // ← fix
                $total_harga += $addon['harga_addon'] * $addon['qty'] * $item['qty'];
            }
        }

        $service_fee = 1000;
        $total       = $total_harga + $service_fee;

        echo json_encode([
            'status'      => true,
            'cart'        => array_values($cart),
            'total_qty'   => $total_qty,
            'subtotal'    => $total_harga,
            'service_fee' => $service_fee,
            'total'       => $total,
            'id_meja'     => $this->session->userdata('id_meja'), // ← tambah ini
            'no_meja'     => $this->session->userdata('no_meja')  // ← dan ini
        ]);
    }

    public function update_cart()
    {
        $key    = $this->input->post('cart_key');
        $action = $this->input->post('action');

        $cart = $this->session->userdata('cart') ?? [];

        // cart_key dari JS pakai index (0,1,2), konversi ke key asli
        $keys   = array_keys($cart);
        $real_key = $keys[$key] ?? null;

        if (!$real_key || !isset($cart[$real_key])) {
            echo json_encode(['status' => false]);
            return;
        }

        if ($action === 'plus') {
            $cart[$real_key]['qty']++;
        } elseif ($action === 'minus') {
            $cart[$real_key]['qty']--;

            // Hapus item kalau qty sudah 0
            if ($cart[$real_key]['qty'] <= 0) {
                unset($cart[$real_key]);
            }
        }

        $this->session->set_userdata('cart', $cart);

        $total_qty   = 0;
        $total_harga = 0;

        foreach ($cart as $item) {
            $total_qty   += $item['qty'];
            $total_harga += $item['harga'] * $item['qty'];

            foreach (($item['addons'] ?? []) as $addon) {
                $total_harga += $addon['harga_addon'] * $addon['qty'] * $item['qty'];
            }
        }

        echo json_encode([
            'status'      => true,
            'total_qty'   => $total_qty,
            'total_harga' => number_format($total_harga, 0, ',', '.')
        ]);
    }

    public function get_addons()
    {
        // Pastikan request adalah AJAX POST
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $id_menu = $this->input->post('id_menu');

        if (!$id_menu) {
            echo json_encode([]);
            return;
        }

        $addons = $this->Customer_model->get_addons_by_menu($id_menu);

        header('Content-Type: application/json');
        echo json_encode($addons);
    }
}

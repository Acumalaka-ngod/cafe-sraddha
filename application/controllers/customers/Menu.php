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

    public function tambah_cart()
    {
        $id_menu = $this->input->post('id_menu') ?: $this->input->post('menu_id');

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

        $qty = (int)($this->input->post('qty') ?: 1);

        $cart = $this->session->userdata('cart') ?? [];

        if (isset($cart[$id_menu])) {
            $cart[$id_menu]['qty'] += $qty;
        } else {
            $cart[$id_menu] = [
                'id_menu' => $menu->id_menu,
                'nama'    => $menu->nama_menu,
                'harga'   => $menu->harga,
                'qty'     => $qty
            ];
        }

        // Process addons
        $addon_list = [];
        foreach ($this->input->post() as $key => $val) {
            if (strpos($key, 'addon_') === 0 && (int)$val > 0) {
                $addon_id = (int)str_replace('addon_', '', $key);
                $addon = $this->db->get_where('addons', ['id_addon' => $addon_id])->row();
                if ($addon) {
                    $addon_list[] = [
                        'id'    => $addon->id_addon,
                        'nama'  => $addon->nama_addon,
                        'harga' => (int)$addon->harga_addon,
                        'qty'   => (int)$val
                    ];
                }
            }
        }
        if (!empty($addon_list)) {
            $cart[$id_menu]['addons'] = $addon_list;
        }

        $this->session->set_userdata('cart', $cart);

        $total_qty = 0;
        $total_harga = 0;

        foreach ($cart as $item) {
            $total_qty += $item['qty'];
            $total_harga += ($item['harga'] * $item['qty']);
            if (!empty($item['addons'])) {
                foreach ($item['addons'] as $addon) {
                    $total_harga += ($addon['harga'] * $addon['qty']);
                }
            }
        }

        echo json_encode([
            'status' => true,
            'total_qty' => $total_qty,
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

    public function checkout()
    {
        $cart = $this->session->userdata('cart');
        if (!$cart || count($cart) == 0) {
            show_error('Cart kosong');
        }

        $id_meja = $this->session->userdata('id_meja');
        if (!$id_meja) {
            show_error('Silakan pilih meja terlebih dahulu');
        }

        $payment_method = $this->input->post('payment_method') ?: $this->input->post('metode_pembayaran');

        $metode_map = [
            'QRIS'    => 'QRIS',
            'Tunai'   => 'Tunai',
            'qris'    => 'QRIS',
            'cashier' => 'Tunai'
        ];
        $metode = isset($metode_map[$payment_method]) ? $metode_map[$payment_method] : 'QRIS';

        $total_harga = 0;
        foreach ($cart as $item) {
            $menu = $this->db->get_where('menu', ['id_menu' => $item['id_menu']])->row();
            if (!$menu) continue;
            $total_harga += $menu->harga * $item['qty'];
            if (!empty($item['addons'])) {
                foreach ($item['addons'] as $addon) {
                    $total_harga += ($addon['harga'] ?? 0) * $item['qty'];
                }
            }
        }

        $no_invoice = 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        $no_pesanan = 'PSN-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));

        $data_transaksi = [
            'id_user'           => null,
            'id_meja'           => $id_meja,
            'no_pesanan'        => $no_pesanan,
            'no_invoice'        => $no_invoice,
            'tanggal'           => date('Y-m-d H:i:s'),
            'catatan'           => $this->input->post('catatan'),
            'metode_pembayaran' => $metode,
            'status_pembayaran' => ($metode === 'QRIS') ? 'paid' : 'pending',
            'status_pesanan'    => 'diproses',
            'total_harga'       => $total_harga
        ];

        $this->db->insert('transaksi', $data_transaksi);
        $id_transaksi = $this->db->insert_id();

        foreach ($cart as $item) {
            $menu = $this->db->get_where('menu', ['id_menu' => $item['id_menu']])->row();
            if (!$menu) continue;

            $subtotal = $menu->harga * $item['qty'];

            $data_detail = [
                'id_transaksi' => $id_transaksi,
                'id_menu'      => $item['id_menu'],
                'jumlah'       => $item['qty'],
                'harga'        => $menu->harga,
                'subtotal'     => $subtotal
            ];

            $this->db->insert('detail_transaksi', $data_detail);
            $id_detail = $this->db->insert_id();

            if (!empty($item['addons'])) {
                foreach ($item['addons'] as $addon) {
                    $this->db->insert('detail_transaksi_addons', [
                        'id_detail'     => $id_detail,
                        'id_addon'      => $addon['id'],
                        'qty'           => $item['qty'],
                        'harga_addon'   => $addon['harga'] ?? 0,
                        'subtotal_addon' => ($addon['harga'] ?? 0) * $item['qty']
                    ]);
                }
            }

            $this->db->set('stok', 'stok - ' . (int)$item['qty'], FALSE);
            $this->db->where('id_menu', $item['id_menu']);
            $this->db->update('menu');
        }

        $this->session->unset_userdata('cart');

        $no_meja = $this->session->userdata('no_meja');
        $this->session->set_flashdata('checkout_success', [
            'no_invoice' => $no_invoice,
            'no_meja'    => $no_meja,
            'total'      => $total_harga
        ]);

        redirect('menu/checkout_success');
    }

    public function get_addons_by_menu($id_menu)
    {
        $menu = $this->db->get_where('menu', ['id_menu' => $id_menu])->row();
        if (!$menu || !$menu->id_kategori) {
            echo json_encode([]);
            return;
        }

        $this->config->load('kategori_grup');
        $kategori_grup = $this->config->item('kategori_grup');
        $grup = $kategori_grup[$menu->id_kategori] ?? '';

        if (!$grup) {
            echo json_encode([]);
            return;
        }

        $addons = $this->db->get_where('addons', ['grup' => $grup])->result();
        echo json_encode($addons);
    }

    public function checkout_success()
    {
        $data = $this->session->flashdata('checkout_success');
        if (!$data) {
            redirect('menu');
        }
        $this->load->view('customers/vsukses', $data);
    }
}


<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->model('Kategori_model');
        $this->load->model('Transaksi_Customer_model');

        $method = $this->router->fetch_method();

        if (
            !$this->session->userdata('id_meja')
            && $method != 'set_meja'
            && $method != 'clear_cart'
            && $method != 'sukses'
            && $method != 'DetailPesanan'
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



    // Transaksi
    public function checkout()
    {
        $cart = $this->session->userdata('cart');

        if (empty($cart)) {
            show_error('Keranjang kosong');
        }

        $total_harga = 0;

        foreach ($cart as $item) {

            $subtotal = $item['harga'] * $item['qty'];

            if (!empty($item['addons'])) {
                foreach ($item['addons'] as $addon) {
                    $subtotal += $addon['harga_addon'] * $addon['qty'];
                }
            }

            $total_harga += $subtotal;
        }

        $no_pesanan = $this->Transaksi_Customer_model->generate_no_pesanan();

        $data_transaksi = [
            'id_meja'           => $this->session->userdata('id_meja'),
            'no_pesanan'        => $no_pesanan,
            'no_invoice' => 'INV-' . date('Ymd') . '-' . rand(100000, 999999),
            'tanggal'           => date('Y-m-d H:i:s'),
            'catatan'           => $this->input->post('catatan'),
            'metode_pembayaran' => $this->input->post('payment_method'),
            'status_pembayaran' => 'pending',
            'status_pesanan'    => 'diproses',
            'total_harga'       => $total_harga
        ];



        $this->db->trans_begin();
        $id_transaksi = $this->Transaksi_Customer_model->simpan_transaksi($data_transaksi);

        foreach ($cart as $item) {
            $subtotal = $item['harga'] * $item['qty'];

            $data_detail = [
                'id_transaksi' => $id_transaksi,
                'id_menu'      => $item['id_menu'],
                'jumlah'       => $item['qty'],
                'harga'        => $item['harga'],
                'subtotal'     => $subtotal
            ];

            $id_detail = $this->Transaksi_Customer_model
                ->simpan_detail($data_detail);

            if (!empty($item['addons'])) {
                foreach ($item['addons'] as $addon) {
                    $data_addon = [
                        'id_detail'      => $id_detail,
                        'id_addon'       => $addon['id_addon'],
                        'qty'            => $addon['qty'],
                        'harga_addon'    => $addon['harga_addon'],
                        'subtotal_addon' => $addon['harga_addon'] * $addon['qty']
                    ];

                    $this->Transaksi_Customer_model
                        ->simpan_detail_addon($data_addon);
                }
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            echo "<script>alert( 'Checkout gagal');</script>";
        } else {
            $this->db->trans_commit();

            $this->session->unset_userdata('cart');

            // Simpan no_pesanan ke session agar bisa diambil di halaman sukses
            $this->session->set_userdata('no_pesanan', $no_pesanan);

            $this->session->set_flashdata('success', 'Pesanan berhasil dibuat');

            //  Redirect ke METHOD controller, bukan langsung ke view
            redirect('Menu/sukses');
        }
    }

    public function sukses()
    {
        $no_pesanan = $this->session->userdata('no_pesanan');

        if (!$no_pesanan) {
            redirect('Menu');
            return;
        }

        $transaksi = $this->db
            ->where('no_pesanan', $no_pesanan)
            ->get('transaksi')
            ->row();

        if (!$transaksi) {
            redirect('Menu');
            return;
        }

        $this->session->unset_userdata('no_pesanan');

        $data['no_pesanan'] = $transaksi->no_pesanan;
        $this->load->view('customers/vsukses', $data);
    }

    public function DetailPesanan($no_pesanan)
    {
        if (!$no_pesanan) {
            redirect('Menu');
            return;
        }

        $transaksi = $this->db
            ->where('no_pesanan', $no_pesanan)
            ->get('transaksi')
            ->row();

        if (!$transaksi) {
            show_404();
            return;
        }

        // Ambil detail item pesanan beserta nama menu
        $detail = $this->db
            ->select('detail_transaksi.*, menu.nama_menu')
            ->from('detail_transaksi')
            ->join('menu', 'menu.id_menu = detail_transaksi.id_menu')
            ->where('detail_transaksi.id_transaksi', $transaksi->id_transaksi)
            ->get()
            ->result();

        // Ambil addon per detail
        foreach ($detail as $item) {
            $item->addons = $this->db
                ->select('detail_transaksi_addons.*, addons.nama_addon')
                ->from('detail_transaksi_addons')
                ->join('addons', 'addons.id_addon = detail_transaksi_addons.id_addon')
                ->where('detail_transaksi_addons.id_detail', $item->id_detail)
                ->get()
                ->result();
        }

        $data['transaksi'] = $transaksi;
        $data['detail']    = $detail;
        $data['service_fee'] = 1000;

        $this->load->view('customers/vdetail_pesanan', $data);
    }
}

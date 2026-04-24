<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_cafe extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model');
        $this->load->model('User_model');
        $this->load->model('Pesanan_model');
        $this->load->model('Meja_model');
        $this->load->model('Transaksi_model');
        $this->load->helper('url');
        $this->load->library('session');



        if (
            !$this->session->userdata('login') &&
            $this->router->fetch_method() != 'login' &&
            $this->router->fetch_method() != 'proses_login'
        ) {
            echo '<script>alert("Anda harus login terlebih dahulu!"); window.location="' . site_url('dashboard_cafe/login') . '";</script>';
        }
    }

    public function login()
    {
        $this->load->view('vlogin');
    }

    public function proses_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', [
            'username' => $username,
            'password' => $password
        ])->row();

        if ($user) {

            $this->session->set_userdata([
                'id_user' => $user->id_user,
                'nama'    => $user->nama,
                'login'   => true
            ]);

            redirect('dashboard_cafe');
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah');
            echo '<script>alert("Login gagal! Periksa username dan password Anda."); window.location="' . site_url('dashboard_cafe/login') . '";</script>';
        }
    }

    public function logout()
    {
        // hapus semua session
        $this->session->sess_destroy();

        // redirect ke login
        echo '<script>alert("Anda berhasil logout!"); window.location="' . site_url('dashboard_cafe/login') . '";</script>';
    }

    public function index()
    {
        $data['total_menu'] = $this->db->count_all('menu');
        $data['total_user'] = $this->db->count_all('user');
        $data['total_transaksi'] = $this->db->count_all('transaksi');
        $data['total_pendapatan'] = $this->db->select('SUM(total_harga) as total')->from('transaksi')->get()->row()->total ?: 0;

        $this->db->select('YEAR(tanggal) as year, MONTH(tanggal) as month, SUM(total_harga) sales');
        $this->db->from('transaksi');
        $this->db->group_by('YEAR(tanggal), MONTH(tanggal)');
        $this->db->order_by('year DESC, month ASC');
        $this->db->limit(12);
        $data['monthly_sales'] = $this->db->get()->result_array();

        $this->db->select('YEAR(tanggal) as year, MONTH(tanggal) as month, COUNT(id_transaksi) count');
        $this->db->from('transaksi');
        $this->db->group_by('YEAR(tanggal), MONTH(tanggal)');
        $this->db->order_by('year DESC, month ASC');
        $this->db->limit(12);
        $data['monthly_purchases'] = $this->db->get()->result_array();

        $this->db->select('t.id_transaksi, mj.no_meja, t.pemesan, t.tanggal, t.status_pesanan, t.total_harga');
        $this->db->from('transaksi t');
        $this->db->join('meja mj', 't.id_meja = mj.id_meja', 'left');
        $this->db->limit(10);
        $data['transaksi'] = $this->db->get()->result();

        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('template/konten', $data);
        $this->load->view('template/footer');
    }

    // Menu CRUD (old produk)
    public function lihat_menu()
    {
        $this->load->library('session');
        $data['menu'] = $this->menu_model->lihat_data()->result();
        $data['message'] = $this->session->flashdata('message');
        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vmenu', $data);
        $this->load->view('template/footer');
    }

    public function tambah_menu()
    {
        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vtambah_menu');
        $this->load->view('template/footer');
    }

    public function simpan_menu()
    {
        $config['upload_path'] = './assets/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 10000;
        $config['max_width'] = 1028;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar')) {
            $error = $this->upload->display_errors();
            echo '<div class="alert alert-danger">' . $error . '</div>';
            echo '<a href="' . site_url('dashboard_tokokue/tambah_produk') . '" class="btn btn-primary">Kembali</a>';
        } else {
            $nam = $this->input->post('nama_menu');
            $kat = $this->input->post('kategori');
            $stk = $this->input->post('stok');
            $des = $this->input->post('deskripsi');
            $har = $this->input->post('harga');
            $file = $this->upload->data();
            $gam = $file['file_name'];

            $this->menu_model->simpan_data(array(
                'nama_menu' => $nam,
                'kategori' => $kat,
                'stok' => $stk,
                'deskripsi' => $des,
                'harga' => $har,
                'gambar' => $gam
            ));
            redirect('dashboard_cafe/lihat_menu');
        }
    }

    public function hapus_menu($idmenu)
    {
        $this->menu_model->hapus_data($idmenu);
        $this->load->library('session');
        $this->session->set_flashdata('message', 'Menu berhasil dihapus!');
        redirect('dashboard_cafe/lihat_menu');
    }

    public function edit_menu($idmenu)
    {
        $where = array('id_menu' => $idmenu);
        $data['menu'] = $this->menu_model->edit_data($where, 'menu')->result();
        $this->load->view("template/head");
        $this->load->view("template/navbar");
        $this->load->view("template/sidebar");
        $this->load->view("vedit_menu", $data);
        $this->load->view("template/footer");
    }

    public function update_menu()
    {
        $id_menu = $this->input->post('id_menu');
        $nama = $this->input->post('nama_menu');
        $kat = $this->input->post('kategori');
        $stok = $this->input->post('stok');
        $des = $this->input->post('deskripsi');
        $harga = $this->input->post('harga');

        if (!empty($_FILES['gambar']['name'])) {

            $config['upload_path'] = 'assets/uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 20000;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $file = $this->upload->data();
                $gambar = $file['file_name'];

                $data = array(
                    'nama_menu' => $nama,
                    'kategori' => $kat,
                    'stok' => $stok,
                    'deskripsi' => $des,
                    'harga' => $harga,
                    'gambar' => $gambar
                );
            } else {
                $data = array(
                    'nama_menu' => $nama,
                    'kategori' => $kat,
                    'stok' => $stok,
                    'deskripsi' => $des,
                    'harga' => $harga
                );
            }
        } else {
            $data = array(
                'nama_menu' => $nama,
                'kategori' => $kat,
                'stok' => $stok,
                'deskripsi' => $des,
                'harga' => $harga
            );
        }
        $where = array('id_menu' => $id_menu);
        $this->menu_model->update_data($where, $data, 'menu');
        redirect('dashboard_cafe/lihat_menu');
    }

    public function lihat_user()
    {
        $data['user'] = $this->User_model->lihat_data()->result();
        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vuser', $data);
        $this->load->view('template/footer');
    }

    public function tambah_user()
    {
        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vtambah_user');
        $this->load->view('template/footer');
    }

    public function simpan_user()
    {
        $nam = $this->input->post('nama');
        $jab = $this->input->post('jabatan');

        $this->User_model->simpan_data(array(
            'nama' => $nam,
            'jabatan' => $jab
        ));
        redirect('dashboard_cafe/lihat_user');
    }

    public function hapus_user($id_user)
    {
        $this->User_model->hapus_data($id_user);
        redirect('dashboard_cafe/lihat_user');
    }

    public function edit_user($iduser)
    {
        $where = array('id_user' => $iduser);
        $data['user'] = $this->user_model->edit_data($where, 'user')->result();
        $this->load->view("template/head");
        $this->load->view("template/navbar");
        $this->load->view("template/sidebar");
        $this->load->view("vedit_user", $data);
        $this->load->view("template/footer");
    }

    public function update_user()
    {
        $id_user = $this->input->post('id_user');
        $nama = $this->input->post('nama');
        $jab = $this->input->post('jabatan');
        $data = array(
            'nama' => $nama,
            'jabatan' => $jab,
        );

        $where = array('id_user' => $id_user);
        $this->user_model->update_data($where, $data, 'user');
        redirect('dashboard_cafe/lihat_user');
    }

    // Transaksi CRUD (old barang_keluar)
    public function lihat_transaksi()
    {
        $this->load->library('session');
        $data['transaksi'] = $this->Transaksi_model->lihat_data()->result();
        $data['user'] = $this->User_model->lihat_data()->result();
        $data['meja'] = $this->Meja_model->lihat_data()->result();
        $data['message'] = $this->session->flashdata('message');
        $data['error'] = $this->session->flashdata('error');
        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vtransaksi', $data);
        $this->load->view('template/footer');
    }

    public function simpan_transaksi()
    {
        $id_user = $this->session->userdata('id_user');
        if (!$id_user) {
            redirect('dashboard_cafe/login');
        }

        $cart = json_decode($this->input->post('cart_data'), true);

        if (!$cart || count($cart) == 0) {
            show_error('Cart kosong');
        }

        $total_harga = 0;


        foreach ($cart as $item) {
            $menu = $this->db->get_where('menu', ['id_menu' => $item['menu']])->row();
            if (!$menu) continue;

            $total_harga += $menu->harga * $item['jumlah'];
        }


        $data_transaksi = [
            'id_user' => $id_user,
            'id_meja' => $this->input->post('meja'),
            'pemesan' => $this->input->post('pemesan') ?: 'Walk-in',
            'tanggal' => date('Y-m-d H:i:s'),
            'metode_pembayaran' => $this->input->post('metode_pembayaran'),
            'status_pembayaran' => 'paid', // karena dari kasir
            'status_pesanan' => 'diproses',
            'total_harga' => $total_harga
        ];

        $this->db->insert('transaksi', $data_transaksi);
        $id_transaksi = $this->db->insert_id();


        foreach ($cart as $item) {
            $menu = $this->db->get_where('menu', ['id_menu' => $item['menu']])->row();
            if (!$menu) continue;

            $subtotal = $menu->harga * $item['jumlah'];

            $data_detail = [
                'id_transaksi' => $id_transaksi,
                'id_menu' => $item['menu'],
                'jumlah' => $item['jumlah'],
                'harga' => $menu->harga,
                'subtotal' => $subtotal
            ];

            $this->db->insert('detail_transaksi', $data_detail);

            // kurangi stok
            $this->menu_model->kurangi_stok($item['menu'], $item['jumlah']);
        }

        redirect('dashboard_cafe/lihat_transaksi');
    }

    public function hapus_transaksi($id)
    {
        // ambil semua detail
        $detail = $this->db->get_where('detail_transaksi', [
            'id_transaksi' => $id
        ])->result();

        // balikin stok
        foreach ($detail as $d) {
            $this->menu_model->tambah_stok($d->id_menu, $d->jumlah);
        }

        // hapus detail dulu
        $this->db->delete('detail_transaksi', ['id_transaksi' => $id]);

        // baru hapus transaksi
        $this->db->delete('transaksi', ['id_transaksi' => $id]);

        echo '<script>alert("Transaksi berhasil dihapus! Stok telah disesuaikan."); window.location="' . site_url('dashboard_cafe/lihat_transaksi') . '";</script>';
    }

    public function tambah_transaksi()
    {
        $data['menu'] = $this->menu_model->lihat_data()->result();
        $data['user'] = $this->User_model->lihat_data()->result();
        $data['meja'] = $this->Meja_model->lihat_data()->result();

        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vtambah_transaksi', $data);
        $this->load->view('template/footer');
    }

    public function edit_transaksi($id)
    {
        // transaksi
        $data['tr'] = $this->db->get_where('transaksi', [
            'id_transaksi' => $id
        ])->row();

        // detail
        $this->db->select('d.*, m.nama_menu');
        $this->db->from('detail_transaksi d');
        $this->db->join('menu m', 'd.id_menu = m.id_menu');
        $this->db->where('d.id_transaksi', $id);
        $data['detail'] = $this->db->get()->result();

        $data['menu'] = $this->menu_model->lihat_data()->result();
        $data['meja'] = $this->Meja_model->lihat_data()->result();

        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vedit_transaksi', $data);
        $this->load->view('template/footer');
    }

    public function update_transaksi()
    {
        $id = $this->input->post('id_transaksi');

        // ambil cart baru
        $cart = json_decode($this->input->post('cart_data'), true);

        if (!$cart || count($cart) == 0) {
            show_error('Cart kosong');
        }

        // 1. ambil detail lama → balikin stok
        $old_detail = $this->db->get_where('detail_transaksi', [
            'id_transaksi' => $id
        ])->result();

        foreach ($old_detail as $d) {
            $this->menu_model->tambah_stok($d->id_menu, $d->jumlah);
        }

        // 2. hapus detail lama
        $this->db->delete('detail_transaksi', [
            'id_transaksi' => $id
        ]);

        // 3. hitung total baru
        $total_harga = 0;

        foreach ($cart as $item) {
            $menu = $this->db->get_where('menu', [
                'id_menu' => $item['menu']
            ])->row();

            if (!$menu) continue;

            $total_harga += $menu->harga * $item['jumlah'];
        }

        // 4. update transaksi
        $data_transaksi = [
            'id_meja' => $this->input->post('meja'),
            'pemesan' => $this->input->post('pemesan'),
            'metode_pembayaran' => $this->input->post('metode_pembayaran'),
            'status_pesanan' => $this->input->post('status_pesanan'),
            'total_harga' => $total_harga
        ];

        $this->db->update('transaksi', $data_transaksi, [
            'id_transaksi' => $id
        ]);

        // 5. insert detail baru + kurangi stok
        foreach ($cart as $item) {
            $menu = $this->db->get_where('menu', [
                'id_menu' => $item['menu']
            ])->row();

            if (!$menu) continue;

            $subtotal = $menu->harga * $item['jumlah'];

            $this->db->insert('detail_transaksi', [
                'id_transaksi' => $id,
                'id_menu' => $item['menu'],
                'jumlah' => $item['jumlah'],
                'harga' => $menu->harga,
                'subtotal' => $subtotal
            ]);

            $this->menu_model->kurangi_stok($item['menu'], $item['jumlah']);
        }

        echo '<script>alert("Transaksi berhasil diperbarui! Stok telah disesuaikan."); window.location="' . site_url('dashboard_cafe/lihat_transaksi') . '";</script>';
    }

    public function detail_transaksi($id)
    {
        // ambil transaksi (header)
        $this->db->select('t.*, u.nama as nama_user, m.no_meja');
        $this->db->from('transaksi t');
        $this->db->join('user u', 't.id_user = u.id_user', 'left');
        $this->db->join('meja m', 't.id_meja = m.id_meja', 'left');
        $this->db->where('t.id_transaksi', $id);
        $data['transaksi'] = $this->db->get()->row();

        // ambil detail
        $this->db->select('d.*, m.nama_menu');
        $this->db->from('detail_transaksi d');
        $this->db->join('menu m', 'd.id_menu = m.id_menu');
        $this->db->where('d.id_transaksi', $id);
        $data['detail'] = $this->db->get()->result();

        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vdetail_pesanan', $data);
        $this->load->view('template/footer');
    }

    // public function lihat_detail_transaksi()
    // {
    //     $this->db->select('d.*, t.id_transaksi, m.nama_menu');
    //     $this->db->from('detail_transaksi d');
    //     $this->db->join('transaksi t', 'd.id_transaksi = t.id_transaksi');
    //     $this->db->join('menu m', 'd.id_menu = m.id_menu');

    //     $data['detail'] = $this->db->get()->result();

    //     $this->load->view('template/head');
    //     $this->load->view('template/navbar');
    //     $this->load->view('template/sidebar');
    //     $this->load->view('vdetail_transaksi', $data);
    //     $this->load->view('template/footer');
    // }

    // Meja CRUD
    public function lihat_meja()
    {
        $data['meja'] = $this->Meja_model->lihat_data()->result();
        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vmeja', $data);
        $this->load->view('template/footer');
    }

    public function tambah_meja()
    {
        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vtambah_meja');
        $this->load->view('template/footer');
    }

    public function simpan_meja()
    {
        $nom = $this->input->post('no_meja');

        $this->Meja_model->simpan_data(array(
            'no_meja' => $nom
        ));
        redirect('dashboard_cafe/lihat_meja');
    }

    public function hapus_meja($id_meja)
    {
        $this->Meja_model->hapus_data($id_meja);
        redirect('dashboard_cafe/lihat_meja');
    }

    public function edit_meja($id_meja)
    {
        $where = array('id_meja' => $id_meja);
        $data['meja'] = $this->Meja_model->edit_data($where, 'meja')->result();
        $this->load->view("template/head");
        $this->load->view("template/navbar");
        $this->load->view("template/sidebar");
        $this->load->view("vedit_meja", $data);
        $this->load->view("template/footer");
    }

    public function update_meja()
    {
        $id_meja = $this->input->post('id_meja');
        $no_meja = $this->input->post('no_meja');
        $data = array(
            'no_meja' => $no_meja,
        );

        $where = array('id_meja' => $id_meja);
        $this->Meja_model->update_data($where, $data, 'meja');
        redirect('dashboard_cafe/lihat_meja');
    }
}

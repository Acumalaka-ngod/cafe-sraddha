<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_cafe extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
        $this->load->model('User_model');
        $this->load->model('Transaksi_model');
        $this->load->model('Meja_model');
        $this->load->helper('url');
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

        $this->db->select('t.*, u.nama as nama_user, m.nama_menu');
        $this->db->from('transaksi t');
        $this->db->join('user u', 't.id_user = u.id_user', 'left');
        $this->db->join('menu m', 't.menu_dipesan = m.id_menu', 'left');
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
        $data['user'] = $this->user_model->lihat_data()->result();
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
        $id_menu = $this->input->post('menu');
        $jumlah = (int) $this->input->post('jumlah');

        if ($this->menu_model->kurangi_stok($id_menu, $jumlah)) {
            // Get harga from menu
            $this->db->select('harga');
            $this->db->where('id_menu', $id_menu);
            $harga = $this->db->get('menu')->row()->harga;
            $total_harga = $jumlah * $harga;

            $data = array(
                'id_meja' => $this->input->post('meja'),
                'tanggal' => $this->input->post('tanggal'),
                'total_harga' => $total_harga,
                'id_user' => $this->input->post('user'),
                'menu_dipesan' => $id_menu,
                'metode_pembayaran' => $this->input->post('metode_pembayaran'),
                'no_meja' => $this->input->post('no_meja'),
                // nama_user trigger or update later
            );

            $this->Transaksi_model->simpan_data($data);
            $this->load->library('session');
            $this->session->set_flashdata('message', 'Transaksi berhasil ditambahkan. Stok menu dikurangi.');
            redirect('dashboard_cafe/lihat_transaksi');
        } else {
            $this->load->library('session');
            $this->session->set_flashdata('error', 'Stok menu tidak mencukupi!');
            redirect('dashboard_cafe/tambah_transaksi');
        }
    }

    public function hapus_transaksi($id)
    {
        $this->db->select('menu_dipesan, jumlah'); // adjust if jumlah not in transaksi, assume added or from total/harga
        $this->db->where('id_transaksi', $id);
        $record = $this->db->get('transaksi')->row();

        if ($record) {
            // Approximate jumlah from total_harga / harga if needed
            $this->db->select('harga');
            $this->db->where('id_menu', $record->menu_dipesan);
            $harga = $this->db->get('menu')->row()->harga;
            $jumlah_approx = ceil($record->total_harga / $harga);
            $this->menu_model->tambah_stok($record->menu_dipesan, $jumlah_approx);
        }

        $this->Transaksi_model->hapus_data($id);

        $this->load->library('session');
        $this->session->set_flashdata('message', 'Transaksi dihapus. Stok menu ditambahkan kembali.');
        redirect('dashboard_cafe/lihat_transaksi');
    }

    public function tambah_transaksi()
    {
        $data['menu'] = $this->menu_model->lihat_data()->result();
        $data['user'] = $this->user_model->lihat_data()->result();
        $data['meja'] = $this->Meja_model->lihat_data()->result();

        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vtambah_transaksi', $data);
        $this->load->view('template/footer');
    }

    public function edit_transaksi($id)
    {
        $where = array('id_transaksi' => $id);
        $data['tr'] = $this->db->get_where('transaksi', $where)->row();
        $data['menu'] = $this->menu_model->lihat_data()->result();
        $data['user'] = $this->user_model->lihat_data()->result();
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
        $new_id_menu = $this->input->post('menu');
        $new_jumlah = (int) $this->input->post('jumlah');
        $new_id_meja = $this->input->post('meja');
        $new_id_user = $this->input->post('user');
        $new_metode = $this->input->post('metode_pembayaran');

        // Adjust stok for old/new
        $old_record = $this->db->get_where('transaksi', array('id_transaksi' => $id))->row();
        if ($old_record) {
            $this->menu_model->tambah_stok($old_record->menu_dipesan, 1); // approx reverse
        }

        $harga = $this->db->select('harga')->where('id_menu', $new_id_menu)->get('menu')->row()->harga;
        $total_harga = $new_jumlah * $harga;

        $data = array(
            'id_meja' => $new_id_meja,
            'tanggal' => $this->input->post('tanggal'),
            'total_harga' => $total_harga,
            'id_user' => $new_id_user,
            'menu_dipesan' => $new_id_menu,
            'metode_pembayaran' => $new_metode,
            'no_meja' => $this->input->post('no_meja'),
        );
        $this->db->update('transaksi', $data, array('id_transaksi' => $id));

        $this->menu_model->kurangi_stok($new_id_menu, $new_jumlah);

        $this->load->library('session');
        $this->session->set_flashdata('message', 'Transaksi berhasil diupdate. Stok disesuaikan.');
        redirect('dashboard_cafe/lihat_transaksi');
    }

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

    // Add edit/hapus meja similarly...
}

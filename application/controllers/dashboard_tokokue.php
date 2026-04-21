<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_tokokue extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('toko_model');
        $this->load->model('Customer_model');
        $this->load->model('barangKeluar_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['total_produk'] = $this->db->count_all('produk');
        $data['total_customer'] = $this->db->count_all('customer');
        $data['total_barang_keluar'] = $this->db->count_all('barang_keluar');
        $data['total_pendapatan'] = $this->db->select('SUM(bk.jumlah_barang * p.harga) as total')->from('barang_keluar bk')->join('produk p', 'bk.id_produk = p.id_produk')->get()->row()->total ?: 0;
        
$this->db->select('YEAR(tanggal) as year, MONTH(tanggal) as month, SUM(bk.jumlah_barang * p.harga) sales');
        $this->db->from('barang_keluar bk');
        $this->db->join('produk p', 'bk.id_produk = p.id_produk');
        $this->db->group_by('YEAR(tanggal), MONTH(tanggal)');
        $this->db->order_by('year DESC, month ASC');
        $this->db->limit(12);
        $data['monthly_sales'] = $this->db->get()->result_array();
        
$this->db->select('YEAR(tanggal) as year, MONTH(tanggal) as month, COUNT(id_barang_keluar) count');
        $this->db->from('barang_keluar');
        $this->db->group_by('YEAR(tanggal), MONTH(tanggal)');
        $this->db->order_by('year DESC, month ASC');
        $this->db->limit(12);
        $data['monthly_purchases'] = $this->db->get()->result_array();
        
        $this->db->select('bk.*, c.nama_customer, p.nama_produk, p.harga');
        $this->db->from('barang_keluar bk');
        $this->db->join('customer c', 'bk.id_customer = c.id_customer', 'left');
        $this->db->join('produk p', 'bk.id_produk = p.id_produk');
        $this->db->limit(10);
        $data['barang_keluar'] = $this->db->get()->result();
        
        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('template/konten', $data);
        $this->load->view('template/footer');
    }

    public function lihat_produk()
    {
        $this->load->library('session');
        $data['produk'] = $this->toko_model->lihat_data()->result();
        $data['message'] = $this->session->flashdata('message');
        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vproduk', $data);
        $this->load->view('template/footer');
    }

    public function tambah_produk()
    {
        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vtambah_produk');
        $this->load->view('template/footer');
    }

    public function simpan_produk()
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
            $kdp = $this->input->post('kode_produk');
            $nam = $this->input->post('nama_produk');
            $stk = $this->input->post('stok');
            $des = $this->input->post('deskripsi');
            $har = $this->input->post('harga');
            $file = $this->upload->data();
            $gam = $file['file_name'];

            $this->toko_model->simpan_data(array(
                'kode_produk' => $kdp,
                'nama_produk' => $nam,
                'stok' => $stk,
                'deskripsi' => $des,
                'harga' => $har,
                'gambar' => $gam
            ));
            redirect('dashboard_tokokue/lihat_produk');
        }
    }
    public function hapus_produk($idproduk)
    {
        $this->toko_model->hapus_data($idproduk);
        $this->load->library('session');
        $this->session->set_flashdata('message', 'Produk berhasil dihapus!');
        redirect('dashboard_tokokue/lihat_produk');
    }

    public function edit_produk($idproduk)
    {
        $where = array('id_produk' => $idproduk);
        $data['produk'] = $this->toko_model->edit_data($where, 'produk')->result();
        $this->load->view("template/head");
        $this->load->view("template/navbar");
        $this->load->view("template/sidebar");
        $this->load->view("vedit_produk", $data);
        $this->load->view("template/footer");
    }
    public function update_produk()
    {

        $id_produk = $this->input->post('id_produk');
        $kdproduk = $this->input->post('kode_produk');
        $nama = $this->input->post('nama_produk');
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
                    'kode_produk' => $kdproduk,
                    'nama_produk' => $nama,
                    'stok' => $stok,
                    'deskripsi' => $des,
                    'harga' => $harga,
                    'gambar' => $gambar
                );
            } else {
                $data = array(
                    'kode_produk' => $kdproduk,
                    'nama_produk' => $nama,
                    'stok' => $stok,
                    'deskripsi' => $des,
                    'harga' => $harga,
                );
            }

        } else {
            $data = array(
                'kode_produk' => $kdproduk,
                'nama_produk' => $nama,
                'stok' => $stok,
                'deskripsi' => $des,
                'harga' => $harga,
            );
        }

        $where = array('id_produk' => $id_produk);

        $this->toko_model->update_data($where, $data, 'produk');

        redirect('dashboard_tokokue/lihat_produk');
    }

    public function lihat_customer()
    {
        $data['customer'] = $this->Customer_model->lihat_data()->result();
        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vcustomer', $data);
        $this->load->view('template/footer');
    }

    public function tambah_customer()
    {
        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vtambah_customer');
        $this->load->view('template/footer');
    }

    public function simpan_customer()
    {
        $kdc = $this->input->post('kode_customer');
        $nam = $this->input->post('nama_customer');
        $alm = $this->input->post('address');
        $kt = $this->input->post('kota');

        $this->Customer_model->simpan_data(array(
            'kode_customer' => $kdc,
            'nama_customer' => $nam,
            'address' => $alm,
            'kota' => $kt
        ));
        redirect('dashboard_tokokue/lihat_customer');
    }
    public function hapus_customer($idcustomer)
    {
        $this->Customer_model->hapus_data($idcustomer);
        redirect('dashboard_tokokue/lihat_customer');
    }

    public function edit_customer($idcustomer)
    {
        $where = array('id_customer' => $idcustomer);
        $data['customer'] = $this->Customer_model->edit_data($where, 'customer')->result();
        $this->load->view("template/head");
        $this->load->view("template/navbar");
        $this->load->view("template/sidebar");
        $this->load->view("vedit_customer", $data);
        $this->load->view("template/footer");
    }
    public function update_customer()
    {

        $id_customer = $this->input->post('id_customer');
        $kdcustomer = $this->input->post('kode_customer');
        $nama = $this->input->post('nama_customer');
        $alm = $this->input->post('address');
        $kt = $this->input->post('kota');
        $data = array(
            'kode_customer' => $kdcustomer,
            'nama_customer' => $nama,
            'address' => $alm,
            'kota' => $kt,
        );

        $where = array('id_customer' => $id_customer);

        $this->Customer_model->update_data($where, $data, 'customer');

        redirect('dashboard_tokokue/lihat_customer');
    }

    public function lihat_barangkeluar()
    {
        $this->load->library('session');
        $data['barang_keluar'] = $this->barangKeluar_model->lihat_data()->result();
        $data['customer'] = $this->Customer_model->lihat_data()->result();
        $data['message'] = $this->session->flashdata('message');
        $data['error'] = $this->session->flashdata('error');
        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vbarangkeluar', $data);
        $this->load->view('template/footer');
    }

    public function simpan_barangkeluar()
    {
        $id_produk = $this->input->post('produk');
        $jumlah = (int)$this->input->post('jumlah');

        if ($this->toko_model->kurangi_stok($id_produk, $jumlah)) {
            $data = array(
                'no_transaksi' => $this->input->post('no_transaksi'),
                'tanggal' => $this->input->post('tanggal'),
                'id_customer' => $this->input->post('customer'),
                'id_produk' => $id_produk,
                'jumlah_barang' => $jumlah,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => 'admin'
            );

            $this->barangKeluar_model->simpan_data($data);
            $this->load->library('session');
            $this->session->set_flashdata('message', 'Barang keluar berhasil ditambahkan. Stok produk dikurangi.');
            redirect('dashboard_tokokue/lihat_barangkeluar');
        } else {
            $this->load->library('session');
            $this->session->set_flashdata('error', 'Stok produk tidak mencukupi!');
            redirect('dashboard_tokokue/tambah_barangkeluar');
        }
    }

    public function hapus_barangkeluar($id)
    {
        $this->db->select('id_produk, jumlah_barang');
        $this->db->where('id_barang_keluar', $id);
        $record = $this->db->get('barang_keluar')->row();
        
        if ($record) {
            $this->toko_model->tambah_stok($record->id_produk, $record->jumlah_barang);
        }
        
        $this->barangKeluar_model->hapus_data($id);
        
        $this->load->library('session');
        $this->session->set_flashdata('message', 'Barang keluar dihapus. Stok produk ditambahkan kembali.');
        redirect('dashboard_tokokue/lihat_barangkeluar');
    }

    public function tambah_barangkeluar()
    {
        $data['produk'] = $this->toko_model->lihat_data()->result();
        $data['customer'] = $this->Customer_model->lihat_data()->result();

        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
        $this->load->view('vtambah_barangkeluar', $data);
        $this->load->view('template/footer');
    }

    public function edit_barangkeluar($id)
    {

        $where = array('id_barang_keluar' => $id);
        $data['bk'] = $this->db->get_where('barang_keluar', $where)->row();
        $data['produk'] = $this->toko_model->lihat_data()->result();
        $data['customer'] = $this->Customer_model->lihat_data()->result();

        $this->load->view('template/head');
        $this->load->view('template/navbar');
        $this->load->view('template/sidebar');
		$this->load->view('vedit_barangkeluar',$data);
        $this->load->view('template/footer');
    }

    public function update_barangkeluar()
    {
        $id = $this->input->post('id_barang_keluar');
        $new_jumlah = (int)$this->input->post('jumlah');
        $new_id_produk = $this->input->post('produk');

        $this->db->where('id_barang_keluar', $id);
        $old_record = $this->db->get('barang_keluar')->row();
        
        if ($old_record) {
            $this->toko_model->tambah_stok($old_record->id_produk, $old_record->jumlah_barang);
            
            $data = array(
                'no_transaksi' => $this->input->post('no_transaksi'),
                'tanggal' => $this->input->post('tanggal'),
                'id_customer' => $this->input->post('customer'),
                'id_produk' => $new_id_produk,
                'jumlah_barang' => $new_jumlah
            );
            $this->db->update('barang_keluar', $data, array('id_barang_keluar' => $id));
            
            $this->toko_model->kurangi_stok($new_id_produk, $new_jumlah);
        }
        
        $this->load->library('session');
        $this->session->set_flashdata('message', 'Barang keluar berhasil diupdate. Stok disesuaikan.');
        redirect('dashboard_tokokue/lihat_barangkeluar');
    }

    public function login(){
        $this->load->view('admin/login');
    }
}

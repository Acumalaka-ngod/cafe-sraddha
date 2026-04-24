<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Toko_model');
        $this->load->helper('url');
    }

    public function lihat_produk()
    {
        $data['produk'] = $this->toko_model->lihat_data()->result();
        $this->load->view('admin/head', $data);
        $this->load->view('admin/navbar', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/table', $data);
        $this->load->view('admin/footer', $data);
    }

    function tambah_produk()
    {
        $this->load->view('admin/head');
        $this->load->view('admin/navbar');
        $this->load->view('admin/sidebar');
        $this->load->view('admin/tambah_produk');
        $this->load->view('admin/footer');
    }

    public function simpan_produk()
    {
        $config['upload_path'] = 'assets/uploads/'; // buat folder uploads di root app CI
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 10000; //KB atau = 10 MB
        // $config['max_width']		= 1028;
        // $config['max_height']		= 768;
        $this->load->library('upload', $config);
        // $this->upload->initialize($config);

        if (!$this->upload->do_upload('gambar')) // sesuai dengan attribut name pada form
        {
            echo 'Gagal Upload Gambar';

        } else {   // tampung data dari form
            $nam = $this->input->post('nmproduk');
            $des = $this->input->post('deskripsi');
            $har = $this->input->post('harga');
            $file = $this->upload->data();
            $gam = $file['file_name'];

            $this->toko_model->simpan_data(array(
                'nama_produk' => $nam,
                'deskripsi' => $des,
                'harga' => $har,
                'gambar' => $gam
            ));
            redirect('dashboard/lihat_produk');
        }
    }
}

?>
<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Controller user yang mengelola user page
class Inventory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Inventory_model', 'invent');
    }

    public function index()
    {
        $email = $this->session->userdata('email');
        $data['title'] = 'Inventory';
        $data['user'] = $this->db->get_where('user', ['emailUser' => $email])->row_array();
        $data['produk'] = $this->invent->getAllProduk($email);
        $data['cabang'] = $this->invent->getCabang($email);

        $this->form_validation->set_rules('namaProduk', 'Nama Produk', 'required|trim');
        $this->form_validation->set_rules('cabang', 'Cabang', 'required|trim');
        $this->form_validation->set_rules('stokProduk', 'Stok Produk', 'required|trim');
        $this->form_validation->set_rules('hargaJual', 'Harga Jual', 'required|trim');
        $this->form_validation->set_rules('hargaBeli', 'Harga Beli', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('inventory/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->_produkTambah();
        }
    }

    private function _produkTambah()
    {
        $nama = $this->input->post('namaProduk');
        $cabang = $this->input->post('cabang');
        $stok = $this->input->post('stokProduk');
        $beli = $this->input->post('hargaBeli');
        $jual = $this->input->post('hargaJual');
        $email = $this->session->userdata('email');
        $date = date('Y-m-d');
        $profit = $jual - $beli;
        $terjual = 0;

        $data = [
            'idCabang' => $cabang,
            'email' => $email,
            'namaProduk' => $nama,
            'stokProduk' => $stok,
            'terjualProduk' => $terjual,
            'hargaBeli' => $beli,
            'hargaJual' => $jual,
            'profitProduk' => $profit,
            'dateCreated' => $date,
            'dateModified' => $date,
        ];

        $tambah = $this->invent->addProduk($data);

        if ($tambah > 0) {
            $this->session->set_flashdata('addProd', $nama);
            redirect('inventory');
        } else {
            $this->session->set_flashdata('addFail', $nama);
            redirect('inventory');
        }
    }

    public function ajaxGetProduk()
    {
        echo json_encode($this->invent->getProdukById($_POST['idJson']));
    }
}

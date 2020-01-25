<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Controller user yang mengelola user page
class Inventory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        //3Memanggil helper checkLogin
        checkLogin();

        $this->load->model('Inventory_model', 'invent');
    }

    public function index()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['emailUser' => $email])->row_array();
        $data['produk'] = $this->invent->getAllProduk($email);
        $data['cabang'] = $this->invent->getCabang($email);
        $data['title'] = 'Inventory';

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
            $this->load->view('templates/footer', $data);
        } else {
            $email = $this->session->userdata('email');
            $cabang = $this->input->post('cabang');
            $nama = $this->input->post('namaProduk');
            $stok = $this->input->post('stokProduk');
            $beli = $this->input->post('hargaBeli');
            $jual = $this->input->post('hargaJual');
            $profit = $jual - $beli;
            $date = date('Y-m-d');
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
                'dateModified' => $date
            ];

            $this->invent->addProduk($data);
            $this->session->set_flashdata('produkAdd', $nama);
            redirect('inventory');
        }
    }

    public function ajaxGetProduk()
    {
        echo json_encode($this->invent->getProdukById($_POST['idJson']));
    }

    public function editProduk()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['emailUser' => $email])->row_array();
        $data['produk'] = $this->invent->getAllProduk($email);
        $data['cabang'] = $this->invent->getCabang($email);
        $data['title'] = 'Inventory';

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
            $this->load->view('templates/footer', $data);
        } else {
            $email = $this->session->userdata('email');
            $cabang = $this->input->post('cabang');
            $nama = $this->input->post('namaProduk');
            $stok = $this->input->post('stokProduk');
            $terjual = $this->input->post('terjualProduk');
            $beli = $this->input->post('hargaBeli');
            $jual = $this->input->post('hargaJual');
            $dateCreate = $this->input->post('dateCreated');
            $profit = $jual - $beli;
            $date = date('Y-m-d');

            $data = [
                'idCabang' => $cabang,
                'namaProduk' => $nama,
                'stokProduk' => $stok,
                'hargaBeli' => $beli,
                'hargaJual' => $jual,
                'profitProduk' => $profit,
                'dateModified' => $date
            ];

            $this->invent->updateProduk($data);

            $this->session->set_flashdata('produkUpd', 'Add new');
            redirect('inventory');
        }
    }
}

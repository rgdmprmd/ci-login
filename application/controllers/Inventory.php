<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Controller user yang mengelola user page
class Inventory extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Memanggil helper checkLogin
        checkLogin();

        $this->load->model('Inventory_model', 'invent');
    }

    public function index()
    {
        $email = $this->session->userdata('email');

        $this->load->library('pagination');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');

            $this->session->set_userdata('keyword', $data['keyword']);
            redirect('inventory');
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $this->db->like('namaProduk', $data['keyword']);
        $this->db->from('products');
        $this->db->where('email', $email);

        if ($this->input->get('id')) {
            $cabid = $this->input->get('id');
            $this->db->where('idCabang', $cabid);
        }

        $config['total_rows'] = $this->db->count_all_results();
        $config['base_url'] = 'http://localhost:8080/uanq/inventory/index';
        $config['num_links'] = 3;
        $config['per_page'] = 8;

        $data['total_rows'] = $config['total_rows'];
        $data['start'] = $this->uri->segment(3);

        if ($this->input->get('id')) {
            $cabid = $this->input->get('id');
            $data['produk'] = $this->invent->getProdukByCabang($cabid, $config['per_page'], $data['start'], $data['keyword']);
        } else {
            $data['produk'] = $this->invent->getAllProduk($email, $config['per_page'], $data['start'], $data['keyword']);
        }

        $data['cabang'] = $this->invent->getCabang($email);
        $data['user'] = $this->db->get_where('user', ['emailUser' => $email])->row_array();

        $data['title'] = 'Inventory';

        $this->pagination->initialize($config);

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
            $this->session->set_flashdata('produkadd', 'ditambah');
            redirect('inventory');
        }
    }

    public function ajaxGetProduk()
    {
        echo json_encode($this->invent->getProdukById($_POST['idJson']));
    }

    public function editProduk()
    {

        $this->form_validation->set_rules('namaProduk', 'Nama Produk', 'required|trim');
        $this->form_validation->set_rules('stokProduk', 'Stok Produk', 'required|trim');
        $this->form_validation->set_rules('hargaJual', 'Harga Jual', 'required|trim');
        $this->form_validation->set_rules('hargaBeli', 'Harga Beli', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            redirect('inventory');
        } else {
            $cabang = htmlspecialchars($this->input->post('cabang', true));
            $nama = htmlspecialchars($this->input->post('namaProduk', true));
            $stok = htmlspecialchars($this->input->post('stokProduk', true));
            $beli = htmlspecialchars($this->input->post('hargaBeli', true));
            $jual = htmlspecialchars($this->input->post('hargaJual', true));
            $profit = $jual - $beli;

            $data = [
                'idCabang' => $cabang,
                'namaProduk' => $nama,
                'stokProduk' => $stok,
                'hargaBeli' => $beli,
                'hargaJual' => $jual,
                'profitProduk' => $profit,
                'dateModified' => date('Y-m-d')
            ];

            $this->invent->updateProduk($data);

            $this->session->set_flashdata('produkupd', 'Add new');
            redirect('inventory');
        }
    }

    public function deleteProduk($id)
    {
        $this->invent->deleteProduk($id);
        $this->session->set_flashdata('produkdel', 'dihapus');
        redirect('inventory');
    }


    // ------------------------------ ORDERS ----------------------------------- //
    public function orders()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['emailUser' => $email])->row_array();
        $data['orders'] = $this->invent->getAllOrders($email);
        $data['count'] = $this->invent->countOrders($email);
        $data['total'] = $this->invent->totalOrders($email);
        $data['title'] = 'Orders';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory/orders', $data);
        $this->load->view('templates/footer');
    }

    public function ajaxGetOrder()
    {
        echo json_encode($this->invent->getOrderById($_POST['idJson']));
    }

    public function addOrders()
    {
        $email = $this->session->userdata('email');

        $this->form_validation->set_rules('qty', 'Quantity Produk', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('failform', 'order');
            redirect('inventory');
        } else {
            $id = $this->input->post('idProduks');
            $nama = $this->input->post('produk');
            $stok = $this->input->post('stoky');
            $qty = $this->input->post('qty');
            $date = $this->input->post('date');

            $produk = $this->invent->getProdukById($id);
            $cekProduk = $this->invent->getOrderByIdProduk($id);

            if ($cekProduk < 1) {
                $totalOrder = $qty * $produk['hargaJual'];
                $profitOrder = $qty * $produk['profitProduk'];

                $data = [
                    'idProduk' => $id,
                    'idCabang' => $produk['idCabang'],
                    'email' => $email,
                    'namaBarang' => $nama,
                    'stokBarang' => $stok - $qty,
                    'terjualBarang' => $produk['terjualProduk'] + $qty,
                    'hargaJual' => $produk['hargaJual'],
                    'hargaBeli' => $produk['hargaBeli'],
                    'qtyOrder' => $qty,
                    'totalHarga' => $totalOrder,
                    'profitOrder' => $profitOrder,
                    'status' => 0,
                    'dateCreated' => $date,
                    'dateModified' => 0
                ];

                $this->invent->addOrder($data);

                $this->session->set_flashdata('addorder', $nama);
                redirect('inventory');
            } else {
                $this->session->set_flashdata('failorder', $nama);
                redirect('inventory');
            }
        }
    }

    public function prosesOrder()
    {
        $email = $this->session->userdata('email');
        $orders = $this->invent->getAllOrders($email);

        foreach ($orders as $order) {
            $id = $order['idProduk'];
            $stok = $order['stokBarang'];
            $terjual = $order['terjualBarang'];

            $this->db->set('stokProduk', $stok);
            $this->db->set('terjualProduk', $terjual);
            $this->db->where('idProduk', $id);
            $this->db->update('products');
        }

        $this->invent->setProses();

        $this->session->set_flashdata('prosesorder', 'Proses order');
        redirect('inventory/orders');
    }

    public function cancelOrder()
    {
        $this->invent->deleteAllOrder();

        $this->session->set_flashdata('cancelorder', 'dihapus');
        redirect('inventory/orders');
    }

    public function editOrder()
    {
        $this->form_validation->set_rules('qtyOrder', 'Quantity Produk', 'required|trim');

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('faileditorder', 'Gagal edit');
            redirect('inventory/orders');
        } else {
            $id = $this->input->post('idOrders', true);
            $qty = $this->input->post('qtyOrder', true);
            $stok = $this->input->post('stokBarang', true);
            $total = $this->input->post('totalHarga', true);

            $data = [
                'qtyOrder' => $qty,
                'stokBarang' => $stok,
                'totalHarga' => $total,
                'dateModified' => date('Y-m-d')
            ];

            $this->invent->editOrder($data, $id);

            $this->session->set_flashdata('editorder', 'Berhasil edit');
            redirect('inventory/orders');
        }
    }

    public function deleteOrder($id)
    {
        $this->invent->deleteOrderById($id);

        $this->session->set_flashdata('deleteorder', 'dihapus');
        redirect('inventory/orders');
    }

    // ------------------------------ DEALS -----------------------------------
    public function deals()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['emailUser' => $email])->row_array();
        $data['deals'] = $this->invent->getAllDeals($email);
        $data['count'] = $this->invent->countDeals($email);
        $data['total'] = $this->invent->totalDeals($email);
        $data['title'] = 'Deals';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('inventory/deals', $data);
        $this->load->view('templates/footer');
    }

    // ------------------------------ CABANG -----------------------------------
    public function cabang()
    {
        $email = $this->session->userdata('email');

        $this->load->library('pagination');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');

            $this->session->set_userdata('keyword', $data['keyword']);
            redirect('inventory/cabang');
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $this->db->like('namaCabang', $data['keyword']);
        $this->db->or_like('alamatCabang', $data['keyword']);
        $this->db->or_like('telpCabang', $data['keyword']);
        $this->db->from('cabang');

        $config['total_rows'] = $this->db->count_all_results();
        $config['base_url'] = 'http://localhost:8080/uanq/inventory/cabang';
        $config['num_links'] = 3;
        $config['per_page'] = 5;

        $data['title'] = 'Cabang';
        $data['total_rows'] = $config['total_rows'];
        $data['start'] = $this->uri->segment(3);
        $data['user'] = $this->db->get_where('user', ['emailUser' => $email])->row_array();
        $data['cabang'] = $this->invent->getAllCabang($email, $config['per_page'], $data['start'], $data['keyword']);

        $this->pagination->initialize($config);

        $this->form_validation->set_rules('namaCabang', 'Nama cabang', 'required|trim', ['required' => 'Nama cabang kamu belum di isi!', 'min_length' => 'Password is too short!']);
        $this->form_validation->set_rules('alamatCabang', 'Alamat cabang', 'required|trim', ['required' => 'Alamat cabang kamu belum di isi!']);
        $this->form_validation->set_rules('telpCabang', 'Telephone cabang', 'required|numeric|trim', ['required' => 'Telephone cabang kamu belum di isi!', 'numeric' => 'Kamu hanya boleh memasukan angka saja!']);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('inventory/cabang', $data);
            $this->load->view('templates/footer');
        } else {
            $email = $this->session->userdata('email');
            $nama = $this->input->post('namaCabang');
            $alamat = $this->input->post('alamatCabang');
            $telp = $this->input->post('telpCabang');

            $data = [
                'email' => $email,
                'namaCabang' => $nama,
                'alamatCabang' => $alamat,
                'telpCabang' => $telp
            ];

            $this->invent->addCabang($data);
            $this->session->set_flashdata('cabangadd', $nama);
            redirect('inventory/cabang');
        }
    }

    public function ajaxGetCabang()
    {
        echo json_encode($this->invent->getCabangByid($_POST['idJson']));
    }

    public function editCabang()
    {
        $this->form_validation->set_rules('namaCabang', 'Nama cabang', 'required|trim', ['required' => 'Nama cabang kamu belum di isi!', 'min_length' => 'Password is too short!']);
        $this->form_validation->set_rules('alamatCabang', 'Alamat cabang', 'required|trim', ['required' => 'Alamat cabang kamu belum di isi!']);
        $this->form_validation->set_rules('telpCabang', 'Telephone cabang', 'required|numeric|trim', ['required' => 'Telephone cabang kamu belum di isi!', 'numeric' => 'Kamu hanya boleh memasukan angka saja!']);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('faileditcabang', 'gagal edit');
            redirect('inventory/cabang');
        } else {
            $email = $this->session->userdata('email');
            $id = $this->input->post('idCabang');
            $nama = $this->input->post('namaCabang');
            $alamat = $this->input->post('alamatCabang');
            $telp = $this->input->post('telpCabang');

            $data = [
                'email' => $email,
                'namaCabang' => $nama,
                'alamatCabang' => $alamat,
                'telpCabang' => $telp
            ];

            $this->invent->editCabang($data, $id);
            $this->session->set_flashdata('cabangedit', $nama);
            redirect('inventory/cabang');
        }
    }

    public function deleteCabang($id)
    {
        $this->invent->deleteCabang($id);

        $this->session->set_flashdata('cabangdelete', 'dihapus');
        redirect('inventory/cabang');
    }
}

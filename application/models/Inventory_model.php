<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Controller admin yang menglola admin page
class Inventory_model extends CI_Model
{
    // ------------------------------ PRODUCTS -----------------------------------
    public function getAllProduk($email, $limit, $start, $keyword)
    {
        $sql = "SELECT pr.*, cb.namaCabang FROM products pr JOIN cabang cb USING (idCabang) WHERE pr.email = '{$email}'";
        if ($keyword) {
            $sql .= " AND pr.namaProduk LIKE '%$keyword%'";
        }
        $sql .= " ORDER BY pr.idProduk DESC LIMIT {$limit}";
        if ($start) {
            $sql .= ", {$start}";
        }

        return $this->db->query($sql)->result_array();
    }

    public function getProdukByCabang($cabid, $limit, $start, $keyword)
    {
        $sql = "SELECT pr.*, cb.namaCabang FROM products pr JOIN cabang cb USING (idCabang) WHERE pr.idCabang = '{$cabid}'";
        if ($keyword) {
            $sql .= " AND pr.namaProduk LIKE '%$keyword%'";
        }
        $sql .= " ORDER BY pr.idProduk DESC LIMIT {$limit}";
        if ($start) {
            $sql .= ", {$start}";
        }

        return $this->db->query($sql)->result_array();
    }

    public function getCabang($email)
    {
        return $this->db->get_where('cabang', ['email' => $email])->result_array();
    }

    public function getProdukById($id)
    {
        return $this->db->get_where('products', ['idProduk' => $id])->row_array();
    }

    public function addProduk($data)
    {
        $this->db->insert('products', $data);
    }

    public function updateProduk($data)
    {
        $id = $this->input->post('idProduk');

        $this->db->where('idProduk', $id);
        $this->db->update('products', $data);
    }

    public function deleteProduk($id)
    {
        $this->db->delete('products', ['idProduk' => $id]);
    }


    // ------------------------------ ORDERS -----------------------------------
    public function getAllOrders($email)
    {
        return $this->db->get_where('orders', ['email' => $email, 'status' => 0])->result_array();
    }

    public function getOrderById($id)
    {
        return $this->db->get_where('orders', ['idOrder' => $id])->row_array();
    }

    public function getOrderByIdProduk($id)
    {
        return $this->db->get_where('orders', ['idProduk' => $id, 'status' => 0])->row_array();
    }

    public function countOrders($email)
    {
        return $this->db->get_where('orders', ['email' => $email, 'status' => 0])->num_rows();
    }

    public function totalOrders($email)
    {
        $this->db->select_sum('totalHarga');
        $this->db->where('status', 0);
        $this->db->where('email', $email);
        $result = $this->db->get('orders')->row();

        return $result->totalHarga;
    }

    public function addOrder($data)
    {
        $this->db->insert('orders', $data);
    }

    public function setProses()
    {
        $this->db->set('status', 1);
        $this->db->where('status', 0);
        $this->db->update('orders');
    }

    public function editOrder($data, $id)
    {
        $this->db->where('idOrder', $id);
        $this->db->update('orders', $data);
    }

    public function deleteAllOrder()
    {
        $this->db->delete('orders', ['status' => 0]);
    }

    public function deleteOrderById($id)
    {
        $this->db->delete('orders', ['idOrder' => $id]);
    }

    // ------------------------------ CABANG -----------------------------------
    public function getAllCabang($email, $limit, $start, $keyword)
    {
        if ($keyword) {
            $this->db->like('namaCabang', $keyword);
            $this->db->or_like('alamatCabang', $keyword);
            $this->db->or_like('telpCabang', $keyword);
        }

        return $this->db->get_where('cabang', ['email' => $email], $limit, $start)->result_array();
    }

    public function getCabangById($id)
    {
        return $this->db->get_where('cabang', ['idCabang' => $id])->row_array();
    }

    public function addCabang($data)
    {
        $this->db->insert('cabang', $data);
    }

    public function editCabang($data, $id)
    {
        $this->db->where('idCabang', $id);
        $this->db->update('cabang', $data);
    }

    public function deleteCabang($id)
    {
        $this->db->delete('cabang', ['idCabang' => $id]);
    }
}

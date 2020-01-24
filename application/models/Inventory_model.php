<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Controller admin yang menglola admin page
class Inventory_model extends CI_Model
{
    public function getAllProduk($email)
    {
        return $this->db->order_by('idProduk', 'DESC')->get_where('products', ['email' => $email])->result_array();
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
        return $this->db->affected_rows();
    }
}

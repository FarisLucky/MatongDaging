<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_konsumen extends CI_Model
{
    public $image = "default.jpg";

    public function getData($tb) //untuk ngambil type
    {
        return $this->db->get($tb);
    }

    public function getSelectionData($table,$where)
    {
        $data = $this->db->get_where($table, $where);
        return $data;
    }

    public function updateDataKonsumen($data, $id)
    {
        $this->db->update('konsumen', $data, ['id_konsumen' => $id]); 
    }

    public function delete($table,$where)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function insertDataKonsumen($table,$data)
    {
        $this->db->insert($table, $data);
    }
}

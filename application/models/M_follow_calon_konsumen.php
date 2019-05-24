<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_follow_calon_konsumen extends CI_Model
{
    public function ambildata()
    {
        // mysqli_query ("select * from barang where kode_barang='.$kode_barang'")
        return $this->db->get('follow_calon_konsumen');
    }

    public function delete($id)
    {
        $input = ['id_follow' => $id['id_follow']];
        $this->db->where($input);
        $this->db->delete('follow_calon_konsumen');
    }

    public function getSelectionData($id)
    {
        $data = $this->db->get_where('follow_calon_konsumen', ['id_follow' => $id]);
        return $data->result_array();
    }
    /*public function getData($tb) //untuk ngambil type
    {
        return $this->db->get($tb);
    }

    public function getSelectionData($id)
    {
        $data = $this->db->get_where('konsumen', ['id_konsumen' => $id]);
        return $data->result_array();
    }

    public function updateDataKonsumen($data, $id)
    {
        $this->db->update('konsumen', $data, ['id_konsumen' => $id]); //WHERE id_konsumnen = $id
    }

    
    public function insertDataKonsumen($data)
    {
        $this->db->insert("konsumen", $data);
    }*/
}

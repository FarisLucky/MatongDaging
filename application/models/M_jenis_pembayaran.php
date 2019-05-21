<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_jenis_pembayaran extends CI_Model
{
    public function ambildata()
    {
        // mysqli_query ("select * from barang where kode_barang='.$kode_barang'")
        return $this->db->get('jenis_pembayaran');
    }

    public function getSelectionData($id)
    {
        $data = $this->db->get_where('jenis_pembayaran', ['id_jenis' => $id]);
        return $data->result_array();
    }

    public function updateDataProduk($data)
    {
        $this->db->where(['id_jenis' => $data['id_jenis']]);
        $this->db->update('jenis_pembayaran', $data);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_follow_calon_konsumen extends CI_Model
{
    public function ambildata()
    {
        // mysqli_query ("select * from barang where kode_barang='.$kode_barang'")
        return $this->db->get('follow_up');
    }

    public function getAll()
    {
        $result = $this->db->query("SELECT f.*, k.nama_lengkap,user.nama_lengkap as pembuat FROM follow_up f JOIN konsumen k ON k.id_konsumen = f.id_konsumen INNER JOIN user on user.id_user = f.id_user")->result();
        return $result;
    }

    function getData()
    {
        $query = $this->db->query('SELECT * FROM konsumen where status_konsumen = "calon konsumen"');
        return $query->result_array();
    }

    public function insertDataFollow($data)
    {
        $this->db->insert("follow_up", $data);
    }

    public function delete($id)
    {
        $input = ['id_follow' => $id['id_follow']];
        $this->db->where($input);
        $this->db->delete('follow_up');
    }

    public function getSelectionData($where)
    {
        return $this->db->get_where('follow_up', $where)->row_array();
    }

    public function updateDatafollow($data) //edit
    {
        $this->db->where('id_follow', $this->input->post('edit_id_follow'));
        $this->db->update('follow_calon_konsumen', $data);
    }
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_unit_properti extends CI_Model {

    public function getBlok($id)
    {
        return $this->db->get_where('blok',['id_properti'=>$id])->result();
    }
    public function getBlokWithId($id,$id_properti)
    {
        $query = $this->db->get_where('blok',['id_blok'=>$id,'id_properti'=>$id_properti]);
        return $query->row();
    }
    public function getUnitWithId($id)
    {
        $query = $this->db->get_where('unit_properti',['id_unit'=>$id]);
        return $query->row();
    }
    public function getImage($id)
    {
        $this->db->select('foto_unit');
        $query = $this->db->get_where('unit_properti',['id_unit'=>$id]);
        return $query->row();
    }
    public function insertBlok($params)
    {
        $query = $this->db->insert('blok',['nama_blok'=>$params['nama'],'id_properti'=>$params['id_properti']]);
        return $this->db->affected_rows();
    }
    public function insertUnit($params)
    {
        $data = ['nama_unit'=>$params['nama'],'type'=>$params['type'],'luas_tanah'=>$params['tanah'],'luas_bangunan'=>$params['bangunan'],'harga_unit'=>$params['harga'],'alamat_unit'=>$params['alamat'],'foto_unit'=>$params['img'],'deskripsi'=>$params['deskripsi'],'tgl_insert'=>date("Y-m-d"),"id_user"=>$this->session->userdata('id_user'),'id_properti'=>1,"status_unit"=>"belum terjual"];
        $query = $this->db->insert('unit_properti',$data);
        return $this->db->affected_rows();
    }
    public function updateBlok($params)
    {
        $this->db->where('id_blok', $params['id_blok']);
        $query = $this->db->update('blok',['nama_blok'=>$params['nama']]);
        return $this->db->affected_rows();
    }
    public function deleteBlok($params)
    {
        $this->db->where('id_blok', $params['id_blok']);
        $query = $this->db->delete('blok');
        return $this->db->affected_rows();
    }

}

/* End of file Model_unit_properti.php */

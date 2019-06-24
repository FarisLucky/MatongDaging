<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_unit_properti extends CI_Model {

    public function getUnitWithId($id)
    {
        $query = $this->db->get_where('unit_properti',['id_unit'=>$id]);
        return $query->row();
    }
    public function getImage($id)
    {
        $this->db->select('foto_unit');
        return $this->db->get_where('unit_properti',['id_unit'=>$id])->row();
    }
    public function getData($select,$tbl,$where = null,$order = null,$order_by = null)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        if ($where != null) {
            $this->db->where($where);
        }
        if ($order != null) {
            $this->db->order_by($order,$order_by);
        }
        return $this->db->get();
    }
    public function insertUnit($params)
    {
        $data = ['nama_unit'=>$params['nama'],'type'=>$params['type'],'luas_tanah'=>$params['tanah'],'luas_bangunan'=>$params['bangunan'],'harga_unit'=>$params['harga'],'alamat_unit'=>$params['alamat'],'foto_unit'=>$params['img'],'deskripsi'=>$params['deskripsi'],'tgl_insert'=>date("Y-m-d"),"id_user"=>$this->session->userdata('id_user'),'id_properti'=>$this->session->userdata('id_properti'),"status_unit"=>"belum terjual"];
        $query = $this->db->insert('unit_properti',$data);
        return $this->db->affected_rows();
    }
    public function updateUnit($params)
    {
        if ($params['img'] == "") {
            $data = ['nama_unit'=>$params['nama'],'type'=>$params['type'],'luas_tanah'=>$params['tanah'],'luas_bangunan'=>$params['bangunan'],'harga_unit'=>$params['harga'],'alamat_unit'=>$params['alamat'],'deskripsi'=>$params['deskripsi']];
        }else{
            $data = ['nama_unit'=>$params['nama'],'type'=>$params['type'],'luas_tanah'=>$params['tanah'],'luas_bangunan'=>$params['bangunan'],'harga_unit'=>$params['harga'],'alamat_unit'=>$params['alamat'],'foto_unit'=>$params['img'],'deskripsi'=>$params['deskripsi']];
        }
        $this->db->where('id_unit', $params['id']);
        $query = $this->db->update('unit_properti',$data);
        return $query;
    }
    public function hapusData($params)
    {
        $this->db->delete('unit_properti',['id_unit'=>$params]);
        return $this->db->affected_rows();
    }
    public function getJumlahUnit($id)
    {
        $query = "call getJumlahUnit(?,@jumlah);";
        $fetch = $this->db->query($query,[$id]);
        $select = $this->db->query('select @jumlah as jumlah');
        return $select->row();
    }
    public function getJumlahProperti($id)
    {
        $query = "call getJumlahProperti(?,@jumlah);";
        $fetch = $this->db->query($query,[$id]);
        $select = $this->db->query("select @jumlah as jumlah");
        return $select->row();
    }
}

/* End of file Model_unit_properti.php */

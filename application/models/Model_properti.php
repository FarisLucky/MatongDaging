<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Model_properti extends CI_Model {
    
    private $tbl = "tbl_properti";
    public function getDataProperti($val)
    {
        return $this->db->get_where("tbl_properti",['id_properti'=>$val])->row();
    }

    public function getDataWhere($select,$tbl,$where,$column_order = null,$type_order = null)
    {
        $this->db->select($select);
        $this->db->where($where);
        if (($column_order != null) && ($type_order != null)) {
            $this->db->order_by($column_order, $type_order);
        }
        return $this->db->get($tbl);
    }
    public function updateData($data,$tbl,$where)
    {
        $this->db->where($where);
        $val =  $this->db->update($tbl,$data);
        return $this->db->affected_rows();
    }

    public function getImage($params)
    {
        $this->db->select('logo_properti,foto_properti');
        return $this->db->get_where($this->tbl,['id_properti'=>$params])->row();
    }

    public function hapusData($pars)
    {
        $this->db->where('id_properti', $pars);
        $this->db->delete('properti');
        return $this->db->affected_rows();
    }
    public function publishData($pars)
    {
        $this->db->where('id_properti', $pars);
        $this->db->update('properti',['status'=>"publish"]);
        return $this->db->affected_rows();
    }
    public function naturalInsert($table,$data)
    {
        $this->db->insert($table,$data);
        return $this->db->affected_rows();
    }
    public function insertData($data,$tbl)
    {
        $this->db->insert($tbl,$data);
        return $this->db->affected_rows();
    }
}

/* End of file Model_properti.php */

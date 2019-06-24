<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Model_api extends CI_Model {

    public function getData($select,$tbl,$where = null,$order=null,$order_by=null)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        if ($where != null) {
            $this->db->where($where);
        }
        if ($order != null) {
            $this->db->order_by($order, $order_by);
        }
        return $this->db->get();
    }

    public function updateData($data,$tbl,$where)
    {
        $this->db->update($tbl,$data,$where);
        return $this->db->affected_rows();
    }
    public function insertData($data,$tbl)
    {
        $this->db->insert($tbl,$data);
        return $this->db->affected_rows();
    }
    
}

/* End of file Model_api.php */

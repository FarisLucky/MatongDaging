<?php 
 
class Model_crud extends CI_Model{
	
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
    public function insertData($data,$tbl)
    {
        $this->db->insert($tbl, $data);
        return $this->db->affected_rows();
    }
    public function updateData($column,$tbl,$where)
    {
        $this->db->where($where);
        $this->db->update($tbl, $column);
        return $this->db->affected_rows();
    }
    public function deleteData($tbl,$where)
    {
        $this->db->where($where);
        $this->db->delete($tbl);
        return $this->db->affected_rows();
    }
}
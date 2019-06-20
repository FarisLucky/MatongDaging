<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Model_laporan extends CI_Model {

    public function getData($tbl)
    {
        return $this->db->get($tbl);
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
    public function updateData($column,$tbl,$where)
    {
        $this->db->where($where);
        $this->db->update($tbl, $column);
        return $this->db->affected_rows();
    }
}

/* End of file Laporan_model.php */

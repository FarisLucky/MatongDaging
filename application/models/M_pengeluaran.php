<?php 
 
class M_pengeluaran extends CI_Model{
	
	public function getData($select,$tbl)
    {
		$this->db->select($select);
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
	function input_data($data,$table)
	{
	$this->db->insert($table,$data);
	}
	function hapus_data($where,$table)
	{
	$this->db->where($where);
	$this->db->delete($table);
	return $this->db->affected_rows();
	
	}
	function edit_data($where,$table)
	{		
	return $this->db->get_where($table,$where);
	}
	function update_data($where,$data,$table)
	{
	$this->db->where($where);
	$this->db->update($table,$data);
	}
}
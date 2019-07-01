<?php 
 
class Model_rab extends CI_Model{
	function __construct()
	{
	parent::__construct();
	}
	function getData($table)
	{
		return $this->db->get($table);
	}
	public function getDataWhere($tbl,$whr)
	{
		return $this->db->get_where($tbl,$whr);
	}
	public function insert_data($table,$data)
	{
		return $this->db->insert($table,$data);
	}
	public function hapus_data($where,$table)
	{
	$this->db->where($where);
	$this->db->delete($table);
	}
	public function update_data($table,$data,$where)
	{
	$this->db->where($where);
	$this->db->update($table,$data);
	return $this->db->affected_rows();
	
	}
	public function getTotalSum($select,$where,$table)
	{
		$this->db->select_sum($select);
		$this->db->where($where);
		return $this->db->get($table);
	}
}
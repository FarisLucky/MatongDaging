<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Model_approve extends CI_Model 
{

    public function getDataWhere($select,$tbl,$where,$order = null ,$ord_by = null)
    {
        $this->db->select($select);
        $this->db->from($tbl);
        $this->db->where($where);
        if ((!empty($order)) && (!empty($ord_by))) {
            $this->db->order_by($order, $ord_by);
        }
        return $this->db->get();
    }
    public function updateData($column,$tbl,$where)
    {
        $this->db->where($where); 
        $this->db->update($tbl,$column);
        return $this->db->affected_rows();
        
    }
    public function getData($params)
    {
        $this->db->where('id_transaksi',$params);
        return $this->db->get('tbl_transaksi')->row();
    }
    public function getDataPembayaran($params)
    {
        return $this->db->get_where('tbl_pembayaran',['id_transaksi'=>$params,'status'=>'selesai'])->result();
    }
    public function getHutang($transaksi,$jenis)
    {
        $query = $this->db->query('call getHutangUm(?,?)',[$transaksi,$jenis]);
        $val = $query->row();
        // Setting free_db_resource on /system/database/drivers/mysqli/mysqli_driver.php;
        $this->db->free_db_resource();
        return $val;
    }
    public function getBayar($transaksi,$jenis)
    {
        $sql ='call getBayarUm(?,?)';
        $query = $this->db->query('call getBayarUm(?,?)',[$transaksi,$jenis]);
        $val = $query->row();
        // Setting free_db_resource on /system/database/drivers/mysqli/mysqli_driver.php;
        $this->db->free_db_resource();
        return $val;
    }
}

/* End of file Model_approve.php */

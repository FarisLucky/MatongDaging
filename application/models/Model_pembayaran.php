<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pembayaran extends CI_Model 
{
    public function getData($column,$tbl,$where)
    {
        return $this->db->select($column)->from($tbl)->where($where)->get();
    }
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
        $this->db->update($tbl, $column);
        return $this->db->affected_rows();
    }
    public function getCicilantrans($params,$jenis)
    {
        $where = ['id_transaksi'=>$params,'id_type_bayar'=>$jenis];
        $this->db->where($where);
        return $this->db->get('pembayaran_transaksi')->result();
    }

    // For All on Pembayaran
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

/* End of file ModelName.php */

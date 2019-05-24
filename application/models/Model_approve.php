<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Model_approve extends CI_Model {

    public function getPembayaran(  )
    {
        return $this->db->get_where('tbl_pembayaran',['status'=>'pending'])->result();
    }
    public function getAllTransaksi($id)
    {
        return $this->db->get_where('tbl_transaksi',['id_transaksi'=>$id])->row();
    }
    public function setConfirm($params)
    {
        $this->db->where('id_pembayaran', $params); 
        $this->db->update('pembayaran_transaksi',['status'=>'selesai']);
        return $this->db->affected_rows();
        
    }
    public function getDataApprove($params)
    {
        return $this->db->get_where('tbl_pembayaran',['id_pembayaran'=>$params])->row();
    }
    public function getTransaksi()
    {
        return $this->db->get_where('tbl_transaksi',['status_transaksi'=>'lunas'])->result();
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
    public function getDetailTransaksi($params)
    {
        return $this->db->get_where('detail_transaksi',['id_transaksi'=>$params])->result();
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

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pembayaran extends CI_Model 
{
    // Pembayaran Tanda Jadi
    public function getHarga($params)
    {
        $this->db->select('total_tagihan');
        $query =  $this->db->get_where('pembayaran_transaksi',['id_transaksi'=>$params['id_transaksi'],'id_jenis'=>$params['id_jenis']]);
        return $query->row();
    }
    public function update_tanda_jadi($params)
    {
        $object = ['tgl_bayar'=>$params['tgl'],'jumlah_bayar'=>$params['bayar'],'bukti_bayar'=>$params['img'],'status'=>'pending'];
        $where = ['id_transaksi'=>$params['id'],'id_jenis'=>$params['id_jenis']];
        $this->db->where($where);
        $this->db->update('pembayaran_transaksi',$object);
        return $this->db->affected_rows();
        
    }
    public function update_transaksi($params)
    {
        $this->db->where('id_transaksi',$params);
        $this->db->update('transaksi_unit',['status_transaksi'=>'progress']);
    }

    // Pembayaran Uang Muka
    public function getModalUm($params)
    {
        return $this->db->get_where('pembayaran_transaksi',['id_pembayaran'=>$params])->row_array();
    }
    public function update_uang_muka($params)
    {
        $object = ['tgl_bayar'=>$params['tgl'],'jumlah_bayar'=>$params['bayar'],'bukti_bayar'=>$params['img'],'status'=>'pending','hutang'=>$params['hutang']];
        $where = ['id_pembayaran'=>$params['id']];
        $this->db->where($where);
        $this->db->update('pembayaran_transaksi',$object);
        return $this->db->affected_rows();
        
    }

    // Pembayaran Cicilan
    public function getCicilantrans($params,$jenis)
    {
        $where = ['id_transaksi'=>$params,'id_type_bayar'=>$jenis];
        $this->db->where($where);
        return $this->db->get('pembayaran_transaksi')->result();
    }

    // For All on Pembayaran
    public function getData($params)
    {
        $this->db->select('nama_lengkap,periode_uang_muka,uang_muka,pembayaran,total_akhir,bayar_periode,type_pembayaran');
        $this->db->where('id_transaksi',$params);
        return $this->db->get('tbl_transaksi')->row();
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
    public function getTotalTgh($params)
    {
        return $this->db->get_where('tbl_pembayaran',['id_pembayaran'=>$params])->row_array();
    }
    public function getListPembayaran($params,$jenis)
    {
        $where = ['id_transaksi'=>$params,'id_jenis'=>$jenis];
        $this->db->where($where);
        return $this->db->get('tbl_pembayaran')->result();
    }
}

/* End of file ModelName.php */

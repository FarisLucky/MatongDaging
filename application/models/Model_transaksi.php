<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_transaksi extends CI_Model {

    public function getKonsumen()
    {
        return $this->db->get_where('tbl_konsumen',['status_konsumen'=>'calon konsumen'])->result();
    }
    public function getType()
    {
        return $this->db->get('type_bayar')->result_array();
    }
    public function getUnit($id)
    {
        return $this->db->get_where('tbl_unit_properti',['id_properti'=>$id,'status_unit'=>'belum terjual'])->result();
    }
    public function getKonsumenId($id)
    {
        $query = $this->db->get_where('tbl_konsumen',['id_konsumen'=>$id]);
        return $query;
    }
    public function getUnitId($id)
    {
        $query = $this->db->get_where('tbl_unit_properti',['id_unit'=>$id]);
        return $query;
    }
    public function tambahtransaksi($params)
    {
        $data = [
            'no_ppjb'=>$params['no_ppjb'],
            'id_konsumen'=>$params['konsumen'],
            'id_unit'=>$params['unit'],
            'tgl_transaksi'=>date('Y-m-d'),
            'total_transaksi'=>$params['total_transaksi'],
            'total_kesepakatan'=>$params['kesepakatan'],
            'total_akhir'=>$params['total_akhir'],
            'tanda_jadi'=>$params['tanda_jadi'],
            'uang_muka'=>$params['uang_muka'],
            'periode_uang_muka'=>$params['periode_uang_muka'],
            'id_type_bayar'=>$params['type_pembayaran'],
            'bayar_periode'=>$params['periode_bayar'],
            'pembayaran'=>$params['total_bayar_periode'],
            'status_transaksi'=>'pending',
            'persetujuan_manager'=>'pending',
            'tempo_tanda_jadi'=>$params['tgl_tanda_jadi'],
            'tempo_uang_muka'=>$params['tgl_uang_muka'],
            'tempo_bayar'=>$params['tgl_pembayaran'],
            'total_tambahan'=>$params['total_tambahan'],
            'id_user'=>$this->session->userdata('id_user')
        ];
        $this->db->insert('transaksi_unit', $data);
        return $this->db->affected_rows();
    }
    public function insertDetail($params)
    {
        $object = ['penambahan'=>$params['penambahan'],'volume'=>$params['volume'],'satuan'=>$params['satuan'],'harga'=>$params['harga'],'id_transaksi'=>$params['transaksi']];
        $this->db->insert('detail_transaksi', $object);
        return $this->db->affected_rows();
    }
    public function insertAngsuranUangMuka($params)
    {
        $object = ['id_transaksi'=>$params['id_transaksi'],'nama_pembayaran'=>$params['nama_pembayaran'],'total_tagihan'=>$params['total_tagihan'],'tgl_jatuh_tempo'=>$params['tgl_jatuh_tempo'],'hutang'=>$params['hutang'],'status'=>$params['status'],'id_user'=>$params['id_user'],'id_jenis'=>$params['id_jenis']];
        $this->db->insert('pembayaran_transaksi', $object);
        return $this->db->affected_rows();
    }
    public function insertPembayaranTransaksi($params)
    {
        $object = ['id_transaksi'=>$params['id_transaksi'],'nama_pembayaran'=>$params['nama_pembayaran'],'total_tagihan'=>$params['total_tagihan'],'tgl_jatuh_tempo'=>$params['tgl_jatuh_tempo'],'hutang'=>$params['hutang'],'status'=>$params['status'],'id_user'=>$params['id_user'],'id_jenis'=>$params['id_jenis'],'id_type_bayar'=>$params['id_type_bayar']];
        $this->db->insert('pembayaran_transaksi', $object);
        return $this->db->affected_rows();
    }
    public function calonToKonsumen($params)
    {
        $object = ['status_konsumen'=>"konsumen"];
        $this->db->where('id_konsumen', $params);
        return $this->db->update('konsumen', $object);
    }
    public function unitToTerjual($params)
    {
        $object = ['status_unit'=>'sudah terjual'];
        $this->db->where('id_unit', $params);
        return $this->db->update('unit_properti', $object);
    }
    public function getNameUnit($params)
    {
        $this->db->select('nama_unit');
        $this->db->where('id_unit', $params);
        return $this->db->get('unit_properti')->row();
    }
}

/* End of file Model_transaksi.php */

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
    public function getListTransaksi($params)
    {
        $wh = ['id_properti'=>$params['id_properti'],'id_user'=>$params['id_user']];
        $this->db->where($wh);
        $this->db->order_by('id_transaksi', 'desc');
        $query = $this->db->get('tbl_transaksi');
        return $query->result();
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
    public function getDetailId($id)
    {
        $query = $this->db->get_where('detail_transaksi',['id_transaksi'=>$id]);
        return $query;
    }
    public function tambahtransaksi($params)
    {
        $data = $this->input($params);
        $data['tgl_transaksi'] = date('Y-m-d');
        $this->db->insert('transaksi_unit', $data);
        return $this->db->affected_rows();
    }
    public function ubahTransaksi($params,$where)
    {
        $data = $this->input($params);
        $key_where = ['id_transaksi'=>$where];
        $this->db->where($key_where);
        $this->db->update('transaksi_unit', $data);
        return $this->db->affected_rows();
    }
    public function insertDetail($params)
    {
        $object = ['penambahan'=>$params['penambahan'],'volume'=>$params['volume'],'satuan'=>$params['satuan'],'harga'=>$params['harga'],'total_harga'=>$params["total"],'id_transaksi'=>$params['transaksi']];
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
    public function getDetail($params)
    {
        $query = $this->db->get_where('tbl_transaksi',['id_transaksi'=>$params]);
        return $query->row();
    }
    private function input($params)
    {
        return [
            'no_ppjb'=>$params['no_ppjb'],
            'id_konsumen'=>$params['konsumen'],
            'id_unit'=>$params['unit'],
            'total_transaksi'=>$params['total_transaksi'],
            'total_kesepakatan'=>$params['kesepakatan'],
            'total_akhir'=>$params['total_akhir'],
            'tanda_jadi'=>$params['tanda_jadi'],
            'uang_muka'=>$params['uang_muka'],
            'periode_uang_muka'=>$params['periode_uang_muka'],
            'id_type_bayar'=>$params['type_pembayaran'],
            'bayar_periode'=>$params['periode_bayar'],
            'pembayaran'=>$params['total_bayar_periode'],
            'status_transaksi'=>'sementara',
            'kunci'=>'default',
            'tempo_tanda_jadi'=>$params['tgl_tanda_jadi'],
            'tempo_uang_muka'=>$params['tgl_uang_muka'],
            'tempo_bayar'=>$params['tgl_pembayaran'],
            'total_tambahan'=>$params['total_tambahan'],
            'id_user'=>$this->session->userdata('id_user')
        ];
    }
    public function deleteData($table,$where)
    {
        return $this->db->delete($table,$where);
    }
    public function updateData($data,$table,$where)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
        return $this->db->affected_rows();
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
}

/* End of file Model_transaksi.php */

<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Model_properti extends CI_Model {
    
    private $tbl = "tbl_properti";
    public function getDataProperti($val)
    {
        return $this->db->get_where("tbl_properti",['id_properti'=>$val])->row();
    }

    public function updateDataProperti($params)
    {
        if (($params['logo'] != "") && ($params['foto'] != "")) {
            $data = ['nama_properti'=>$params['nama'],'alamat'=>$params['alamat'],'luas_tanah'=>$params['luas'],'jumlah_unit'=>$params['jumlah'],'rekening'=>$params['rekening'],'tgl_buat'=>date('Y-m-d'),'status'=>$params['status'],"foto_properti"=>$params['foto'],"logo_properti"=>$params['logo'],"setting_spr"=>$params['spr']];
        }
        elseif ($params['logo'] != "") {
            $data = ['nama_properti'=>$params['nama'],'alamat'=>$params['alamat'],'luas_tanah'=>$params['luas'],'jumlah_unit'=>$params['jumlah'],'rekening'=>$params['rekening'],'tgl_buat'=>date('Y-m-d'),'status'=>$params['status'],"logo_properti"=>$params['logo'],"setting_spr"=>$params['spr']];
        }
        elseif($params['foto'] != ""){
            $data = ['nama_properti'=>$params['nama'],'alamat'=>$params['alamat'],'luas_tanah'=>$params['luas'],'jumlah_unit'=>$params['jumlah'],'rekening'=>$params['rekening'],'tgl_buat'=>date('Y-m-d'),'status'=>$params['status'],"foto_properti"=>$params['foto'],"setting_spr"=>$params['spr']];
        }
        else{
            $data = ['nama_properti'=>$params['nama'],'alamat'=>$params['alamat'],'luas_tanah'=>$params['luas'],'jumlah_unit'=>$params['jumlah'],'rekening'=>$params['rekening'],'tgl_buat'=>date('Y-m-d'),'status'=>$params['status'],"setting_spr"=>$params['spr']];
        }
        $this->db->where('id_properti', $params['id']);
        $val =  $this->db->update($this->tbl,$data);
        return $this->db->affected_rows();
    }

    public function getImage($params)
    {
        $this->db->select('logo_properti,foto_properti');
        return $this->db->get_where($this->tbl,['id_properti'=>$params])->row();
    }

    public function hapusData($pars)
    {
        $this->db->where('id_properti', $pars);
        $this->db->delete('properti');
        return $this->db->affected_rows();
    }
    public function publishData($pars)
    {
        $this->db->where('id_properti', $pars);
        $this->db->update('properti',['status'=>"publish"]);
        return $this->db->affected_rows();
    }
    public function insertDataProperti($input)
    {
        $data = $this->m_input($input);
        $this->db->insert("properti",$data);
        return $this->db->affected_rows();
    }
    private function m_input($params)
    {
        $data = [
            'nama_properti'=>$params['nama'],'alamat'=>$params['alamat'],'luas_tanah'=>$params['luas'],'jumlah_unit'=>$params['jumlah'],'rekening'=>$params['rekening'],'logo_properti'=>$params['logo'],'foto_properti'=>$params['foto'],'tgl_buat'=>date('Y-m-d'),'status'=>$params['status'],"setting_spr"=>$params['spr']
        ];
        return $data;
    }
}

/* End of file Model_properti.php */

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_profil_perusahaan extends CI_Model {
    private $table = 'data_perusahaan';
    public function updateData($param,$where)
    {
        if ($param['img'] != '') {
            $data = ['siup'=>$param['siup'],'tanda_daftar_perusahaan'=>$param['tdp'],'nama'=>$param['nama'],'email'=>$param['email'] ,'telepon'=>$param['telp'] ,'alamat'=>$param['alamat'],'logo_perusahaan'=>$param['img']
            ];
        }else{
            $data = ['siup'=>$param['siup'],'tanda_daftar_perusahaan'=>$param['tdp'],'nama'=>$param['nama'],'email'=>$param['email'] ,'telepon'=>$param['telp'] ,'alamat'=>$param['alamat']
            ];
        }
        $this->db->where('id_perusahaan', $where);
        $this->db->update($this->table, $data);
    }
    public function getLogo($p)
    {
        $this->db->select('logo_perusahaan');
        $val = $this->db->get_where($this->table,['id_perusahaan'=>$p]);
        return $val->result_array();
    }
    public function getPerusahaan()
    {
        $this->db->order_by('id_perusahaan', 'asc');
        $val = $this->db->get($this->table,1);
        return $val->result_array();
    }

}

/* End of file ModelName.php */

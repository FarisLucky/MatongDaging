<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kelola_user extends CI_Model {

    private $table="user_assign_properti";
    public function getUser()
    {
        return $this->db->query('select * from tbl_users')->result();
    }
    public function getUserWhereId($id)
    {
        $sql = 'select * from tbl_users where id_user = ?';
        $value = $this->db->query($sql,[$id]);
        return $value->row();
    }
    public function userStatus($params)
    {
        $input = ['status_user'=>$params['values']];
        $this->db->where('id_user', $params['where']);
        return $this->db->update('user',$input);
    }
    public function getProperti()
    {
        $sql = "select id_properti,nama_properti,foto_properti from tbl_properti";
        return $this->db->query($sql)->result();
    }
    public function insertUserProperti($params)
    {
        $this->db->insert($this->table,['id_properti'=>$params['id_properti'],'id_user'=>$params['id_user']]);
        return $this->db->affected_rows();
    }
    public function getUserProperti($id)
    {
        $val = $this->db->get_where($this->table,['id_User'=>$id]);
        return $val->row();
    }
    public function hapus($id)
    {
        $this->db->where('id_user', $id);
        $hapus = $this->db->delete('user');
        if ($hapus) {
            return true;
        }
        else{
            return false;
        }
    }
    public function getAkses()
    {
        return $this->db->get('user_role')->result();
    }
    public function insertUser($input)
    {
        if ($input['img'] = "") {
            $data = ['nama_lengkap'=>$input['nama'],'jenis_kelamin'=>];
        }
    }
}

/* End of file Model_kelola_user.php */

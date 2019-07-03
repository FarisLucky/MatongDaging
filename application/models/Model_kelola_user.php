<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Model_kelola_user extends CI_Model {

    private $table="user_assign_properti";

    public function getDataWhere($select,$tbl,$where,$column_order = null,$type_order = null)
    {
        $this->db->select($select);
        $this->db->where($where);
        if (($column_order != null) && ($type_order != null)) {
            $this->db->order_by($column_order, $type_order);
        }
        return $this->db->get($tbl);
    }
    public function updateData($data,$tbl,$where)
    {
        $this->db->update($tbl,$data, $where);
        return $this->db->affected_rows();
    }
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
    public function insertUserProperti($id_user,$id_properti)
    {
        $this->db->insert($this->table,['id_properti'=>$id_properti,'id_user'=>$id_user]);
        return $this->db->affected_rows();
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
    public function deleteAssignProperti($id)
    {
        $result = $this->db->delete($this->table,['id_user'=>$id]);
        return $this->db->affected_rows();
    }
    public function getAssignProperti($id_user,$id_properti)
    {
        $result = $this->db->get_where($this->table,['id_properti'=>$id_properti,'id_user'=>$id_user]);
        return $result->num_rows();
    }
    public function insertUser($input)
    {
        $sql ="call insert_user(?,?,?,?,?,?,?,?,?,?)";
        $data = ['nama_lengkap'=>$input['nama'],'jenis_kelamin'=>$input['jk'],"alamat"=>$input['alamat'],"no_hp"=>$input['telp'],"Email"=>$input['email'],"username"=>$input['username'],"password"=>$input['password'],"id_akses"=>$input['akses'],"foto_user"=>$input['img'],'status_user'=>$input['status']];
        $value = $this->db->query($sql,$data);
        return $this->db->affected_rows();
        
    }
    public function insertData($data,$tbl)
    {
        $this->db->insert($tbl, $data);
        return $this->db->affected_rows();
    }
}

/* End of file Model_kelola_user.php */

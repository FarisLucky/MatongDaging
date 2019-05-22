<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_auth extends CI_Model {

    public function getUser($input)
    {
        $getUser = $this->db->get_where('user',['username'=>$input['username']]);
        return $getUser;
    }
    public function getPropertiAssign($input)
    {
        $getUser = $this->db->get_where('user_assign_properti',['id_user'=>$input]);
        return $getUser;
    }
    public function getPropertiWithId($input)
    {
        $getUser = $this->db->get_where('tbl_properti',['id_properti'=>$input]);
        return $getUser->row();
    }

}

/* End of file Model_auth.php */

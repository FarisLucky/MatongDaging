<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_auth extends CI_Model {

    public function getUser($input)
    {
        $getUser = $this->db->get_where('user',['username'=>$input['username']]);
        return $getUser;
    }

}

/* End of file Model_auth.php */

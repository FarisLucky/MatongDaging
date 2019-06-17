<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Model_dashboard extends CI_Model {

    public function getData($table)
    {
        return $this->db->get();
    }
    public function getDataWhere($table,$where)
    {
        return $this->db->get_where($table,$where);
    }
}

/* End of file ModelName.php */
